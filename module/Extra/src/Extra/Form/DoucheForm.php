<?php

namespace Extra\Form;

use Zend\Form\Form;

class DoucheForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('douche');

        //Champs
        $this->add(array(
            'name' => 'idChambre',
            'type' => 'Hidden',
        ));

       
        $this->add(array(
            'name' => 'idDouche',
            'type' => 'Hidden',
        ));
        

        $this->add(array(
            'name' => 'prixDouche',
            'type' => 'Number',
            'options' => array(
                'label' => 'Prix de la douche: ',
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
