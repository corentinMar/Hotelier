<?php

namespace Hotel;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Hotel\Model\Hotel;
use Hotel\Model\HotelTable;
use Hotel\Model\Proprietaire;
use Hotel\Model\ProprietaireTable;
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
                'Hotel\Model\HotelTable' => function($sm) {
                    $tableGateway = $sm->get('HotelTableGateway');
                    $table = new HotelTable($tableGateway);
                    return $table;
                },
                'HotelTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Hotel());
                    return new TableGateway('hotel', $dbAdapter, null, $resultSetPrototype);
                },
                'Hotel\Model\ProprietaireTable' => function($sm) {
                    $tableGateway = $sm->get('ProprietaireTableGateway');
                    $table = new ProprietaireTable($tableGateway);
                    return $table;
                },
                'ProprietaireTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Proprietaire());
                    return new TableGateway('utilisateur', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

}
