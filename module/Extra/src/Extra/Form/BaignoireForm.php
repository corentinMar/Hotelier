<?php

namespace Extra\Form;

use Zend\Form\Form;

class BaignoireForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('baignoire');

        //Champs
        $this->add(array(
            'name' => 'idChambre',
            'type' => 'Hidden',
        ));


        $this->add(array(
            'name' => 'idBaignoire',
            'type' => 'Hidden',
        ));


        $this->add(array(
            'name' => 'prixBaignoire',
            'type' => 'Number',
            'options' => array(
                'label' => 'Prix de la baignoire (en €) : ',
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
