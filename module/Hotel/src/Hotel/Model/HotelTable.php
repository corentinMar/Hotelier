<?php

namespace Hotel\Model;

use Zend\Db\TableGateway\TableGateway;

class HotelTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getHotel($idHotel) {
        $idHotel = (int) $idHotel;
        $rowset = $this->tableGateway->select(array('idHotel' => $idHotel));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Impossible de trouver la ligne $idHotel");
        }
        return $row;
    }

    public function saveHotel(Hotel $hotel) {
        $data = array(
            'idAdministrateur' => $hotel->idAdministrateur,
            'idHotel' => $hotel->idHotel,
            'nomHotel' => $hotel->nomHotel,
        );

        $idHotel = (int) $hotel->idHotel;
        if ($idHotel == 0) {
            //Ajout
            $this->tableGateway->insert($data);
        } else {
            //Modification
            if ($this->getHotel($idHotel)) {
                $this->tableGateway->update($data, array('idHotel' => $idHotel));
            } else {
                throw new \Exception('L\id de l\'hôtel n\'existe pas.');
            }
        }
    }

    public function deleteHotel($idHotel) {
        $this->tableGateway->delete(array('idHotel' => (int) $idHotel));
    }

}
