<?php

namespace Hotel\Form;

use Zend\Form\Form;

class HotelForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('hotel');

        //Champs

        $this->add(array(
            'name' => 'idHotel',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'idAdministrateur',
            'type' => 'Number',
            'options' => array(
                'label' => 'L\'identifiant de l\'administrateur : ',
            ),
        ));

        $this->add(array(
            'name' => 'nomHotel',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nom de l\'hôtel : ',
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
