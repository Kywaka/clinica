<?php

namespace Clinica\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Agendamento implements InputFilterAwareInterface {

    public $agendamento_id;
    public $agendamento_nome;
    public $agendamento_data_nasc;
    public $agendamento_cpf;
    public $agendamento_endereco;
    public $agendamento_forma_pgto;
    public $agendamento_telefone;
    public $agendamento_celular;
    public $agendamento_email;
    public $agendamento_login;
    public $agendamento_senha;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->agendamento_id = (isset($data['agendamento_id'])) ? $data['agendamento_id'] : null;
        $this->agendamento_nome = (isset($data['agendamento_nome'])) ? $data['agendamento_nome'] : null;
        $this->agendamento_data_nasc = (isset($data['agendamento_data_nasc'])) ? $data['agendamento_data_nasc'] : null;
        $this->agendamento_cpf = (isset($data['agendamento_cpf'])) ? $data['agendamento_cpf'] : null;
        $this->agendamento_endereco = (isset($data['agendamento_endereco'])) ? $data['agendamento_endereco'] : null;
        $this->agendamento_forma_pgto = (isset($data['agendamento_forma_pgto'])) ? $data['agendamento_forma_pgto'] : null;
        $this->agendamento_telefone = (isset($data['agendamento_telefone'])) ? $data['agendamento_telefone'] : null;
        $this->agendamento_celular = (isset($data['agendamento_celular'])) ? $data['agendamento_celular'] : null;
        $this->agendamento_email = (isset($data['agendamento_email'])) ? $data['agendamento_email'] : null;
        $this->agendamento_login = (isset($data['agendamento_login'])) ? $data['agendamento_login'] : null;
        $this->agendamento_senha = (isset($data['agendamento_senha'])) ? $data['agendamento_senha'] : null;
        
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
                        'name' => 'agendamento_id',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'Int')
                        )
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'agendamento_nome',
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
                        'name' => 'agendamento_data_nasc',
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
                        'name' => 'agendamento_cpf',
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
                        'name' => 'agendamento_endereco',
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
                        'name' => 'agendamento_login',
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
                        'name' => 'agendamento_senha',
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
                        'name' => 'agendamento_telefone',
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
