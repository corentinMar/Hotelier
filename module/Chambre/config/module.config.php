<?php
return  array ( 
     'controllers'  =>  array ( 
         'invokables'  =>  array ( 
             'Chambre\Controller\Chambre'  =>  'Chambre\Controller\ChambreController' ,
          ), 
     ),

     // La section suivante est nouveau et doit être ajouté à votre file 
     'router'  =>  array ( 
         'routes'  =>  array ( 
             'chambre'  =>  array ( 
                 'type'     =>  'segment' , 
                 'options'  =>  array ( 
                     'route'     =>  '/chambre[/][:action][/:id]' , 
                     'constraints'  =>  array ( 
                         'action'  =>  '[a-zA-Z][a-zA-Z0-9_-]*' , 
                         'id'      =>  '[0-9]+' , 
                     ), 
                     'defaults'  =>  array ( 
                         'controller'  =>  'Chambre\Controller\Chambre' , 
                         'action'      =>  'index' , 
                     ), 
                 ), 
             ), 
         ), 
     ),

      'view_manager'  =>  array ( 
         'template_path_stack'  =>  array ( 
             'chambre'  =>  __DIR__  .  '/../view' , 
         ), 
     ), 
 );