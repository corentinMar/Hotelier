<?php

namespace SanAuth\Model;

use Zend\Db\TableGateway\TableGateway;

class SanAuthTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getUtilisateur($nom) {
        $rowset = $this->tableGateway->select(array('nom' => $nom));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Impossible de trouver la ligne de $nom.");
        }
        return $row;
    }

}
