<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';

use League\Csv\Reader;
use League\Csv\Statement;

$pdo = new PDO($db_dsn, $db_user, $db_pass);

echo "start:\t".(new DateTime())->format('Y-m-d H:i:s')."\n";

foreach ($db_sources as $tablename => $sourceURL) {
  //Download CSV with data
  file_put_contents(__DIR__.'/driver_raw.csv', fopen($sourceURL, 'r'));

  echo "Download done:\t".(new DateTime())->format('Y-m-d H:i:s')."\n";

  //Empty Tables
  // $sql = 'DELETE FROM '.$tablename;
  // $query = $pdo->prepare($sql);
  // $query->execute();

  //Change to MyISAM Engine for faster insert
  // $sql = 'ALTER TABLE '.$tablename.' ENGINE = MyISAM;';
  // $query = $pdo->prepare($sql);
  // $query->execute();

  //Read CSV file
  $reader = Reader::createFromPath(__DIR__.'/driver_raw.csv', 'r');
  $reader->setHeaderOffset(0);
  $reader->setOutputBOM(Reader::BOM_UTF8);
  $stmt = (new Statement())->offset(0);

  //Insert SQL command
  $sql = 'REPLACE INTO '.$tablename.' VALUES(
    :id,
    :driver,
    :location,
    :club,
    :starts,
    :wins,
    :avg_start,
    :avg_finish,
    :avg_inc,
    :safetyrating,
    :irating
  )';

  //Bind Values and execute command for each driver
  $records = $stmt->process($reader);
  foreach ($records as $record) {
    $driver = $record['DRIVER'];
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $record['CUSTID'], PDO::PARAM_INT);
    $query->bindValue(':driver', $driver, PDO::PARAM_STR);
    $query->bindValue(':location', $record['LOCATION'], PDO::PARAM_STR);
    $query->bindValue(':club', $record['CLUB_NAME'], PDO::PARAM_STR);
    $query->bindValue(':starts', $record['STARTS'], PDO::PARAM_INT);
    $query->bindValue(':wins', $record['WINS'], PDO::PARAM_INT);
    $query->bindValue(':avg_start', $record['AVG_START_POS'], PDO::PARAM_INT);
    $query->bindValue(':avg_finish', $record['AVG_FINISH_POS'], PDO::PARAM_INT);
    $query->bindValue(':avg_inc', floatval($record['AVG_INC']));
    $query->bindValue(':safetyrating', $record['CLASS'], PDO::PARAM_STR);
    $query->bindValue(':irating', $record['IRATING'], PDO::PARAM_INT);

    $query->execute();
  }

  //Change to InnoDB engine for faster reads
  // $sql = 'ALTER TABLE '.$tablename.' ENGINE = InnoDB;';
  // $query = $pdo->prepare($sql);
  // $query->execute();
}

echo "end:\t".(new DateTime())->format('Y-m-d H:i:s')."\n";
