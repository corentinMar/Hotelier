<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Extra\Controller\Extra' => 'Extra\Controller\ExtraController',
        ),
    ),
    // La section suivante est nouveau et doit être ajouté à votre file
    'router' => array(
        'routes' => array(
            'extra' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/extra[/][:action][/:idChambre][/:idDouche]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'idChambre' => '[0-9]+',
                        'idDouche' => '[0-9]+',
                     
                       
                      
                    ),
                    'defaults' => array(
                        'controller' => 'Extra\Controller\Extra',
                        'action' => 'index',
                   
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'extra' => __DIR__ . '/../view',
        ),
    ),
);
