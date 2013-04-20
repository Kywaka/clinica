<?php

namespace Clinica\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Clinica\Form\EstoqueForm;
use Clinica\Model\Estoque;
use Clinica\Model\EstoqueTable;
use Zend\Uri\Http;

class EstoqueController extends AbstractActionController {

    protected $estoqueTable;

    public function indexAction() {
        
    }

    public function getEstoqueTable() {
        if (!$this->estoqueTable) {
            $sm = $this->getServiceLocator();
            $this->estoqueTable = $sm->get('estoque_table');
        }

        return $this->estoqueTable;
    }

    public function inicioAction() {
        $messages = $this->flashMessenger()->getMessages();

        $pageNumber = (int) $this->params()->fromQuery('pagina');
        if ($pageNumber == 0) {
            $pageNumber = 1;
        }
        $estoques = $this->getEstoqueTable()->fetchAll($pageNumber, 10);

        return new ViewModel(array(
                    'messages' => $messages,
                    'estoques' => $estoques,
                    'titulo' => 'Listagem de Estoques'
                ));
    }

    public function novoAction() {

        $form = new EstoqueForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model estoque
            $estoque = new Estoque();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($estoque->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $estoque->exchangeArray($data);
                $this->getEstoqueTable()->saveEstoque($estoque);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro efetuado com sucesso'));

                $this->redirect()->toUrl('/estoque/inicio');
            }
        }
        $view = new ViewModel(array(
                    'form' => $form
                ));
        $view->setTemplate('clinica/estoque/form.phtml');
        return $view;
    }

    public function editarAction() {

        $id = (int) $this->params('id');
        $estoque = $this->getEstoqueTable()->getEstoque($id);
        $form = new EstoqueForm();
        $form->setBindOnValidate(false);
        $form->bind($estoque);
        $form->get('submit')->setLabel('Alterar');



        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model estoque
            $estoque = new Estoque();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($estoque->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $estoque->exchangeArray($data);
                $this->getEstoqueTable()->saveEstoque($estoque);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro atualizado com sucesso'));

                $this->redirect()->toUrl('/estoque/inicio');
            }
        }




        $view = new ViewModel(array(
                    'messages' => $messages,
                    'form' => $form
                ));
        $view->setTemplate('clinica/estoque/form.phtml');
        return $view;
    }

    public function removerAction() {

        $id = (int) $this->params('id');
        if (!$id) {
            return $this->redirect()->toUrl('/estoque/inicio');
        }
        $this->getEstoqueTable()->removerEstoque($id);
        
        $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro removido com sucesso'));

        $this->redirect()->toUrl('/estoque/inicio');
    }

}

?>
