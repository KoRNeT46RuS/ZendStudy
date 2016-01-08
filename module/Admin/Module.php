<?php

namespace Admin;

use Admin\Model\AdminTable;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Admin\Model\BlogTable;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Admin\Model\BlogTable' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table     = new BlogTable($dbAdapter);
                    return $table;
                },
                'Admin\Model\AdminTable' =>  function($sm1) {
                    $dbAdapter1 = $sm1->get('Zend\Db\Adapter\Adapter');
                    $table1     = new AdminTable($dbAdapter1);
                    return $table1;
                },
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}