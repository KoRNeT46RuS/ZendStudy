<?php
namespace Admin\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Admin implements InputFilterAwareInterface
{
    public $login;
    public $password;
    public $idadmin;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->idadmin = (isset($data['idadmin'])) ? $data['idadmin'] : null;
        $this->login = (isset($data['login'])) ? $data['login'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
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

            $inputFilter->add(
                $factory->createInput([
                    'name' => 'login',
                    'required' => true,
                    'filters' => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                ])
            );

            $inputFilter->add(
                $factory->createInput([
                    'name' => 'password',
                    'required' => true,
                    'filters' => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                ])
            );

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;

    }
}