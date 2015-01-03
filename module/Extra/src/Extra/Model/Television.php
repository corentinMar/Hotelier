<?php

namespace Extra\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Television {

    public $idTelevision;
    public $idChambre;
    public $prixTelevision;
    private $inputFilter;

    public function exchangeArray($data) {
        $this->idTelevision = (!empty($data['idTelevision'])) ? $data['idTelevision'] : null;
        $this->idChambre = (!empty($data['idChambre'])) ? $data['idChambre'] : null;
        $this->prixTelevision = (!empty($data['prixTelevision'])) ? $data['prixTelevision'] : null;
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
                'name' => 'idTelevision',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'idChambre',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));


            $inputFilter->add(array(
                'name' => 'prixTelevision',
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
