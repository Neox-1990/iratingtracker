<?php

$db_dsn = 'mysql:dbname=mydb;host=127.0.0.1;charset=utf8';
$db_user = 'myuser';
$db_pass = 'mypassword';

//Tablename => URI
$db_sources = array(
  'road' => 'https://s3.amazonaws.com/ir-data-now/csv/Road_driver_stats.csv',
  'sports_car' => 'https://s3.amazonaws.com/ir-data-now/csv/Sports_Car_driver_stats.csv',
  'formula_car' => 'https://s3.amazonaws.com/ir-data-now/csv/Formula_Car_stats.csv',
  'oval' => 'https://s3.amazonaws.com/ir-data-now/csv/Oval_driver_stats.csv',
  'dirt_road' => 'https://s3.amazonaws.com/ir-data-now/csv/Dirt_Road_driver_stats.csv',
  'dirt_oval' => 'https://s3.amazonaws.com/ir-data-now/csv/Dirt_Oval_driver_stats.csv',
);
