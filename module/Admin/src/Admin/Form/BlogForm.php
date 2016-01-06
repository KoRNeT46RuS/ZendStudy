<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class BlogForm extends Form
{
    public function __construct($name = 'blog')
    {
        parent::__construct($name);

        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'application/x-www-form-urlencoded');
        $this->setAttribute('id', 'blogform');

        $this->add([
            'name' => 'idblog',
            'attributes' => [
                'type' => 'hidden',
                'value' => '0',
            ],
        ]);
        $this->add([
            'name' => 'title',
            'attributes' => [
                'type' => 'text',
            ],
            'options' => [
                'label' => 'Title',
            ],
        ]);
        $this->add([
            'name' => 'article',
            'attributes' => [
                'type' => 'textarea',
            ],
            'options' => [
                'label' => 'Article',
            ],
        ]);
        $this->add([
            'name' => 'text',
            'attributes' => [
                'type' => 'textarea',
            ],
            'options' => [
                'label' => 'Text of post',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Add',
                'id' => 'submitbutton',
            ],
        ]);
    }
}