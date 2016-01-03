<?php

namespace Page\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class PageForm extends Form
{
    //генерация формы
    public function __construct($name = 'page')//$name - Название формы
    {
        parent::__construct('page');

        //Настраиваем атребуты
        $this->setAttribute('method', 'post');
        //$this->setAttribute('target', '__blank');
        $this->setAttribute('enctype', 'application/x-www-form-urlencoded');
        $this->setAttribute('id', 'pageform');

        //Добавляем элементы в форму
        $this->add([
            'name' => 'idpage',
            'attributes' => [
                'type' => 'hidden',
                'value' => '0',//Передача значения нового пользователя по умолчанию
            ],

        ]);
        $this->add([
            'name' => 'article',
            'attribute' => [
                'type' => 'textarea',
            ],
            'options' => [
                'label' => 'Description',
            ],
        ]);
        $this->add([
            'name' => 'pub',
            'attribute' => [
                'type' => 'text',
            ],
            'options' => [
                'label' => 'Pub Data',
            ],
        ]);
        //Другой способ добавления
        $title = new Element('title');
        $title->setAttribute('type', 'text');
        $title->setLabel('Title');//Заголовок
        $this->add($title);
        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'go',
                'id' => 'submitbutton',
            ],
        ]);

    }
}