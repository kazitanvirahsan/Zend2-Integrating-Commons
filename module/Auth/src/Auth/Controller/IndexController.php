<?php
    namespace Auth\Controller;
    use Zend\Mvc\Controller\AbstractActionController;
    use Zend\View\Model\ViewModel;
    use Zend\Authentication\AuthenticationService;
    use Zend\Authentication\Result;
    use Zend\Authentication\Adapter\DbTable as AuthAdapter;

    use  Auth\Form\Login;
    use  Auth\Model\User;

    class IndexController extends AbstractActionController  {

        protected  $authservice;

        public function indexAction()  {
              
            $this->checkLogin();
            $layout = $this->layout();
            $layout->setTemplate('layout/layout'); 
            $views = new ViewModel(array('text'=> 'Auth'));    
            return $views;
        } 

        public function getAuthService()
        {
            if (!$this->authservice) 
            {
                $this->authservice = $this->getServiceLocator()
                                          ->get('AuthService');
            }

        return $this->authservice;
        }         
  
        protected function checkLogin() {
            //if already login, redirect to success page
            if ($this->getAuthService()->hasIdentity()){
                return $this->redirect()->toRoute('album');
            }    
        }

        public function loginAction() {

            $this->checkLogin();
            $form = new Login;
            $request = $this->getRequest();
            
            
             

            // if the form is posted 
            if($request->isPost()) {

                $user = New User();    
                $form->setInputFilter($user->getInputFilter());
                // set the form with posted data
                $form->setData($request->getPost());
               
                // if the form is valid redirect to album  
                if($form->isValid())  {       
                    //check authentication...
                
                    $this->getAuthService()->getAdapter()
                                       ->setIdentity($request->getPost('username'))
                                       ->setCredential($request->getPost('password'));

                    // get authenticated  
                    $result = $this->getAuthService()->authenticate(); 

                    //$result = $this->getAuthService()->authenticate();
                    foreach($result->getMessages() as $message)
                    {
                        //save message temporary into flashmessenger
                        $this->flashmessenger()->addMessage($message);
                    }

                     
                    if($result->isValid()) 
                    {
                        $storage = $this->getAuthService()->getStorage();
                        $storage->write($request->getPost('username')); 
                        return $this->redirect()->toRoute('album'); 
                    } 
                }


            }  

            $this->layout('layout/layout');
            return new ViewModel(array( 'title' => 'User Authentication' , 
                                        'form' => $form , 
                                        'messages' => $this->flashmessenger()->getMessages()  ));

        }

        public function logoutAction() {
            $this->getAuthService()->clearIdentity();
            $this->flashmessenger()->addMessage('You\'ve been logged out');
            return $this->redirect()->toRoute('login');    
        }           
        
    }