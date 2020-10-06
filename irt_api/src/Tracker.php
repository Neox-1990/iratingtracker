<?php

namespace Ronaldg\Irt_api;

use Ronaldg\Irt_api\Action;

/**
 * Core Class, handling authentication and output
 */
class Tracker
{
    protected $_db_link;
    protected $_irt_key;
    protected $_actions = array();
    protected $_discipline;

    /**
     * Perform prechecks and initialize variables
     * if precheck fails, returns 403
     * @param  \PDO    $dblink Database connection
     * @param  string  $discipline road, oval, dirt_road or dirt_oval
     * @return Tracker         [description]
     */
    public function init(\PDO $dblink, string $discipline)
    {
        $this->_irt_key = $_GET['irt_key'] ?? null;
        $this->_db_link = $dblink;
        $this->_discipline = $discipline;

        if ($this->preCheck()) {
            return $this;
        } else {
            http_response_code(403);
            die(json_encode([]));
        }

        return $this;
    }

    /**
     * Register Action under a certain name
     * @param  string $actionName Name of the action, used in the queryparameter
     * @param  Action $action     Actionclass, derrived by \Ronaldg\Irt_api\Action
     * @return void
     */
    public function registerAction(string $actionName, Action $action)
    {
        $this->_actions[$actionName] = $action;
    }

    /**
     * Calls requested Action with parameter or returns error
     * @return void
     */
    public function callAction()
    {
        $idString = $_GET['id'] ?? null;
        $filterString = $_GET['filter'] ?? null;
        $action = $_GET['action'] ?? null;
        $option = $_GET['option'] ?? null;
        $format = $_GET['format'] ?? "json";

        if (!is_null($action) && array_key_exists($action, $this->_actions)) {
            $this->_actions[$action]->retrieveData($this->_db_link, $this->_discipline, $idString, $filterString, $option, $format);
        } else {
            http_response_code(400);
            echo null;
        }
    }

    /*
     * Does the checkings before the actual request is handled
     * @return Boolean Did it pass or not
     */
    private function preCheck()
    {
        $valid = true;

        //Check Parameter Key
        if ($this->_irt_key === null || $this->_irt_key === '' || mb_ereg('[A-z0-9]{16}', $this->_irt_key) === false) {
            return false;
        }

        //Check Key
        $sql = 'SELECT id FROM api_token WHERE token = :key AND status = 1';
        $stm = $this->_db_link->prepare($sql);
        $stm->bindValue(':key', $this->_irt_key, \PDO::PARAM_STR);
        if (!$stm->execute() && $stm->rowCount() != 1) {
            return false;
        }

        //TODO: Flags check
        //TODO: Throttling check

        return $valid;
    }
}
