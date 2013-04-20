<?php

namespace Clinica\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Clinica\Form\AgendamentoForm;
use Clinica\Model\Agendamento;
use Clinica\Model\PacienteTable;
use Clinica\Model\AgendamentoTable;
use Zend\Uri\Http;

class AgendamentoController extends AbstractActionController {

    protected $agendamentoTable;

    public function indexAction() {
        
    }

    public function getAgendamentoTable() {
        if (!$this->agendamentoTable) {
            $sm = $this->getServiceLocator();
            $this->agendamentoTable = $sm->get('agendamento_table');
        }

        return $this->agendamentoTable;
    }
    
    

    public function inicioAction() {
        $messages = $this->flashMessenger()->getMessages();

        $pageNumber = (int) $this->params()->fromQuery('pagina');
        if ($pageNumber == 0) {
            $pageNumber = 1;
        }
        $agendamentos = $this->getPacienteTable()->fetchAll($pageNumber, 10);

        return new ViewModel(array(
                    'messages' => $messages,
                    'pacientes' => $agendamentos,
                    'titulo' => 'Listagem de Pacientes'
                ));
    }

    public function novoAction() {

        $form = new AgendamentoForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model agendamento
            $agendamento = new Agendamento();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($agendamento->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $agendamento->exchangeArray($data);
                $this->getAgendamentoTable()->saveAgendamento($agendamento);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro efetuado com sucesso'));

                $this->redirect()->toUrl('/agendamento/inicio');
            }
        }
        $view = new ViewModel(array(
                    'form' => $form
                ));
        $view->setTemplate('clinica/agendamento/form.phtml');
        return $view;
    }

    public function editarAction() {

        $id = (int) $this->params('id');
        $agendamento = $this->getAgendamentoTable()->getAgendamento($id);
        $form = new AgendamentoForm();
        $form->setBindOnValidate(false);
        $form->bind($agendamento);
        $form->get('submit')->setLabel('Alterar');

        // $request = $this->getRequest();
//
//        if ($request->isPost()) {
//            $nonFile = $request->getPost(); //->toArray(); Apenas dados, sem arquivos!
//            //$File = $this->params()->fromFiles('agendamento_foto'); //Fotos
//            //$data = array_merge($nonFile, array('produto_foto'=> $File('name')));//Mesclar dados com arquivos.
//            $form->setData($nonFile);

        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model agendamento
            $agendamento = new Agendamento();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($agendamento->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $agendamento->exchangeArray($data);
                $this->getAgendamentoTable()->saveAgendamento($agendamento);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro atualizado com sucesso'));

                $this->redirect()->toUrl('/agendamento/inicio');
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
////                    $form->setMessages(array('agendamento_foto' => $error));
////                } else {
////                    $diretorio = $request->getServer()->DOCUMENT_ROOT . '/conteudos/agendamentos';
////                    $adapter->setDestination($diretorio);
////
////                    if ($adapter->receive($File['name'])) {
////                        $this->flashMessenger()->addMessage(array('sucess' => 'Foto enviada com sucesso'));
////                    } else {
////                        $this->flashMessenger()->addMessage(array('error' => 'Problemas ao enviar foto'));
////                    }
////                }
//
//                $this->getAgendamentoTable()->saveAgendamento($form->getData());
//                $this->flashMessenger()->addMessage(array('sucess' => 'Update realizado com sucesso'));
//                $this->redirect()->toUrl('/agendamento');
//            }


        $view = new ViewModel(array(
                    'messages' => $messages,
                    'form' => $form
                ));
        $view->setTemplate('clinica/agendamento/form.phtml');
        return $view;
    }

    public function removerAction() {

        $id = (int) $this->params('id');
        if (!$id) {
            return $this->redirect()->toUrl('/agendamento/inicio');
        }
        $this->getAgendamentoTable()->removerAgendamento($id);
        
        $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro removido com sucesso'));

        $this->redirect()->toUrl('/agendamento/inicio');
    }

}

?>
