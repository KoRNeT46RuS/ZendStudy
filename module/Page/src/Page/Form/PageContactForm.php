<?php
namespace Page\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class PageContact extends Form{
    public function __construct($name)
    {
        parent::__construct($name);
    }
}