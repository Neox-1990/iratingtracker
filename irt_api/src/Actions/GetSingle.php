<?php
namespace Ronaldg\Irt_api\Actions;

class GetSingle extends \Ronaldg\Irt_api\Action{
  function retrieveData(\PDO $dblink, string $discipline, string $idString, string $filterString):array{
    if(mb_ereg("[0-9]+", $idString) === false){
      return [];
    }else{
      $id = intval($idString);
    }

    //TODO Filters

    $sql = 'SELECT * FROM '.$discipline.' WHERE id = :id';
    $stm = $dblink->prepare($sql);
    $stm->bindValue(':id', $id, \PDO::PARAM_INT);

    if($stm->execute()){
      $row = $stm->fetch(\PDO::FETCH_ASSOC);
    }else{
      return [];
    }

    return empty($row) ? [] : $row;
  }
}

 ?>
