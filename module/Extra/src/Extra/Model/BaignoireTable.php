<?php

namespace Extra\Model;

use Zend\Db\TableGateway\TableGateway;

class BaignoireTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getBaignoire($_idChambre) {
        $idChambre = (int) $_idChambre;
        $rowset = $this->tableGateway->select(array('idChambre' => $idChambre));
        $row = $rowset->current();
        if (!$row) {
            $row=null;
        }
        return $row;
    }
    
    
     public function getBaignoireV2($_idBaignoire) {
        $idBaignoire = (int) $_idBaignoire;
        $rowset = $this->tableGateway->select(array('idBaignoire' => $idBaignoire));
        $row = $rowset->current();
        if (!$row) {
            $row=null;
        }
        return $row;
    }

    public function getListeBaignoire($idChambre) {
        $idChambre = (int) $idChambre;
        $rowset = $this->tableGateway->select(array('idChambre' => $idChambre));
        if (!$rowset) {
            throw new \Exception("Impossible de trouver les lignes pour la chambre n° $idChambre");
        }
        return $rowset;
    }

    public function saveBaignoire(Baignoire $baignoire) {
        $data = array(
            'idBaignoire' => $baignoire->idBaignoire,
            'idChambre' => $baignoire->idChambre,
            'prixBaignoire' => $baignoire->prixBaignoire,
            
        );

        $idBaignoire = (int) $baignoire->idBaignoire;
        if ($idBaignoire == 0) {
            //Ajout
            $this->tableGateway->insert($data);
        } else {
            //Modification
            if ($this->getBaignoireV2($idBaignoire)) {
                $this->tableGateway->update($data, array('idBaignoire' => $idBaignoire));
            } else {
                throw new \Exception('L\id de la baignoire n\'existe pas.');
            }
        }
    }

    public function deleteBaignoire($idBaignoire) {
        $this->tableGateway->delete(array('idBaignoire' => (int) $idBaignoire));
    }

}
