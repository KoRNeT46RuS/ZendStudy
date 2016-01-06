<?php
namespace Application\Model;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

class MyAdapter implements AdapterInterface
{
    public $username;
    public $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticate()
    {
        $flag = ($this->username == "admin" && $this->password="qwerty") ? true : false;
        if ($flag){
            return new Result(Result::SUCCESS, "user");
        }else{
            return new Result(Result::FAILURE, "guest");
        }
    }
}