<?php

namespace Clinica\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Button;
use Zend\Form\Element\Select;
use Zend\Form\Form;

class FuncionarioForm extends Form {

    public function __construct($name = null) {
        parent::__construct('funcionario');
        //$this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data'); //Enctype Possibilita enviar arquivos pelo formulário.
        $id = new Hidden('id');
        $nome = new Text('nome');
        $nome->setLabel("Nome: ")
                ->setAttributes(array(
                    'style' => 'width:200px;',
                    'title' => 'Exemplo: João Barbosa'
                ));

        $login = new Text('login');
        $login->setLabel("Login: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $senha = new \Zend\Form\Element\Password('senha');
        $senha->setLabel("Senha: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $cargo = new Select('cargo');
        $cargo->setLabel("Cargo: ")
                ->setAttributes(array(
                    'style' => 'width:170px;',
                    'options' => array(1 => 'Option 1', 2 => 'Option 2'),
                ));

//        $pt = new Zend\Form\Element\Select('cargo', array(
//                    'label' => 'Select one',
//                ));
//        $pt->setAttributes(array(
//            'options' => array(1 => 'Option 1', 2 => 'Option 2'),
//        ));

        $salario = new Text('salario');
        $salario->setLabel("Salario: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $cpf = new Text('cpf');
        $cpf->setLabel("Cpf: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $endereco = new Text('endereco');
        $endereco->setLabel("Endereço: ")
                ->setAttributes(array(
                    'style' => 'width:250px;'
                ));

        $telefone1 = new Text('telefone1');
        $telefone1->setLabel("Telefone: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $telefone2 = new Text('telefone2');
        $telefone2->setLabel("Telefone Opcional: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));
        $email = new Text('email');
        $email->setLabel("Email: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $submit = new Button('submit');
        $submit->setLabel("Cadastrar")
                ->setAttributes(array(
                    'type' => 'submit'
                ));

        //setando os campos criados
        $this->add($id);
        $this->add($nome);
        $this->add($login);
        $this->add($senha);
        $this->add($cargo);
        $this->add($salario);
        $this->add($cpf);
        $this->add($endereco);
        $this->add($telefone1);
        $this->add($telefone2);
        $this->add($email);

        $this->add($submit, array('priority' => -100));
    }

}

?>
