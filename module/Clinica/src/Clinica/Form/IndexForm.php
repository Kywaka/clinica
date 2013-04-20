<?php

namespace Clinica\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Button;
use Zend\Form\Form;

class IndexForm extends Form {

    public function __construct($name = null) {
        parent::__construct('index');
        //$this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data'); //Enctype Possibilita enviar arquivos pelo formulário.
        $id = new Hidden('user_id');
        $username = new Text('username');
        $username->setLabel("Nome: ")
                ->setAttributes(array(
                    'style' => 'width:150px;',
                    'title' => 'Exemplo: João Barbosa'
                ));

        $password = new Text('password');
        $password->setLabel("Senha: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $submit = new Button('submit');
        $submit->setLabel("Login")
                ->setAttributes(array(
                    'type' => 'submit'
                ));

        //setando os campos criados
        $this->add($id);
        $this->add($username);
        $this->add($password);
        
        $this->add($submit, array('priority' => -100));
    }

}

?>
