<?php

namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;

class AlbumTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getAlbum($idHotel) {
        $idHotel = (int) $idHotel;
        $rowset = $this->tableGateway->select(array('idHotel' => $idHotel));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Impossible de trouver la ligne $idHotel");
        }
        return $row;
    }

    public function saveAlbum(Album $album) {
        $data = array(
            'idAdministrateur' => $album->idAdministrateur,
            'idHotel' => $album->idHotel,
            'nomHotel' => $album->nomHotel,
        );

        $idHotel = (int) $album->idHotel;
        if ($idHotel == 0) {
            //Ajout
            $this->tableGateway->insert($data);
        } else {
            //Modification
            if ($this->getAlbum($idHotel)) {
                $this->tableGateway->update($data, array('idHotel' => $idHotel));
            } else {
                throw new \Exception('L\id de l\'hôtel n\'existe pas.');
            }
        }
    }

    public function deleteAlbum($idHotel) {
        $this->tableGateway->delete(array('idHotel' => (int) $idHotel));
    }

}
