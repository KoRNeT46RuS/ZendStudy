<?php
namespace MyAuth;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

class Adapter implements AdapterInterface
{
    public function __construct()
    {

    }

    public function authenticate()
    {
        return new Result();
    }
}
//Result():
//isValid() - возвращает TRUE, если результат представляет собой удачную попытку аутентификации
//getCode() – определение типа ошибки аутентификации
//getIdentity() – возвращает личность пытающегося идентифицироваться
//getMessages() - возвращает массив сообщений о неудачной попытке аутентификации