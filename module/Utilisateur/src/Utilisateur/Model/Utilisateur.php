<?php

namespace Utilisateur\Model;

class Utilisateur {
    
  
    public $nom;
    public $motDePasse;

    public function exchangeArray($data) {
       
        $this->nom = (!empty($data['nom'])) ? $data['nom'] : null;
        $this->motDePasse = (!empty($data['motDePasse'])) ? $data['motDePasse'] : null;
    }

}
