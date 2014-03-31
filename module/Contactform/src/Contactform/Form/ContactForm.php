<?php

//source: http://framework.zend.com/manual/2.2/en/modules/zend.form.quick-start.html
namespace Contactform\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Captcha\Image as CaptchaImage; 

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
                'label' => 'Name'    
        ),	
        ));
        
        /* add email */
        $this->add(array(
        	'name' => 'email',
            'attributes' => array(
        	    'type' => 'Zend\Form\Element\Email',
        ),
            'options' => array(
                'label' => 'Email'            	
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
        
$captchaImage = new CaptchaImage(  array(
                'font' => './data/fonts/arial.ttf',
                'imgDir' => './public/captcha',
                'imgurl' => '/captcha',
                'width' => 250,
                'height' => 100,
                'dotNoiseLevel' => 40,
                'lineNoiseLevel' => 3)
        );

        //add captcha element...
        $this->add(array(
            'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'options' => array(
                'label' => 'Please verify you are human',
                'captcha' => $captchaImage,
            ),
        ));        
        
        $this->add(new Element\Csrf('secutiry'));
        
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