<?php

namespace Clinica\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Clinica\Form\PacienteForm;
use Clinica\Model\Paciente;
use Clinica\Model\PacienteTable;
use Zend\Uri\Http;

class PacienteController extends AbstractActionController {

    protected $pacienteTable;

    public function indexAction() {
        
    }

    public function getPacienteTable() {
        if (!$this->pacienteTable) {
            $sm = $this->getServiceLocator();
            $this->pacienteTable = $sm->get('paciente_table');
        }

        return $this->pacienteTable;
    }

    public function inicioAction() {
        $messages = $this->flashMessenger()->getMessages();

        $pageNumber = (int) $this->params()->fromQuery('pagina');
        if ($pageNumber == 0) {
            $pageNumber = 1;
        }
        $pacientes = $this->getPacienteTable()->fetchAll($pageNumber, 10);

        return new ViewModel(array(
                    'messages' => $messages,
                    'pacientes' => $pacientes,
                    'titulo' => 'Listagem de Pacientes'
                ));
    }

    public function novoAction() {

        $form = new PacienteForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model paciente
            $paciente = new Paciente();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($paciente->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $paciente->exchangeArray($data);
                $this->getPacienteTable()->savePaciente($paciente);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro efetuado com sucesso'));

                $this->redirect()->toUrl('/paciente/inicio');
            }
        }
        $view = new ViewModel(array(
                    'form' => $form
                ));
        $view->setTemplate('clinica/paciente/form.phtml');
        return $view;
    }

    public function editarAction() {

        $id = (int) $this->params('id');
        $paciente = $this->getPacienteTable()->getPaciente($id);
        $form = new PacienteForm();
        $form->setBindOnValidate(false);
        $form->bind($paciente);
        $form->get('submit')->setLabel('Alterar');

        // $request = $this->getRequest();
//
//        if ($request->isPost()) {
//            $nonFile = $request->getPost(); //->toArray(); Apenas dados, sem arquivos!
//            //$File = $this->params()->fromFiles('paciente_foto'); //Fotos
//            //$data = array_merge($nonFile, array('produto_foto'=> $File('name')));//Mesclar dados com arquivos.
//            $form->setData($nonFile);

        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model paciente
            $paciente = new Paciente();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($paciente->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $paciente->exchangeArray($data);
                $this->getPacienteTable()->savePaciente($paciente);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro atualizado com sucesso'));

                $this->redirect()->toUrl('/paciente/inicio');
            }
        }

//            if ($form->isValid()) {
//
////
////                $size = new Size(array('max' => 2000000));
////                $adapter = new Http();
////                $adapter->setValidators(array($size, $File['name']));
////
////                if ($adapter->isValid()) {
////                    $adapterError = $adapter->getMessages();
////                    $error = array();
////
////                    foreach ($adapterError as $row) {
////                        $error[] = $row;
////                    }
////                    $form->setMessages(array('paciente_foto' => $error));
////                } else {
////                    $diretorio = $request->getServer()->DOCUMENT_ROOT . '/conteudos/pacientes';
////                    $adapter->setDestination($diretorio);
////
////                    if ($adapter->receive($File['name'])) {
////                        $this->flashMessenger()->addMessage(array('sucess' => 'Foto enviada com sucesso'));
////                    } else {
////                        $this->flashMessenger()->addMessage(array('error' => 'Problemas ao enviar foto'));
////                    }
////                }
//
//                $this->getPacienteTable()->savePaciente($form->getData());
//                $this->flashMessenger()->addMessage(array('sucess' => 'Update realizado com sucesso'));
//                $this->redirect()->toUrl('/paciente');
//            }


        $view = new ViewModel(array(
                    'messages' => $messages,
                    'form' => $form
                ));
        $view->setTemplate('clinica/paciente/form.phtml');
        return $view;
    }

    public function removerAction() {

        $id = (int) $this->params('id');
        if (!$id) {
            return $this->redirect()->toUrl('/paciente/inicio');
        }
        $this->getPacienteTable()->removerPaciente($id);
        
        $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro removido com sucesso'));

        $this->redirect()->toUrl('/paciente/inicio');
    }

}

?>
