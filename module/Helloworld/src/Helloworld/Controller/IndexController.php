<?php
    namespace Helloworld\Controller;
    
    use Zend\Mvc\Controller\AbstractActionController;
    use Zend\View\Model\ViewModel;
    
    class IndexController extends AbstractActionController  {
        public function indexAction()  {
            //print_r('ok');
            $views = new ViewModel(array('text'=> 'Hello World'));    
            return $views;
        }    
    }