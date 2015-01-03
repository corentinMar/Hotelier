<?php

namespace Extra;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Extra\Model\DoucheTable' => function($sm) {
                    $tableGateway = $sm->get('DoucheTableGateway');
                    $table = new Model\DoucheTable($tableGateway);
                    return $table;
                },
                'DoucheTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Douche());
                    return new TableGateway('douche', $dbAdapter, null, $resultSetPrototype);
                },
                'Extra\Model\TelevisionTable' => function($sm) {
                    $tableGateway = $sm->get('TelevisionTableGateway');
                    $table = new Model\TelevisionTable($tableGateway);
                    return $table;
                },
                'TelevisionTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Television());
                    return new TableGateway('television', $dbAdapter, null, $resultSetPrototype);
                },
                'Extra\Model\FrigoTable' => function($sm) {
                    $tableGateway = $sm->get('FrigoTableGateway');
                    $table = new Model\FrigoTable($tableGateway);
                    return $table;
                },
                'FrigoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Frigo());
                    return new TableGateway('frigo', $dbAdapter, null, $resultSetPrototype);
                },
                'Extra\Model\BaignoireTable' => function($sm) {
                    $tableGateway = $sm->get('BaignoireTableGateway');
                    $table = new Model\BaignoireTable($tableGateway);
                    return $table;
                },
                'BaignoireTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Baignoire());
                    return new TableGateway('baignoire', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

}
