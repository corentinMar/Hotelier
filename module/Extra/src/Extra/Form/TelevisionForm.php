<?php

namespace Extra\Form;

use Zend\Form\Form;

class TelevisionForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('television');

        //Champs
        $this->add(array(
            'name' => 'idChambre',
            'type' => 'Hidden',
        ));


        $this->add(array(
            'name' => 'idTelevision',
            'type' => 'Hidden',
        ));


        $this->add(array(
            'name' => 'prixTelevision',
            'type' => 'Number',
            'options' => array(
                'label' => 'Prix de la television (en €) : ',
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
