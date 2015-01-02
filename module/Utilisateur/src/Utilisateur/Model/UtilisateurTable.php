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
        $password = md5($utilisateur->motDePasse);
        //blowfish
       // $bcrypt = new Bcrypt();
       // $crypt_password = $bcrypt->create($utilisateur->motDePasse);



     
        $data = array(
            'nom' => $utilisateur->nom,
            'motDePasse' => $password,
        );

        $this->tableGateway->insert($data);
    }


}
