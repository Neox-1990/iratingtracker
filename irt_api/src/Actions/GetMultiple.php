<?php
namespace Ronaldg\Irt_api\Actions;

class GetMultiple extends \Ronaldg\Irt_api\Action
{
    public function retrieveData(\PDO $dblink, string $discipline, $idString, $filterString, $optionString, $formatString)
    {
        if (mb_ereg("([0-9]+)(,([0-9]+))*", $idString) === false) {
            header('Content-type:application/json;charset=utf-8');
            echo json_encode([]);
        } else {
            $id = explode(',', $idString);
            $id = array_map(function ($i) {
                return intval($i);
            }, $id);
        }

        $sql = 'SELECT * FROM '.$discipline.' WHERE id IN ('.implode(',', $id).')';
        $stm = $dblink->prepare($sql);
        if ($stm->execute()) {
            $rows = $stm->fetchAll(\PDO::FETCH_ASSOC);
            $result = array();
            foreach ($rows as $row) {
                $result[$row['id']] = $row;
            }
        } else {
            header('Content-type:application/json;charset=utf-8');
            echo json_encode([]);
        }

        header('Content-type:application/json;charset=utf-8');
        echo json_encode($result);

        //return $result;
    }
}
