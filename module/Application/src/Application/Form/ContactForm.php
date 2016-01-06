<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Factory;

class ContactForm extends Form
{
    public function __construct($name='contact')
    {
        parent::__construct($name);

        $this->setAttribute('method', 'get');

        $this->add([
            'name' => 'idcontact',
            'attributes' => [
                'type' => 'hidden',
                'value' => '0',
            ],
        ]);
        $this->add([
            'name' => 'nameuser',
            'attributes' => [
                'type' => 'text',
            ],
            'options' => [
                'label' => 'Name',
            ],
        ]);
        $this->add([
            'name' => 'email',
            'attributes' => [
                'type' => 'text',
            ],
            'options' => [
                'label' => 'E-mail',
            ],
        ]);
        $this->add([
            'name' => 'text',
            'attributes' => [
                'type' => 'textarea',
            ],
            'options' => [
                'label' => 'Text',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Post',
                'id' => 'submitbutton',
            ],
        ]);
    }
}
