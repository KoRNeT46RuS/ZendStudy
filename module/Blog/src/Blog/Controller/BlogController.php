<?php

namespace Blog\Controller;

use Blog\Form\BlogForm;
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

    public function addAction()
    {
        $form = new BlogForm();
        $request = $this->getRequest();
        if($request->isPost()){
            $blog = new Model\Blog();
            $form->setInputFilter($blog->getInputFilter());
            $form->setData($request->getPost());
            if($form->isValid()){
                $blog->exchangeArray($form->getData());
                $this->getBlogTable()->saveArticle($blog);
                return $this->redirect()->toRoute('blog');
            }else{
                throw new \Exception('Твоя гавноформа не проходит валидацию. Иди еби мозги');
            }
        }
        return new ViewModel(['form' => $form]);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id');
        if (!$id){
            return $this->redirect()->toRoute('blog', ['action' => 'add']);
        }
        $blog = $this->getBlogTable()->getArticle($id);
        $form = new BlogForm();
        $form->bind($blog);
        $request = $this->getRequest();
        if ($request->isPost()){
            $form->setInputFilter($blog->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()){
                $this->getBlogTable()->saveArticle($blog);
                return $this->redirect()->toRoute('blog');
            }
        }
        return new ViewModel(['form'=>$form, 'id'=>$id]);
    }

    public function getBlogTable(){
        if(!$this->blogTable){
            $serviceManager = $this->getServiceLocator();
            $this->blogTable =$serviceManager->get('Blog\Model\BlogTable');
        }
        return $this->blogTable;
    }
}