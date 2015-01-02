<?php

namespace Extra\Model;

use Zend\Db\TableGateway\TableGateway;

class FrigoTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getFrigo($_idChambre) {
        $idChambre = (int) $_idChambre;
        $rowset = $this->tableGateway->select(array('idChambre' => $idChambre));
        $row = $rowset->current();
        if (!$row) {
            $row = null;
        }
        return $row;
    }

    public function getFrigov2($_idFrigo) {
        $idFrigo = (int) $_idFrigo;
        $rowset = $this->tableGateway->select(array('idFrigo' => $idFrigo));
        $row = $rowset->current();
        if (!$row) {
            $row = null;
        }
        return $row;
    }

    public function getListeFrigo($idChambre) {
        $idChambre = (int) $idChambre;
        $rowset = $this->tableGateway->select(array('idChambre' => $idChambre));
        if (!$rowset) {
            throw new \Exception("Impossible de trouver les lignes pour la chambre n° $idChambre");
        }
        return $rowset;
    }

    public function saveFrigo(Frigo $frigo) {
        $data = array(
            'idFrigo' => $frigo->idFrigo,
            'idChambre' => $frigo->idChambre,
            'prixFrigo' => $frigo->prixFrigo,
        );

        $idFrigo = (int) $frigo->idFrigo;
        if ($idFrigo == 0) {
            //Ajout
            $this->tableGateway->insert($data);
        } else {
            //Modification
            print_r($idFrigo);
            if ($this->getFrigov2($idFrigo)) {
                $this->tableGateway->update($data, array('idFrigo' => $idFrigo));
            } else {
                throw new \Exception('L\id de la frigo n\'existe pas.');
            }
        }
    }

    public function deleteFrigo($idFrigo) {
        $this->tableGateway->delete(array('idFrigo' => (int) $idFrigo));
    }

}
