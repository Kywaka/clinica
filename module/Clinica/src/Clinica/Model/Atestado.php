<?php

namespace Clinica\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Atestado implements InputFilterAwareInterface {

    public $id;
    public $nome;
    public $data;
    public $hora;
    public $dentista_rec;
    public $paciente_rec;
    
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->obs = (isset($data['obs'])) ? $data['obs'] : null;
        $this->data = (isset($data['data'])) ? $data['data'] : null;
        $this->hora = (isset($data['hora'])) ? $data['hora'] : null;
        $this->nome_dentista = (isset($data['nome_dentista'])) ? $data['nome_dentista'] : null;
        $this->nome_paciente = (isset($data['nome_paciente'])) ? $data['nome_paciente'] : null;
        
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new inputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name' => 'id',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'Int')
                        )
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'obs',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array(
                                    'messages' => array(
                                        'isEmpty' => 'Preencha o campo nome'
                                        
                                    )
                                )
                            )
                        )
                    )));
            
            $inputFilter->add($factory->createInput(array(
                        'name' => 'data',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array(
                                    'messages' => array(
                                        'isEmpty' => 'Preencha o campo data'
                                        
                                    )
                                )
                            )
                        )
                    )));
            
            $inputFilter->add($factory->createInput(array(
                        'name' => 'hora',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array(
                                    'messages' => array(
                                        'isEmpty' => 'Preencha o campo hora'
                                        
                                    )
                                )
                            )
                        )
                    )));
            
            
             $inputFilter->add($factory->createInput(array(
                        'name' => 'nome_dentista',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array(
                                    'messages' => array(
                                        'isEmpty' => 'Preencha o campo dentista'
                                        
                                    )
                                )
                            )
                        )
                    )));  
             $inputFilter->add($factory->createInput(array(
                        'name' => 'nome_paciente',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array(
                                    'messages' => array(
                                        'isEmpty' => 'Preencha o campo paciente'
                                        
                                    )
                                )
                            )
                        )
                    ))); 

            

            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

}

?>
