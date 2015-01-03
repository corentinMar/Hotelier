<?php

namespace Extra\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Baignoire {

    public $idBaignoire;
    public $idChambre;
    public $prixBaignoire;

    public function exchangeArray($data) {
        $this->idBaignoire = (!empty($data['idBaignoire'])) ? $data['idBaignoire'] : null;
        $this->idChambre = (!empty($data['idChambre'])) ? $data['idChambre'] : null;
        $this->prixBaignoire = (!empty($data['prixBaignoire'])) ? $data['prixBaignoire'] : null;
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
                'name' => 'idBaignoire',
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
                'name' => 'prixBaignoire',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
