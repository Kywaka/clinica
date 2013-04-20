<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Clinica\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Clinica\Form\IndexForm;
use Clinica\Model\Index;
use Clinica\Model\IndexTable;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
     protected $IndexTable;

    public function indexAction() {
       
        $form = new IndexForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            //instancia do model fornecedor
            $login = new \Clinica\Model\Index();

            //Pegar os dados
            $data = $request->getPost();

            $form->setInputFilter($login->getInputFilter());
            $form->setData($data);
            if ($form->isValid()) {
                $login->exchangeArray($data);
                
                
                
                $this->getIndexTable()->getUser($login);
                $this->flashMessenger()->addMessage(array('sucess' => 'Cadastro efetuado com sucesso'));

                $this->redirect()->toUrl('/fornecedor/inicio');
            }
        }
        $viewModel = new \Zend\View\Model\ViewModel(array(
                    'form' => $form
                ));
        $viewModel->setTerminal(true);
        return $viewModel;
        
    }
      public function getIndexTable() {
        if (!$this->indexTable) {
            $sm = $this->getServiceLocator();
            $this->indexTable = $sm->get('index_table');
        }

        return $this->indexTable;
    }
}
