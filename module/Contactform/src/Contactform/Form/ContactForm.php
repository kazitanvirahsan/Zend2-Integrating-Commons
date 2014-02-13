<?php

//source: http://framework.zend.com/manual/2.2/en/modules/zend.form.quick-start.html

namespace Contactform\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Captcha\Figlet as Figlet;

class ContactForm extends Form
{
    protected $captcha;
    
    public function __construct()
    {
        
        // we want to ignore the name passed
        parent::__construct('contact');
        $this->setAttribute('method', 'post');
        
       
        /* add name */
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
        	    'type' => 'Text',    
        ),
            'options' => array (
                'label' => 'Your Name'    
        ),	
        ));
        
        /* add email */
        $this->add(array(
        	'name' => 'email',
            'attributes' => array(
        	    'type' => 'Zend\Form\Element\Email',
        ),
            'options' => array(
                'label' => 'Your email address'            	
        ),
        ));
        
        /* add message */
        $this->add(array(
        	'name' => 'message' ,
            'attributes' => array(
        	    'type' => 'Zend\Form\Element\Textarea'
        ),
            'options' => array(
        	    'label' => 'Message'
        ),
        ));
        
        
        // Originating request:
        $captcha = new Figlet(array(
            'name' => 'foo',
            'wordLen' => 6,
            'timeout' => 300,
        ));
        
        $id = $captcha->generate();
        
        // add capcha
       
        $this->add(array(
            'name' => 'capcha',
            'attributes' => array(
        	    'type' => 'Zend\Form\Element\Captcha' 
        ),
            'options'=> array(
        	    'label' => 'Please verify you are human',
                'capcha' => $captcha,
        )	
        ));
        
        
        //$this->add(new Element\Csrf('secutiry'));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}