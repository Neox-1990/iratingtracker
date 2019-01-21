<?php
namespace Ronaldg\Irt_api;

abstract class Action{
  abstract function retrieveData(\PDO $dblink, string $discipline, string $idString, string $filterString):array;
}

?>
