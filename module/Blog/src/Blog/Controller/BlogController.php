<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Blog\Model;

class BlogController extends AbstractActionController
{
    protected $blogTable;

    public function indexAction()
    {
        return new ViewModel([
            'blogs' => $this->getBlogTable()->fetchAll(),
        ]);
    }

    public function articleAction()
    {
        $id = (int) $this->params()->fromRoute('id');
        if(!$id){
            return $this->redirect()->toRoute('blog');
        }
        $article = $this->getBlogTable()->getArticle($id);
        return new ViewModel([
            'article' => $article
        ]);
    }

    public function getBlogTable(){
        if(!$this->blogTable){
            $serviceManager = $this->getServiceLocator();
            $this->blogTable =$serviceManager->get('Blog\Model\BlogTable');
        }
        return $this->blogTable;
    }
}