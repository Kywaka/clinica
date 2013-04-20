<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Clinica;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Clinica\Model\PacienteTable;
use Clinica\Model\FornecedorTable;
use Clinica\Model\ProcedimentoTable;
use Clinica\Model\FuncionarioTable;
use Clinica\Model\EstoqueTable;
use Clinica\Model\ReceituarioTable;
use Clinica\Model\IndexTable;
use Clinica\Model\AgendamentoTable;
use Clinica\Model\AtestadoTable;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'paciente_table' => function($sm) {
                    $adapter = $sm->get('zend_db_adapter');
                    $table = new PacienteTable($adapter);
                    return $table;
                },
                'fornecedor_table' => function($sm) {
                    $adapter = $sm->get('zend_db_adapter');
                    $table = new FornecedorTable($adapter);
                    return $table;
                },
                        'receituario_table' => function($sm) {
                    $adapter = $sm->get('zend_db_adapter');
                    $table = new ReceituarioTable($adapter);
                    return $table;
                },
                    'atestado_table' => function($sm) {
                    $adapter = $sm->get('zend_db_adapter');
                    $table = new AtestadoTable($adapter);
                    return $table;
                },
                'procedimento_table' => function($sm) {
                    $adapter = $sm->get('zend_db_adapter');
                    $table = new ProcedimentoTable($adapter);
                    return $table;
                },
                'funcionario_table' => function($sm) {
                    $adapter = $sm->get('zend_db_adapter');
                    $table = new FuncionarioTable($adapter);
                    return $table;
                },
                        'estoque_table' => function($sm) {
                    $adapter = $sm->get('zend_db_adapter');
                    $table = new EstoqueTable($adapter);
                    return $table;
                },
                'index_table' => function($sm) {
                    $adapter = $sm->get('zend_db_adapter');
                    $table = new IndexTable($adapter);
                    return $table;
                },
                'agendamento_table' => function($sm) {
                    $adapter = $sm->get('zend_db_adapter');
                    $table = new AgendamentoTable($adapter);
                    return $table;
                },
            ),
        );
    }

}
