<?php

namespace Clinica\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Paciente implements InputFilterAwareInterface {

    public $paciente_id;
    public $paciente_nome;
    public $paciente_data_nasc;
    public $paciente_cpf;
    public $paciente_endereco;
    public $paciente_forma_pgto;
    public $paciente_telefone;
    public $paciente_celular;
    public $paciente_email;
    public $paciente_login;
    public $paciente_senha;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->paciente_id = (isset($data['paciente_id'])) ? $data['paciente_id'] : null;
        $this->paciente_nome = (isset($data['paciente_nome'])) ? $data['paciente_nome'] : null;
        $this->paciente_data_nasc = (isset($data['paciente_data_nasc'])) ? $data['paciente_data_nasc'] : null;
        $this->paciente_cpf = (isset($data['paciente_cpf'])) ? $data['paciente_cpf'] : null;
        $this->paciente_endereco = (isset($data['paciente_endereco'])) ? $data['paciente_endereco'] : null;
        $this->paciente_forma_pgto = (isset($data['paciente_forma_pgto'])) ? $data['paciente_forma_pgto'] : null;
        $this->paciente_telefone = (isset($data['paciente_telefone'])) ? $data['paciente_telefone'] : null;
        $this->paciente_celular = (isset($data['paciente_celular'])) ? $data['paciente_celular'] : null;
        $this->paciente_email = (isset($data['paciente_email'])) ? $data['paciente_email'] : null;
        $this->paciente_login = (isset($data['paciente_login'])) ? $data['paciente_login'] : null;
        $this->paciente_senha = (isset($data['paciente_senha'])) ? $data['paciente_senha'] : null;
        
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
                        'name' => 'paciente_id',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'Int')
                        )
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'paciente_nome',
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
                        'name' => 'paciente_data_nasc',
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
                                        'isEmpty' => 'Preencha o campo Data de Nascimento'
                                        
                                    )
                                )
                            )
                        )
                    )));
            
             $inputFilter->add($factory->createInput(array(
                        'name' => 'paciente_cpf',
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
                                        'isEmpty' => 'Preencha o campo CPF'
                                        
                                    )
                                )
                            )
                        )
                    )));
             
             $inputFilter->add($factory->createInput(array(
                        'name' => 'paciente_endereco',
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
                        'name' => 'paciente_login',
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
                                        'isEmpty' => 'Preencha o campo login'
                                    )
                                )
                            )
                        )
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'paciente_senha',
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
                                        'isEmpty' => 'A senha não pode ser vazia'
                                    )
                                )
                            )
                        )
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'paciente_telefone',
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
