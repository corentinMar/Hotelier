<?php

namespace Chambre\Form;

use Zend\Form\Form;

class ChambreForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('chambre');

        //Champs
        $this->add(array(
            'name' => 'idChambre',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'idHotel',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'nomChambre',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nom de la chambre : ',
            ),
        ));

        $this->add(array(
            'name' => 'type',
            'type' => 'Number',
            'options' => array(
                'label' => 'Le type de chambre : ',
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
