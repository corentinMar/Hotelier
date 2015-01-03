<?php

namespace Extra\Form;

use Zend\Form\Form;

class FrigoForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('frigo');

        //Champs
        $this->add(array(
            'name' => 'idChambre',
            'type' => 'Hidden',
        ));


        $this->add(array(
            'name' => 'idFrigo',
            'type' => 'Hidden',
        ));


        $this->add(array(
            'name' => 'prixFrigo',
            'type' => 'Number',
            'options' => array(
                'label' => 'Prix de la frigo (en €) : ',
            ),
        ));

        //Bouton
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }

}
