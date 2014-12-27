<?php

namespace Chambre\Model;

use Zend\Db\TableGateway\TableGateway;

class ChambreTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getChambre($idChambre) {
        $idChambre = (int) $idChambre;
        $rowset = $this->tableGateway->select(array('idChambre' => $idChambre));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Impossible de trouver la ligne $idChambre");
        }
        return $row;
    }

    public function getListeChambre($idHotel) {
        $idHotel = (int) $idHotel;
        $rowset = $this->tableGateway->select(array('idHotel' => $idHotel));
        if (!$rowset) {
            throw new \Exception("Impossible de trouver les lignes pour l'hotel n° $idHotel");
        }
        return $rowset;
    }

    public function saveChambre(Chambre $chambre) {
        $data = array(
            'idChambre' => $chambre->idChambre,
            'idHotel' => $chambre->idHotel,
            'nomChambre' => $chambre->nomChambre,
            'type' => $chambre->type,
        );

        $idChambre = (int) $chambre->idChambre;
        if ($idChambre == 0) {
            //Ajout
            $this->tableGateway->insert($data);
        } else {
            //Modification
            if ($this->getChambre($idChambre)) {
                $this->tableGateway->update($data, array('idChambre' => $idChambre));
            } else {
                throw new \Exception('L\id de la chambre n\'existe pas.');
            }
        }
    }

    public function deleteChambre($idChambre) {
        $this->tableGateway->delete(array('idChambre' => (int) $idChambre));
    }

}
