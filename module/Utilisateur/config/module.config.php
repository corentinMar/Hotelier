<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Utilisateur\Controller\Utilisateur' => 'Utilisateur\Controller\UtilisateurController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'utilisateur' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/utilisateur[/][:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Utilisateur\Controller\Utilisateur',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'utilisateur' => __DIR__ . '/../view',
        ),
    ),
);
