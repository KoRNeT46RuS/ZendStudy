<?php
//Я так понимаю формирует приходящие данные из Поста и фильтрует их а там хз
 namespace Admin\Model;

 use Zend\InputFilter\Factory as InputFactory;
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Blog implements InputFilterAwareInterface
 {
     public $idblog;
     public $title;
     public $article;
     public $text;

     protected $inputFilter;

     public function exchangeArray($data)
     {
         $this->idblog = (isset($data['idblog'])) ? $data['idblog'] : null;
         $this->title = (isset($data['title'])) ? $data['title'] : null;
         $this->article = (isset($data['article'])) ? $data['article'] : null;
         $this->text = (isset($data['text'])) ? $data['text'] : null;
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
         if(!$this->inputFilter){
             $inputFilter = new InputFilter();
             $factory = new InputFactory();

             $inputFilter->add($factory->createInput([
                 'name' => 'idblog',//Выборка поля
                 'required' => true, //Обязательность заполнения
                 'filter' => [
                     ['name' => 'Int'],
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
                             'max' => 100,
                         ],
                     ],
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
                             'max' => 250,
                         ],
                     ],
                 ],
             ]));
             $inputFilter->add($factory->createInput([
                 //Проверки
                 'name' => 'text',//Выборка поля
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
                             'max' => 3000,
                         ],
                     ],
                 ],
             ]));

             $this->inputFilter = $inputFilter;
         }
         return $this->inputFilter;
     }
 }