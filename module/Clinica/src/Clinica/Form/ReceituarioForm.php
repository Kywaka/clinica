<?php

namespace Clinica\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Button;
use Zend\Form\Form;

class ReceituarioForm extends Form {

    public function __construct($name = null) {
        parent::__construct('receituario');
        //$this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data'); //Enctype Possibilita enviar arquivos pelo formulário.
        $id = new Hidden('id');
        $obs = new Text('obs');
        $obs->setLabel("Obs: ")
                ->setAttributes(array(
                    'style' => 'width:150px;',
                    'title' => 'Exemplo: valex'
                ));

        $medicacao = new Text('medicacao');
        $medicacao->setLabel("Medicacao: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $nome_dentista = new Text('nome_dentista');
        $nome_dentista->setLabel("Dentista: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));
        
        $nome_paciente = new Text('nome_paciente');
        $nome_paciente->setLabel("Paciente: ")
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
        $this->add($obs);
        $this->add($medicacao);
        $this->add($nome_dentista);
        $this->add($nome_paciente);
        
        
        $this->add($submit, array('priority' => -100));
    }

}

?>
