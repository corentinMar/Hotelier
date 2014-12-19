<?php

namespace Chambre\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Chambre {

    public $idHotel;
    public $idChambre;
    public $nomChambre;
    public $type;

    public function exchangeArray($data) {
        $this->idHotel = (!empty($data['idHotel'])) ? $data['idHotel'] : null;
        $this->idChambre = (!empty($data['idChambre'])) ? $data['idChambre'] : null;        
        $this->nomChambre = (!empty($data['nomChambre'])) ? $data['nomChambre'] : null;
        $this->type = (!empty($data['type'])) ? $data['type'] : null;
    }
    
    // Add the following method:
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }

    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Non utilisé");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            
            $inputFilter->add(array(
                'name' => 'idHotel',
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
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
