<?php
return  array ( 
     'controllers'  =>  array ( 
         'invokables'  =>  array ( 
             'Hotel\Controller\Hotel'  =>  'Hotel\Controller\HotelController' ,
          ), 
     ),

     // La section suivante est nouveau et doit être ajouté à votre file 
     'router'  =>  array ( 
         'routes'  =>  array ( 
             'hotel'  =>  array ( 
                 'type'     =>  'segment' , 
                 'options'  =>  array ( 
                     'route'     =>  '/hotel[/][:action][/:idHotel]' , 
                     'constraints'  =>  array ( 
                         'action'  =>  '[a-zA-Z][a-zA-Z0-9_-]*' , 
                         'idHotel'      =>  '[0-9]+' , 
                     ), 
                     'defaults'  =>  array ( 
                         'controller'  =>  'Hotel\Controller\Hotel' , 
                         'action'      =>  'index' , 
                     ), 
                 ), 
             ), 
         ), 
     ),

      'view_manager'  =>  array ( 
         'template_path_stack'  =>  array ( 
             'hotel'  =>  __DIR__  .  '/../view' , 
         ), 
     ), 
 );