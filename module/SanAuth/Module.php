<?php

namespace SanAuth;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Db\ResultSet\ResultSet;
use SanAuth\Model\Utilisateur;
use SanAuth\Model\SanAuthTable;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoloaderProviderInterface {

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
                'SanAuth\Model\MyAuthStorage' => function($sm) {
                    return new \SanAuth\Model\MyAuthStorage('hotelier');
                },
                'AuthService' => function($sm) {
                    //My assumption, you've alredy set dbAdapter
                    //and has users table with columns : user_name and pass_word
                    //that password hashed with md5
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter, 'utilisateur', 'nom', 'motDePasse', 'administrateur'); //, 'MD5(?)');

                    $authService = new AuthenticationService();
                    $authService->setAdapter($dbTableAuthAdapter);
                    $authService->setStorage($sm->get('SanAuth\Model\MyAuthStorage'));

                    return $authService;
                },
                'SanAuth\Model\SanAuthTable' => function($sm) {
                    $tableGateway = $sm->get('SanAuthTableGateway');
                    $table = new SanAuthTable($tableGateway);
                    return $table;
                },
                'SanAuthTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Utilisateur());
                    return new TableGateway('utilisateur', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

}
