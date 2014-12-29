<?php

namespace Utilisateur\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class UtilisateurForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('utilisateur');

        $this->add(array(
            'name' => 'nom',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nom : ',
            ),
        ));

        $this->add(array(
            'name' => 'motDePasse',
            'type' => 'Password',
            'options' => array(
                'label' => 'Mot de Passe : ',
            ),
        ));

        $this->add(array(
            'name' => 'mdp_check',
            'type' => 'Password',
            'options' => array(
                'label' => 'Valider le mot de passe : ',
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

        //Validateur du nom
        $inputFilter->add(array(
            'name' => 'nom',
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

        //Validateur du premier mot de passe 
        $inputFilter->add(array(
            'name' => 'motDePasse',
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

        //Validateur pour le checking du mot de passe
        $inputFilter->add(array(
            'name' => 'mdp_check',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(//on ajoute le validateur
                array(
                    'name' => 'Identical',
                    'options' => array(
                        'token' => 'motDePasse', // name of first password field
                    ),
                ),
            ),
        ));

        $this->setInputFilter($inputFilter);
    }

}
