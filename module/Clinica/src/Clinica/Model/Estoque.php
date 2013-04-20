<?php

namespace Clinica\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Estoque implements InputFilterAwareInterface {

    public $id;
    public $nome;
    public $valor;
    public $quantidade;
    
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nome = (isset($data['nome'])) ? $data['nome'] : null;
        $this->valor = (isset($data['valor'])) ? $data['valor'] : null;
        $this->quantidade = (isset($data['quantidade'])) ? $data['quantidade'] : null;
        
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
                        'name' => 'nome',
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
                        'name' => 'valor',
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
                                        'isEmpty' => 'Preencha o campo valor'
                                        
                                    )
                                )
                            )
                        )
                    )));
            
             $inputFilter->add($factory->createInput(array(
                        'name' => 'quantidade',
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
                                        'isEmpty' => 'Preencha o campo quantidade'
                                        
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

