<?php

namespace Clinica\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Clinica\Form\AtestadoForm;
use Clinica\Model\Atestado;
use Clinica\Model\AtestadoTable;
use Zend\Uri\Http;

class AtestadoController extends AbstractActionController {

    protected $atestadoTable;

    public function indexAction() {
        
    }

    public function getAtestadoTable() {
        if (!$this->atestadoTable) {
            $sm = $this->getServiceLocator();
            $this->atestadoTable = $sm->get('atestado_table');
        }

        return $this->atestadoTable;
    }

    public function inicioAction() {
        $messages = $this->flashMessenger()->getMessages();

        $pageNumber = (int) $this->params()->fromQuery('pagina');
        if ($pageNumber == 0) {
            $pageNumber = 1;
        }
        $atestados = $this->getAtestadoTable()->fetchAll($pageNumber, 10);

        return new ViewModel(array(
                    'messages' => $messages,
                    'atestados' => $atestados,
                    'titulo' => 'Listagem de Atestados'
                ));
    }

    public function novoAction() {

        $form = new AtestadoForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model atestado
            $atestado = new Atestado();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($atestado->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $atestado->exchangeArray($data);
                $this->getAtestadoTable()->saveAtestado($atestado);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro efetuado com sucesso'));

                $this->redirect()->toUrl('/atestado/inicio');
            }
        }
        $view = new ViewModel(array(
                    'form' => $form
                ));
        $view->setTemplate('clinica/atestado/form.phtml');
        return $view;
    }

    public function editarAction() {

        $id = (int) $this->params('id');
        $atestado = $this->getAtestadoTable()->getAtestado($id);
        $form = new AtestadoForm();
        $form->setBindOnValidate(false);
        $form->bind($atestado);
        $form->get('submit')->setLabel('Alterar');



        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model atestado
            $atestado = new Atestado();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($atestado->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $atestado->exchangeArray($data);
                $this->getAtestadoTable()->saveAtestado($atestado);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro atualizado com sucesso'));

                $this->redirect()->toUrl('/atestado/inicio');
            }
        }




        $view = new ViewModel(array(
                    'messages' => $messages,
                    'form' => $form
                ));
        $view->setTemplate('clinica/atestado/form.phtml');
        return $view;
    }

    public function removerAction() {

        $id = (int) $this->params('id');
        if (!$id) {
            return $this->redirect()->toUrl('/atestado/inicio');
        }
        $this->getAtestadoTable()->removerAtestado($id);
        
        $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro removido com sucesso'));

        $this->redirect()->toUrl('/atestado/inicio');
    }

}

?>
