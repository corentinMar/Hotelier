<?php

namespace Utilisateur\Model;

use Zend\Db\TableGateway\TableGateway;

class UtilisateurTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function saveUtilisateur(Utilisateur $utilisateur) {
        $data = array(
            'nom' => $utilisateur->nom ,
            'motDePasse' => $utilisateur->motDePasse,
        );

        $this->tableGateway->insert($data);
    }

}
