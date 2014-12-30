<?php

namespace SanAuth\Model;

class Utilisateur {

    public $id;
    public $nom;
    public $administrateur;

    public function exchangeArray($data) {
        $this->nom = (!empty($data['nom'])) ? $data['nom'] : null;
        $this->administrateur = (!empty($data['administrateur'])) ? $data['administrateur'] : null;
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
