<?php
    namespace Contactform\Controller;
    use Zend\Mvc\Controller\AbstractActionController;
    use Zend\View\Model\ViewModel;
    use Contactform\Form\ContactForm;
    
    class IndexController extends AbstractActionController  {
        public function indexAction()  {
            
            $form = new ContactForm();
            $views = new ViewModel(array('text'=> 'Contact us' ,  
                                         'form' => $form));    
            return $views;
        }    
    }