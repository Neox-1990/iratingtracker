<?php
namespace Ronaldg\Irt_api\Actions;

class GetMultiple extends \Ronaldg\Irt_api\Action{
  function retrieveData(\PDO $dblink, string $discipline, string $idString, string $filterString):array{
    if(mb_ereg("([0-9]+)(,([0-9]+))*", $idString) === false){
      return [];
    }else{
      $id = explode(',',$idString);
      $id = array_map(function($i){
        return intval($i);
      }, $id);
    }

    $sql = 'SELECT * FROM '.$discipline.' WHERE id IN ('.implode(',', $id).')';
    $stm = $dblink->prepare($sql);
    if($stm->execute()){
      $rows = $stm->fetchAll(\PDO::FETCH_ASSOC);
      $result = array();
      foreach ($rows as $row) {
        $result[$row['id']] = $row;
      }
    }else{
      return [];
    }

    return $result;
  }
}

 ?>
