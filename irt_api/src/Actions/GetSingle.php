<?php
namespace Ronaldg\Irt_api\Actions;

class GetSingle extends \Ronaldg\Irt_api\Action
{
    public function retrieveData(\PDO $dblink, string $discipline, $idString, $filterString, $optionString, $formatString)
    {
        if (mb_ereg("[0-9]+", $idString) === false) {
            header('Content-type:application/json;charset=utf-8');
            echo json_encode([]);
        } else {
            $id = intval($idString);
        }

        //TODO Filters

        $sql = 'SELECT * FROM '.$discipline.' WHERE id = :id';
        $stm = $dblink->prepare($sql);
        $stm->bindValue(':id', $id, \PDO::PARAM_INT);

        if ($stm->execute()) {
            $row = $stm->fetch(\PDO::FETCH_ASSOC);
        } else {
            header('Content-type:application/json;charset=utf-8');
            echo json_encode([]);
        }

        header('Content-type:application/json;charset=utf-8');
        echo json_encode(empty($row) ? [] : $row);

        //return empty($row) ? [] : $row;
    }
}
