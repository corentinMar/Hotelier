<?php

namespace Hotel\Model;

use Zend\Db\TableGateway\TableGateway;

class ProprietaireTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getProprietaire($idAdministrateur) {
        $rowset = $this->tableGateway->select(array('id' => $idAdministrateur));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Impossible de trouver la ligne de $idAdministrateur.");
        }
        return $row;
    }

}
