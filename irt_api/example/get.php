<?php
use \Ronaldg\Irt_api\Tracker;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config.php';

$discipline = $_GET['discipline'] ?? null;

if (is_null($discipline) || !array_key_exists($discipline, $tablenames)) {
    http_response_code(403);
    die(json_encode([]));
}

$pdo = new PDO($db_dsn, $db_user, $db_pass);

$tracker = new Tracker();
$tracker = $tracker->init($pdo, $tablenames[$discipline]);

$tracker->registerAction('single', new \Ronaldg\Irt_api\Actions\GetSingle());
$tracker->registerAction('multi', new \Ronaldg\Irt_api\Actions\GetMultiple());
$tracker->registerAction('nationraw', new \Ronaldg\Irt_api\Actions\RawNation());
$result = $tracker->callAction();

//header('Content-type:application/json;charset=utf-8');
//echo json_encode($result);
