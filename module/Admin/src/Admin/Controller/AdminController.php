<?php

namespace Admin\Controller;

use Admin\Form\BlogForm;
use Admin\Form\LoginForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model;

class AdminController extends AbstractActionController
{
    protected $blogTable;
    protected $adminTable;

    public function indexAction()
    {
        $form = new LoginForm();
        $request = $this->getRequest();
        $flag = 1;
        $flag2 = 0;

        //$_SESSION['login'] = 1;
        if($request->isPost()){
            $admin = new Model\Admin();
            $form->setInputFilter($admin->getInputFilter());
            $form->setData($request->getPost());
            if($form->isValid()){
                $admin->exchangeArray($form->getData());
                $login = $admin->login;
                $password = $admin->password;
                $result = $this->getAdminTable()->getAdmin($login, $password);
                if($result){
                    $_SESSION['login'] = 1;
                }else{
                    $_SESSION['error'] = 'Логин или пароль не верны';
                }
            }
        }

        if(isset($_SESSION['login']) && $_SESSION['login'] == 1){
            return new ViewModel([
                'blogs' => $this->getBlogTable()->fetchAll(),
                'admins' => $this->getAdminTable()->fetchAll(),
            ]);
        }else{
            return new ViewModel([
                'form' => $form,
            ]);
        }
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
                return $this->redirect()->toRoute('admin');
            }else{
                throw new \Exception('Твоя гавноформа не проходит валидацию. Иди еби мозги');
            }
        }
        return new ViewModel(['form' => $form]);
    }
    public function  addadminAction()
    {
        $form = new LoginForm();
        $request = $this->getRequest();
        if($request->isPost()){
            $admin = new Model\Admin();
            $form->setInputFilter($admin->getInputFilter());
            $form->setData($request->getPost());
            if($form->isValid()){
                $admin->exchangeArray($form->getData());
                $this->getAdminTable()->saveAdmin($admin);
                var_dump($_SESSION);
                exit;
                return $this->redirect()->toRoute('admin');
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
                return $this->redirect()->toRoute('admin');
            }
        }
        return new ViewModel(['form'=>$form, 'id'=>$id]);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id');
        if (!$id){
            return $this->redirect()->toRoute('admin');
        }
        $request = $this->getRequest();
        if ($request->isPost()){
            $del = $request->getPost('del','No');
            if($del == 'Yes'){
                $this->getBlogTable()->deleteArticle($id);
            }
            return $this->redirect()->toRoute('admin');
        }
        return new ViewModel([
            'id' => $id,
            'blog' => $this->getBlogTable()->getArticle($id),
        ]);
    }

    public function exitAction(){
        unset($_SESSION['login']);
        return $this->redirect()->toRoute('admin');
    }

    public function getBlogTable()
    {
        if(!$this->blogTable){
            $serviceManager = $this->getServiceLocator();
            $this->blogTable = $serviceManager->get('Admin\Model\BlogTable');
        }
        return $this->blogTable;
    }

    public function getAdminTable()
    {
        if(!$this->adminTable) {
            $serviceManager = $this->getServiceLocator();
            $this->adminTable = $serviceManager->get('Admin\Model\AdminTable');
        }
        return $this->adminTable;
    }
}