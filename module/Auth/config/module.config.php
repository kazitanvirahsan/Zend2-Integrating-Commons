<?php

  return array(     
      'router' => array(
          'routes'      => array(
              'home' => array(
                  'type' => 'Zend\Mvc\Router\Http\Literal',
                  'options' => array(
                      'route'   => '/auth',
                      'defaults' => array(
                          'controller' => 'Auth\Controller\Index',
                          'action'     => 'index',
                      )
                  )
              ),

              'login' => array(
                  'type' => 'Zend\Mvc\Router\Http\Literal',
                  'options' => array(
                      'route'   => '/login',
                      'defaults' => array(
                          'controller' => 'Auth\Controller\Index',
                          'action'     => 'login',
                      )
                  )
              ),
           
               'logout' => array(
                  'type' => 'Zend\Mvc\Router\Http\Literal',
                  'options' => array(
                      'route'   => '/logout',
                      'defaults' => array(
                          'controller' => 'Auth\Controller\Index',
                          'action'     => 'logout',
                      )
                  )
              ),


          )
      ),

    
      'controllers' => array(
          'invokables' => array(
              'Auth\Controller\Index'
              => 'Auth\Controller\IndexController',
          )
      ),
      
      'translator' => array(
          'locale' => 'en_US',
          'translation_file_patterns' => array(
              array(
                  'type'     => 'gettext',
                  'base_dir' => __DIR__ . '/../language',
                  'pattern'  => '%s.mo',
              ),
          ),
      ),  
      
     'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'Auth/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'Auth/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
      
  );