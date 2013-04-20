<?php

namespace Clinica\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Button;
use Zend\Form\Form;

class ProcedimentoForm extends Form {

    public function __construct($name = null) {
        parent::__construct('procedimento');
        //$this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data'); //Enctype Possibilita enviar arquivos pelo formulário.
        $id = new Hidden('idProcedimento');
        $nome = new Text('nome');
        $nome->setLabel("Nome: ")
                ->setAttributes(array(
                    'style' => 'width:150px;',
                    'title' => 'Exemplo: Restauração de superfície radicular'
                ));

        $valor = new Text('valor');
        $valor->setLabel("Valor Proposto: ")
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
        
        $this->add($submit, array('priority' => -100));
    }

}

?>