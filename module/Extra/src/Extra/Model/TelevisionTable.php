<?php

namespace Extra\Model;

use Zend\Db\TableGateway\TableGateway;

class TelevisionTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getTelevision($_idChambre) {
        $idChambre = (int) $_idChambre;
        $rowset = $this->tableGateway->select(array('idChambre' => $idChambre));
        $row = $rowset->current();
        if (!$row) {
            $row=null;
        }
        return $row;
    }
    
    
     public function getTelevisionV2($_idTelevision) {
        $idTelevision = (int) $_idTelevision;
        $rowset = $this->tableGateway->select(array('idTelevision' => $idTelevision));
        $row = $rowset->current();
        if (!$row) {
            $row=null;
        }
        return $row;
    }

    public function getListeTelevision($idChambre) {
        $idChambre = (int) $idChambre;
        $rowset = $this->tableGateway->select(array('idChambre' => $idChambre));
        if (!$rowset) {
            throw new \Exception("Impossible de trouver les lignes pour la chambre n° $idChambre");
        }
        return $rowset;
    }

    public function saveTelevision(Television $television) {
        $data = array(
            'idTelevision' => $television->idTelevision,
            'idChambre' => $television->idChambre,
            'prixTelevision' => $television->prixTelevision,
            
        );

        $idTelevision = (int) $television->idTelevision;
        if ($idTelevision == 0) {
            //Ajout
            $this->tableGateway->insert($data);
        } else {
            //Modification
            if ($this->getTelevisionV2($idTelevision)) {
                $this->tableGateway->update($data, array('idTelevision' => $idTelevision));
            } else {
                throw new \Exception('L\id de la television n\'existe pas.');
            }
        }
    }

    public function deleteTelevision($idTelevision) {
        $this->tableGateway->delete(array('idTelevision' => (int) $idTelevision));
    }

}
