<?php

$db_dsn = 'mysql:dbname=mydb;host=127.0.0.1;charset=utf8';
$db_user = 'myuser';
$db_pass = 'mypassword';

//Tablename => URI
$db_sources = array(
  'road' => 'https://s3.amazonaws.com/ir-data-now/csv/Road_driver_stats.csv',
  'oval' => 'https://s3.amazonaws.com/ir-data-now/csv/Oval_driver_stats.csv',
  'dirt_road' => 'https://s3.amazonaws.com/ir-data-now/csv/Dirt_Road_driver_stats.csv',
  'dirt_oval' => 'https://s3.amazonaws.com/ir-data-now/csv/Dirt_Oval_driver_stats.csv',
);
