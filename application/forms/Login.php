<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author ejacwro
 */
class Application_Form_Login extends Zend_Form {
    
    public function init()
    {
        $this->setName('login_form');
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('e-mail')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
                ->addValidator('EmailAddress');
        
        $password = new Zend_Form_Element_Text('password');
        $password->setLabel('Password')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        
        $this->addElements(array($email, $password, $submit));
    }
}
