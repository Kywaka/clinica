<?php

namespace Clinica\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Clinica\Form\FuncionarioForm;
use Clinica\Model\Funcionario;
use Clinica\Model\FuncionarioTable;
use Zend\Uri\Http;

class FuncionarioController extends AbstractActionController {

    protected $funcionarioTable;

    public function indexAction() {
        
    }

    public function getFuncionarioTable() {
        if (!$this->funcionarioTable) {
            $sm = $this->getServiceLocator();
            $this->funcionarioTable = $sm->get('funcionario_table');
        }

        return $this->funcionarioTable;
    }

    public function inicioAction() {
        $messages = $this->flashMessenger()->getMessages();

        $pageNumber = (int) $this->params()->fromQuery('pagina');
        if ($pageNumber == 0) {
            $pageNumber = 1;
        }
        $funcionarios = $this->getFuncionarioTable()->fetchAll($pageNumber, 10);

        return new ViewModel(array(
                    'messages' => $messages,
                    'funcionarios' => $funcionarios,
                    'titulo' => 'Listagem de Funcionarios'
                ));
    }

    public function novoAction() {

        $form = new FuncionarioForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model funcionario
            $funcionario = new Funcionario();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($funcionario->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $funcionario->exchangeArray($data);
                $this->getFuncionarioTable()->saveFuncionario($funcionario);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro efetuado com sucesso'));

                $this->redirect()->toUrl('/funcionario/inicio');
            }
        }
        $view = new ViewModel(array(
                    'form' => $form
                ));
        $view->setTemplate('clinica/funcionario/form.phtml');
        return $view;
    }

    public function editarAction() {

        $id = (int) $this->params('id');
        $funcionario = $this->getFuncionarioTable()->getFuncionario($id);
        $form = new FuncionarioForm();
        $form->setBindOnValidate(false);
        $form->bind($funcionario);
        $form->get('submit')->setLabel('Alterar');

        // $request = $this->getRequest();
//
//        if ($request->isPost()) {
//            $nonFile = $request->getPost(); //->toArray(); Apenas dados, sem arquivos!
//            //$File = $this->params()->fromFiles('funcionario_foto'); //Fotos
//            //$data = array_merge($nonFile, array('produto_foto'=> $File('name')));//Mesclar dados com arquivos.
//            $form->setData($nonFile);

        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model funcionario
            $funcionario = new Funcionario();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($funcionario->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $funcionario->exchangeArray($data);
                $this->getFuncionarioTable()->saveFuncionario($funcionario);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro atualizado com sucesso'));

                $this->redirect()->toUrl('/funcionario/inicio');
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
////                    $form->setMessages(array('funcionario_foto' => $error));
////                } else {
////                    $diretorio = $request->getServer()->DOCUMENT_ROOT . '/conteudos/funcionarios';
////                    $adapter->setDestination($diretorio);
////
////                    if ($adapter->receive($File['name'])) {
////                        $this->flashMessenger()->addMessage(array('sucess' => 'Foto enviada com sucesso'));
////                    } else {
////                        $this->flashMessenger()->addMessage(array('error' => 'Problemas ao enviar foto'));
////                    }
////                }
//
//                $this->getFuncionarioTable()->saveFuncionario($form->getData());
//                $this->flashMessenger()->addMessage(array('sucess' => 'Update realizado com sucesso'));
//                $this->redirect()->toUrl('/funcionario');
//            }


        $view = new ViewModel(array(
                    'messages' => $messages,
                    'form' => $form
                ));
        $view->setTemplate('clinica/funcionario/form.phtml');
        return $view;
    }

    public function removerAction() {

        $id = (int) $this->params('id');
        if (!$id) {
            return $this->redirect()->toUrl('/funcionario/inicio');
        }
        $this->getFuncionarioTable()->removerFuncionario($id);
        
        $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro removido com sucesso'));

        $this->redirect()->toUrl('/funcionario/inicio');
    }

}

?>
