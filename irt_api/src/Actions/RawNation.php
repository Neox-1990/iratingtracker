<?php
namespace Ronaldg\Irt_api\Actions;

class RawNation extends \Ronaldg\Irt_api\Action
{
    public function retrieveData(\PDO $dblink, string $discipline, $idString, $filterString, $optionString, $formatString)
    {
        if (mb_ereg("[0-9]+", $idString) === false) {
            header('Content-type:text/plain;charset=utf-8');
            echo "";
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
            header('Content-type:text/plain;charset=utf-8');
            echo "";
        }

        header('Content-type:text/plain;charset=utf-8');
        echo empty($row) ? "" : $row['location'];

        //return empty($row) ? [] : $row;
    }
}
