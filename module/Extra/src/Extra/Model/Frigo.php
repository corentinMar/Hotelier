<?php

namespace Extra\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Frigo {

    public $idFrigo;
    public $idChambre;
    public $prixFrigo;
    private $inputFilter;

    public function exchangeArray($data) {
        $this->idFrigo = (!empty($data['idFrigo'])) ? $data['idFrigo'] : null;
        $this->idChambre = (!empty($data['idChambre'])) ? $data['idChambre'] : null;
        $this->prixFrigo = (!empty($data['prixFrigo'])) ? $data['prixFrigo'] : null;
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
                'name' => 'idFrigo',
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
                'name' => 'prixFrigo',
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
