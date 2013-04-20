<?php

namespace Clinica\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Clinica\Form\ReceituarioForm;
use Clinica\Model\Receituario;
use Clinica\Model\ReceituarioTable;
use Zend\Uri\Http;

class ReceituarioController extends AbstractActionController {

    protected $receituarioTable;

    public function indexAction() {
        
    }

    public function getReceituarioTable() {
        if (!$this->receituarioTable) {
            $sm = $this->getServiceLocator();
            $this->receituarioTable = $sm->get('receituario_table');
        }

        return $this->receituarioTable;
    }

    public function inicioAction() {
        $messages = $this->flashMessenger()->getMessages();

        $pageNumber = (int) $this->params()->fromQuery('pagina');
        if ($pageNumber == 0) {
            $pageNumber = 1;
        }
        $receituarios = $this->getReceituarioTable()->fetchAll($pageNumber, 10);

        return new ViewModel(array(
                    'messages' => $messages,
                    'receituarios' => $receituarios,
                    'titulo' => 'Listagem de Receituarios'
                ));
    }

    public function novoAction() {

        $form = new ReceituarioForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model receituario
            $receituario = new Receituario();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($receituario->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $receituario->exchangeArray($data);
                $this->getReceituarioTable()->saveReceituario($receituario);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro efetuado com sucesso'));

                $this->redirect()->toUrl('/receituario/inicio');
            }
        }
        $view = new ViewModel(array(
                    'form' => $form
                ));
        $view->setTemplate('clinica/receituario/form.phtml');
        return $view;
    }

    public function editarAction() {

        $id = (int) $this->params('id');
        $receituario = $this->getReceituarioTable()->getReceituario($id);
        $form = new ReceituarioForm();
        $form->setBindOnValidate(false);
        $form->bind($receituario);
        $form->get('submit')->setLabel('Alterar');



        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model receituario
            $receituario = new Receituario();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($receituario->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $receituario->exchangeArray($data);
                $this->getReceituarioTable()->saveReceituario($receituario);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro atualizado com sucesso'));

                $this->redirect()->toUrl('/receituario/inicio');
            }
        }




        $view = new ViewModel(array(
                    'messages' => $messages,
                    'form' => $form
                ));
        $view->setTemplate('clinica/receituario/form.phtml');
        return $view;
    }

    public function removerAction() {

        $id = (int) $this->params('id');
        if (!$id) {
            return $this->redirect()->toUrl('/receituario/inicio');
        }
        $this->getReceituarioTable()->removerReceituario($id);
        
        $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro removido com sucesso'));

        $this->redirect()->toUrl('/receituario/inicio');
    }

}

?>
