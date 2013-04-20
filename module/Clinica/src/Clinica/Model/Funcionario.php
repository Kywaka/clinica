<?php

namespace Clinica\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Funcionario implements InputFilterAwareInterface {

    public $id;
    public $nome;
    public $login;
    public $senha;
    public $cargo;
    public $salario;
    public $cpf;
    public $endereco;
    public $telefone1;
    public $telefone2;
    public $email;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->nome = (isset($data['nome'])) ? $data['nome'] : null;
        $this->login = (isset($data['login'])) ? $data['login'] : null;
        $this->senha = (isset($data['senha'])) ? $data['senha'] : null;
        $this->cargo = (isset($data['cargo'])) ? $data['cargo'] : null;
        $this->salario = (isset($data['salario'])) ? $data['salario'] : null;
        $this->cpf = (isset($data['cpf'])) ? $data['cpf'] : null;
        $this->endereco = (isset($data['endereco'])) ? $data['endereco'] : null;
        $this->telefone1 = (isset($data['telefone1'])) ? $data['telefone1'] : null;
        $this->telefone2 = (isset($data['telefone2'])) ? $data['telefone2'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        
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
                        'name' => 'login',
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
                                        'isEmpty' => 'Preencha o campo Login'
                                        
                                    )
                                )
                            )
                        )
                    )));
            
             $inputFilter->add($factory->createInput(array(
                        'name' => 'senha',
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
                                        'isEmpty' => 'Preencha o campo Senha'
                                        
                                    )
                                )
                            )
                        )
                    )));
             
             $inputFilter->add($factory->createInput(array(
                        'name' => 'cargo',
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
                                        'isEmpty' => 'Preencha o campo Cargo'
                                        
                                    )
                                )
                            )
                        )
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'endereco',
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
                                        'isEmpty' => 'Preencha o campo Endereço'
                                    )
                                )
                            )
                        )
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'cpf',
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
                                        'isEmpty' => 'Preencha o campo cpf'
                                    )
                                )
                            )
                        )
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'telefone1',
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
                                        'isEmpty' => 'Preencha o campo Telefone'
                                    )
                                )
                            ),
//                    array(
//                      'name'=>'StringLength',
//                        true,
//                        'options'=>array(
//                            'ecoding'=>'UTF-8',
//                            'min'=>10,
//                            'max'=>100,
//                            'message'=>'A descrição deve ter entre 10 e 100 caracteres'
//                        )
//                    )
                        )
                    )));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

}

?>
