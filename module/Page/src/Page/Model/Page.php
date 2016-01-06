<?php

namespace Page\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Form\Annotation;


class Page implements  InputFilterAwareInterface
{
    public $idpage;
    public $title;
    public $article;
    public $pub;

    protected $inputFilter;

    //получаем массив из базы и заполняем его
    public function exchangeArray($data)
    {
        $this->idpage = (isset($data['idpage'])) ? $data['idpage'] : null;
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->article = (isset($data['article'])) ? $data['article'] : null;
        $this->pub = (isset($data['pub'])) ? $data['pub'] : null;

    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception('Не используется');
    }

    public function getInputFilter()
    {
        //Проверяем существование фильтра
        if(!$this->inputFilter){
            $inputFilter = new InputFilter();
            //Создаем фабрику
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput([
                //Проверки
                'name' => 'idpage',//Выборка поля
                'required' => true, //Обязательность заполнения
                'filter' => [
                    ['name' => 'Int'],//Тип фильтра
                ],
            ]));
            $inputFilter->add($factory->createInput([
                //Проверки
                'name' => 'article',//Выборка поля
                'required' => true, //Обязательность заполнения
                'filter' => [
                    ['name' => 'StripTags'],//Тип фильтра (Удаляем теги)
                    ['name' => 'StringTrim'],//Удаляем пробелы
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',//Количество символов
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 10,
                            'max' => 1000,
                        ],
                    ],
                ],
            ]));
            $inputFilter->add($factory->createInput([
                //Проверки
                'name' => 'title',//Выборка поля
                'required' => true, //Обязательность заполнения
                'filter' => [
                    ['name' => 'StripTags'],//Тип фильтра (Удаляем теги)
                    ['name' => 'StringTrim'],//Удаляем пробелы
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',//Количество символов
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 10,
                            'max' => 50,
                        ],
                    ],
                ],
            ]));

            $this->inputFilter = $inputFilter;
        }
            return $this->inputFilter;
    }
}