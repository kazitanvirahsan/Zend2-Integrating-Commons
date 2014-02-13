<?php

namespace AlbumTest\Controller;

use AlbumTest\Bootstrap;
use Album\Controller\AlbumController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use PHPUnit_Framework_TestCase;

class AlbumControllerTest extends PHPUnit_Framework_TestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;
    
    protected function setUp()
    {   
        
        $serviceManager = Bootstrap::getServiceManager();            
        $this->controller = new AlbumController();
        
        
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'album'));
        $this->event      = new MvcEvent();

        $config = $serviceManager->get('Config');
        
        //print_r($config);
        //exit();
        
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);

        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($serviceManager);
    }

    
    public function testGetAlbumTableReturnsAnInstanceOfAlbumTable()
    {
        $this->assertInstanceOf('Album\Model\AlbumTable', $this->controller->getAlbumTable());
    }
}