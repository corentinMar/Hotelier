<?php

namespace SanAuth\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class AuthForm extends Form {

    public function __construct($name = null) {
        //We want to ignore the name passed
        parent::__construct('User');

        /* Contenu */
        //Champs
        $this->add(array(
            'name' => 'username',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nom : ',
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'options' => array(
                'label' => 'Mot de Passe : ',
            ),
        ));

        $this->add(array(
            'name' => 'rememberme',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'Se souvenir de moi ? ',
            ),
        ));

        //Bouton
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Envoyer',
                'id' => 'submitbutton',
            ),
        ));

        /* Filtres et Validateurs */
        $inputFilter = new InputFilter();

        $inputFilter->add(array(
            'name' => 'username',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
            ),
        ));

        $inputFilter->add(array(
            'name' => 'password',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
            ),
        ));
        
        $this->setInputFilter($inputFilter);
    }
}
