<?php

namespace Clinica\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Clinica\Form\ProcedimentoForm;
use Clinica\Model\Procedimento;
use Clinica\Model\ProcedimentoTable;
use Zend\Uri\Http;

class ProcedimentoController extends AbstractActionController {

    protected $procedimentoTable;

    public function indexAction() {
        
    }

    public function getProcedimentoTable() {
        if (!$this->procedimentoTable) {
            $sm = $this->getServiceLocator();
            $this->procedimentoTable = $sm->get('procedimento_table');
        }

        return $this->procedimentoTable;
    }

    public function inicioAction() {
        $messages = $this->flashMessenger()->getMessages();

        $pageNumber = (int) $this->params()->fromQuery('pagina');
        if ($pageNumber == 0) {
            $pageNumber = 1;
        }
        $procedimentos = $this->getProcedimentoTable()->fetchAll($pageNumber, 10);

        return new ViewModel(array(
                    'messages' => $messages,
                    'procedimentos' => $procedimentos,
                    'titulo' => 'Listagem de Procedimentos'
                ));
    }

    public function novoAction() {

        $form = new ProcedimentoForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model procedimento
            $procedimento = new Procedimento();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($procedimento->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $procedimento->exchangeArray($data);
                $this->getProcedimentoTable()->saveProcedimento($procedimento);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro efetuado com sucesso'));

                $this->redirect()->toUrl('/procedimento/inicio');
            }
        }
        $view = new ViewModel(array(
                    'form' => $form
                ));
        $view->setTemplate('clinica/procedimento/form.phtml');
        return $view;
    }

    public function editarAction() {

        $idProcedimento = (int)$this->params('id');
        $procedimento = $this->getProcedimentoTable()->getProcedimento($idProcedimento);
        $form = new ProcedimentoForm();
        $form->setBindOnValidate(false);
        $form->bind($procedimento);
        $form->get('submit')->setLabel('Alterar');

        // $request = $this->getRequest();
//
//        if ($request->isPost()) {
//            $nonFile = $request->getPost(); //->toArray(); Apenas dados, sem arquivos!
//            //$File = $this->params()->fromFiles('procedimento_foto'); //Fotos
//            //$data = array_merge($nonFile, array('produto_foto'=> $File('name')));//Mesclar dados com arquivos.
//            $form->setData($nonFile);

        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model procedimento
            $procedimento = new Procedimento;

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($procedimento->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $procedimento->exchangeArray($data);
                $this->getProcedimentoTable()->saveProcedimento($procedimento);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro atualizado com sucesso'));

                $this->redirect()->toUrl('/procedimento/inicio');
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
////                    $form->setMessages(array('procedimento_foto' => $error));
////                } else {
////                    $diretorio = $request->getServer()->DOCUMENT_ROOT . '/conteudos/procedimentos';
////                    $adapter->setDestination($diretorio);
////
////                    if ($adapter->receive($File['name'])) {
////                        $this->flashMessenger()->addMessage(array('sucess' => 'Foto enviada com sucesso'));
////                    } else {
////                        $this->flashMessenger()->addMessage(array('error' => 'Problemas ao enviar foto'));
////                    }
////                }
//
//                $this->getProcedimentoTable()->saveProcedimento($form->getData());
//                $this->flashMessenger()->addMessage(array('sucess' => 'Update realizado com sucesso'));
//                $this->redirect()->toUrl('/procedimento');
//            }


        $view = new ViewModel(array(
                    'messages' => $messages,
                    'form' => $form
                ));
        $view->setTemplate('clinica/procedimento/form.phtml');
        return $view;
    }

    public function removerAction() {

        $idProcedimento = (int) $this->params('id');
        if (!$idProcedimento) {
            return $this->redirect()->toUrl('/procedimento/inicio');
        }
        $this->getProcedimentoTable()->removerProcedimento($idProcedimento);
        
        $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro removido com sucesso'));

        $this->redirect()->toUrl('/procedimento/inicio');
    }

}

?>