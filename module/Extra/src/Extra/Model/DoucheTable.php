<?php

namespace Extra\Model;

use Zend\Db\TableGateway\TableGateway;

class DoucheTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getDouche($_idChambre) {
        $idChambre = (int) $_idChambre;
        $rowset = $this->tableGateway->select(array('idChambre' => $idChambre));
        $row = $rowset->current();
        if (!$row) {
            $row = null;
        }
        return $row;
    }

    public function getDouchev2($_idDouche) {
        $idDouche = (int) $_idDouche;
        $rowset = $this->tableGateway->select(array('idDouche' => $idDouche));
        $row = $rowset->current();
        if (!$row) {
            $row = null;
        }
        return $row;
    }

    public function getListeDouche($idChambre) {
        $idChambre = (int) $idChambre;
        $rowset = $this->tableGateway->select(array('idChambre' => $idChambre));
        if (!$rowset) {
            throw new \Exception("Impossible de trouver les lignes pour la chambre n° $idChambre");
        }
        return $rowset;
    }

    public function saveDouche(Douche $douche) {
        $data = array(
            'idDouche' => $douche->idDouche,
            'idChambre' => $douche->idChambre,
            'prixDouche' => $douche->prixDouche,
        );

        $idDouche = (int) $douche->idDouche;
        if ($idDouche == 0) {
            //Ajout
            $this->tableGateway->insert($data);
        } else {
            //Modification
            print_r($idDouche);
            if ($this->getDouchev2($idDouche)) {
                $this->tableGateway->update($data, array('idDouche' => $idDouche));
            } else {
                throw new \Exception('L\id de la douche n\'existe pas.');
            }
        }
    }

    public function deleteDouche($idDouche) {
        $this->tableGateway->delete(array('idDouche' => (int) $idDouche));
    }

}
