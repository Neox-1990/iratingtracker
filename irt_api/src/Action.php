<?php
namespace Ronaldg\Irt_api;

abstract class Action
{
    abstract public function retrieveData(\PDO $dblink, string $discipline, $idString, $filterString, $optionString, $formatString);
}
