<?php

namespace Chambre\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Chambre {

    public $idChambre;
    public $idHotel;
    public $nomChambre;
    public $type;
    private $inputFilter;

    public function exchangeArray($data) {
        $this->idChambre = (!empty($data['idChambre'])) ? $data['idChambre'] : null;
        $this->idHotel = (!empty($data['idHotel'])) ? $data['idHotel'] : null;
        $this->nomChambre = (!empty($data['nomChambre'])) ? $data['nomChambre'] : null;
        $this->type = (!empty($data['type'])) ? $data['type'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Non utilisé");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'idChambre',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'idHotel',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'nomChambre',
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
                'name' => 'type',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Between',
                        'options' => array(
                            'min' => 1,
                            'messages' => array('notBetween' => 'Valeur négative ou nulle incorrecte')
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
