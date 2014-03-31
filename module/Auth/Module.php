<?php
namespace Auth;

use Zend\Db\Adapter\Adapter;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Authentication\AuthenticationService; 
 
	class Module {
	   public function getConfig() {
		 return include __DIR__ . '/config/module.config.php';
	   }
			  
		public function getAutoloaderConfig(){
		
			return array(
				'Zend\Loader\StandardAutoloader' => array(
					'namespaces' => array(
						__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
					)
				)
			);
		}


   public function onBootstrap($e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
        $controller = $e->getTarget();
        $controllerClass = get_class($controller);
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        $controller->layout($moduleNamespace . '/layout');
        }, 100);
    }  

	public function getServiceConfig()
	{
		return array(
			'factories' => array( 
				
				'db' => function($sm) {
					//echo PHP_EOL . "SM db-adapter executed." . PHP_EOL;
					$config = $sm->get('config');
					$config = $config['db'];
					//print_r($config);
					//exit();
					$dbAdapter = new Adapter($config);
					return $dbAdapter;
				},

				'AuthService' => function($sm) {
                    // get db adapter
					$dbAdapter = $sm->get('db');
                    $dbTableAuthAdapter  = new DbTableAuthAdapter($dbAdapter,
                                              'users','username','password'); 
                    $auth = new AuthenticationService();  
                    $auth->setAdapter($dbTableAuthAdapter);
                    return $auth;
				}
			),
		);
	}

	
		
}