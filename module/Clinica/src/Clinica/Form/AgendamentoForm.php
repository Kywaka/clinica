<?php

namespace Clinica\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Button;
use Zend\Form\Form;

class AgendamentoForm extends Form {

    public function __construct($name = null) {
        parent::__construct('agendamento');
        //$this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data'); //Enctype Possibilita enviar arquivos pelo formulário.
        $id = new Hidden('agendamento_id');
        $nome = new Text('agendamento_nome');
        $nome->setLabel("Nome: ")
                ->setAttributes(array(
                    'style' => 'width:150px;',
                    'title' => 'Exemplo: João Barbosa'
                ));

        $data_nasc = new Text('agendamento_data_nasc');
        $data_nasc->setLabel("Data de Nascimento: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $cpf = new Text('agendamento_cpf');
        $cpf->setLabel("CPF: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $endereco = new Text('agendamento_endereco');
        $endereco->setLabel("Endereço: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));
        $forma_pgto = new Text('agendamento_forma_pgto');
        $forma_pgto->setLabel("Forma de Pagamento: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $telefone = new Text('agendamento_telefone');
        $telefone->setLabel("Telefone: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $celular = new Text('agendamento_celular');
        $celular->setLabel("Celular: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $email = new Text('agendamento_email');
        $email->setLabel("Email: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));
        $login = new Text('agendamento_login');
        $login->setLabel("Login: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $senha = new Text('agendamento_senha');
        $senha->setLabel("Senha: ")
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
        $this->add($data_nasc);
        $this->add($cpf);
        $this->add($endereco);
        $this->add($forma_pgto);
        $this->add($telefone);
        $this->add($celular);
        $this->add($email);
        $this->add($login);
        $this->add($senha);
        
        $this->add($submit, array('priority' => -100));
    }

}

?>
