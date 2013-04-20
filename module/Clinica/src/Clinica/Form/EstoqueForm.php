<?php

namespace Clinica\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Button;
use Zend\Form\Form;

class EstoqueForm extends Form {

    public function __construct($name = null) {
        parent::__construct('estoque');
        //$this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data'); //Enctype Possibilita enviar arquivos pelo formulário.
        $id = new Hidden('id');
        $nome = new Text('nome');
        $nome->setLabel("Nome: ")
                ->setAttributes(array(
                    'style' => 'width:150px;',
                    'title' => 'Exemplo: valex'
                ));

        $valor = new Text('valor');
        $valor->setLabel("Valor: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $quantidade = new Text('quantidade');
        $quantidade->setLabel("Quantidade: ")
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
        $this->add($valor);
        $this->add($quantidade);
        
        
        $this->add($submit, array('priority' => -100));
    }

}

?>
