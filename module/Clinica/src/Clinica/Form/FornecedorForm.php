<?php

namespace Clinica\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Button;
use Zend\Form\Form;

class FornecedorForm extends Form {

    public function __construct($name = null) {
        parent::__construct('fornecedor');
        //$this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data'); //Enctype Possibilita enviar arquivos pelo formulário.
        $id = new Hidden('id');
        $nome = new Text('nome');
        $nome->setLabel("Nome: ")
                ->setAttributes(array(
                    'style' => 'width:150px;',
                    'title' => 'Exemplo: Drogaria Unicon'
                ));

        $cnpj = new Text('cnpj');
        $cnpj->setLabel("CNPJ: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $endereco = new Text('endereco');
        $endereco->setLabel("Endereço: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
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
        $this->add($cnpj);
        $this->add($endereco);
        $this->add($telefone1);
        $this->add($telefone2);
        $this->add($email);
        
        $this->add($submit, array('priority' => -100));
    }

}

?>
