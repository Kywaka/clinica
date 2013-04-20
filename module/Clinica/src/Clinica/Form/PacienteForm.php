<?php

namespace Clinica\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Button;
use Zend\Form\Form;
use Zend\Mail;

class PacienteForm extends Form {

    public function __construct($name = null) {
        parent::__construct('paciente');
        //$this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data'); //Enctype Possibilita enviar arquivos pelo formulário.
        $id = new Hidden('paciente_id');
        $nome = new Text('paciente_nome');
        $nome->setLabel("Nome: ")
                ->setAttributes(array(
                    'style' => 'width:150px;',
                    'title' => 'Exemplo: João Barbosa'
                ));

        $data_nasc = new Text('paciente_data_nasc');
        $data_nasc->setLabel("Data de Nascimento: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $cpf = new Text('paciente_cpf');
        $cpf->setLabel("CPF: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $endereco = new Text('paciente_endereco');
        $endereco->setLabel("Endereço: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));
        $forma_pgto = new Text('paciente_forma_pgto');
        $forma_pgto->setLabel("Forma de Pagamento: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $telefone = new Text('paciente_telefone');
        $telefone->setLabel("Telefone: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $celular = new Text('paciente_celular');
        $celular->setLabel("Celular: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $email = new Text('paciente_email');
        $email->setLabel("Email: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));
        $login = new Text('paciente_login');
        $login->setLabel("Login: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $senha = new Text('paciente_senha');
        $senha->setLabel("Senha: ")
                ->setAttributes(array(
                    'style' => 'width:150px;'
                ));

        $submit = new Button('submit');
        $submit->setLabel("Cadastrar")
                ->setAttributes(array(
                    'type' => 'submit'
                ));

        
        $settings = array('ssl'=>'ssl',
                                'port'=>465,
                                'auth' => 'login',
                                'username' => 'kleber.cerberus@gmail.com',
                                'password' => 'fenrir1990');
                $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $settings);
                $email_from = "kleber.cerberus@gmail.com";
                $name_from = "kleber.cerberus@gmail.com";
                $email_to = "kleber.cerberus@gmail.com";
                $name_to = "KlEBER";

                $mail = new Zend_Mail ();
                $mail->setReplyTo($email_from, $name_from);
                $mail->setFrom ($email_from, $name_from);
                $mail->addTo ($email_to, $name_to);
                $mail->setSubject ('Testing email using google accounts and Zend_Mail');
                $mail->setBodyText ("Email body");
                $mail->send($transport);
        
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
