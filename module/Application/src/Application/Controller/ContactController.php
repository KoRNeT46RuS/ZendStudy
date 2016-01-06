<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\ContactForm;

class ContactController extends AbstractActionController
{
    public function indexAction()
    {
        $form = new ContactForm();
        return new ViewModel(['form' => $form]);
    }
}
