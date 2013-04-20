<?php

namespace Clinica\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Clinica\Form\FornecedorForm;
use Clinica\Model\Fornecedor;
use Clinica\Model\FornecedorTable;
use Zend\Uri\Http;

class FornecedorController extends AbstractActionController {

    protected $fornecedorTable;

    public function indexAction() {
        
    }

    public function getFornecedorTable() {
        if (!$this->fornecedorTable) {
            $sm = $this->getServiceLocator();
            $this->fornecedorTable = $sm->get('fornecedor_table');
        }

        return $this->fornecedorTable;
    }

    public function inicioAction() {
        $messages = $this->flashMessenger()->getMessages();

        $pageNumber = (int) $this->params()->fromQuery('pagina');
        if ($pageNumber == 0) {
            $pageNumber = 1;
        }
        $fornecedores = $this->getFornecedorTable()->fetchAll($pageNumber, 10);

        return new ViewModel(array(
                    'messages' => $messages,
                    'fornecedores' => $fornecedores,
                    'titulo' => 'Listagem de Fornecedores'
                ));
    }

    public function novoAction() {

        $form = new FornecedorForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model fornecedor
            $fornecedor = new Fornecedor();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($fornecedor->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $fornecedor->exchangeArray($data);
                $this->getFornecedorTable()->saveFornecedor($fornecedor);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro efetuado com sucesso'));

                $this->redirect()->toUrl('/fornecedor/inicio');
            }
        }
        $view = new ViewModel(array(
                    'form' => $form
                ));
        $view->setTemplate('clinica/fornecedor/form.phtml');
        return $view;
    }

    public function editarAction() {

        $id = (int) $this->params('id');
        $fornecedor = $this->getFornecedorTable()->getFornecedor($id);
        $form = new FornecedorForm();
        $form->setBindOnValidate(false);
        $form->bind($fornecedor);
        $form->get('submit')->setLabel('Alterar');



        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model fornecedor
            $fornecedor = new Fornecedor();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($fornecedor->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $fornecedor->exchangeArray($data);
                $this->getFornecedorTable()->saveFornecedor($fornecedor);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro atualizado com sucesso'));

                $this->redirect()->toUrl('/fornecedor/inicio');
            }
        }



        $view = new ViewModel(array(
                    'messages' => $messages,
                    'form' => $form
                ));
        $view->setTemplate('clinica/fornecedor/form.phtml');
        return $view;
    }

    public function removerAction() {

        $id = (int) $this->params('id');
        if (!$id) {
            return $this->redirect()->toUrl('/fornecedor/inicio');
        }
        $this->getFornecedorTable()->removerFornecedor($id);
        
        $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro removido com sucesso'));

        $this->redirect()->toUrl('/fornecedor/inicio');
    }

}

?>