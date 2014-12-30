<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\RouteMatch;

class Module {

    protected $whitelist = array('login', 'login/process', 'utilisateur', 'utilisateur/add');
    public static $utilisateur = 0;

    public function onBootstrap(MvcEvent $e) {

        $app = $e->getApplication();
        $eventManager = $app->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $sm = $app->getServiceManager();

        $list = $this->whitelist;
        $auth = $sm->get('AuthService');

        $eventManager->attach(MvcEvent::EVENT_ROUTE, function($e) use ($list, $auth) {
            $match = $e->getRouteMatch();
            // No route match, this is a 404
            if (!($match instanceof RouteMatch)) {
                return;
            } else {
                // Route is whitelisted
                $name = $match->getMatchedRouteName();
                if (in_array($name, $list)) {
                    Module::$utilisateur = 0;
                    return;
                } else {
                    // User is authenticated
                    if ($auth->hasIdentity()) {
                        Module::$utilisateur = $auth->getIdentity();
                        return;
                    } else {
                        Module::$utilisateur = 0;
                        // Redirect to the user login page, as an example
                        $router = $e->getRouter();
                        $url = $router->assemble(array(), array(
                            'name' => 'login',
                        ));
                        $response = $e->getResponse();
                        $response->getHeaders()->addHeaderLine('Location', $url);
                        $response->setStatusCode(302);
                        return $response;
                    }
                }
            }
        }, -100);
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

}
