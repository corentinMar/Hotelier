<?php

namespace Hotel\Model;

class Proprietaire {

    public $id;
    public $nom;
    public $administrateur;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->nom = (!empty($data['nom'])) ? $data['nom'] : null;
        $this->administrateur = (!empty($data['administrateur'])) ? $data['administrateur'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
