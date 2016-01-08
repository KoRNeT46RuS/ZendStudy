<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class LoginForm extends Form
{
    public function __construct($name = 'login')
    {
        parent::__construct($name);

        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'application/x-www-form-urlencoded');
        $this->setAttribute('id', 'login');

        $this->add([
            'name' => 'idadmin',
            'attributes' => [
                'type' => 'hidden',
                'value' => '0',
            ],
        ]);

        $this->add([
            'name' => 'login',
            'attributes' => [
                'type' => 'text',
            ],
            'options' => [
                'label' => 'Login: ',
            ],
        ]);

        $this->add([
            'name' => 'password',
            'attributes' => [
                'type' => 'password',
            ],
            'options' => [
                'label' => 'Password: ',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Login',
                'id' => 'submitbutton',
            ],
        ]);
    }
}