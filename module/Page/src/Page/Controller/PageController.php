<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Page\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Page\Model;
use Page\Form\PageForm;
use Application\Model\MyAdapter;

class PageController extends AbstractActionController
{
    protected $pageTable;

    //page
    public function indexAction()
    {
        $adapter = new MyAdapter("admin2", "qwerty");
        $result = $adapter->authenticate();
        $code = $result->getCode();
        $identity = $result->getIdentity();
        if($result->isValid()) {
            return new ViewModel(array(
                'pages' => $this->getPageTable()->fetchAll(),
            ));
        }else{
            return new ViewModel(['messadge'=>'Типа форма']);
        }
    }

    //page/delete
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id');
        if (!$id){
            return $this->redirect()->toRoute('page');
        }
        $request = $this->getRequest();
        if($request->isPost()){
            $del = $request->getPost('del','No');
            if($del == 'Yes'){
                $this->getPageTable()->deletePage($id);
            }
            return $this->redirect()->toRoute('page');
        }
        return ['id' => $id,
                    'page' => $this->getPageTable()->getPage($id)];
    }


    //page/modify
    public function modifyAction()
    {
        $id = (int) $this->params()->fromRoute('id');
        if (!$id){
            return $this->redirect()->toRoute('page', ['action' => 'add']);
        }
        $page = $this->getPageTable()->getPage($id);
        $form = new PageForm();
        $form->bind($page);//Связь формы и страницы
        $form->get('submit')->getAttribute('value', 'Edit');
        $request = $this->getRequest();
        if($request->isPost()){
            $form->setInputFilter($page->getInputFilter());//Привязываем фильтр
            //Заполняем форму значениями
            $form->setData($request->getPost());
            if ($form->isValid()){
                $this->getPageTable()->savePage($page);//Возвращаем и сохраняем
                return $this->redirect()->toRoute('page');
            }
        }
        return [
            'id' => $id,
            'form' => $form,
        ];
    }


    //page/add
    public function addAction()
    {
        $form = new PageForm(); //Создаем форму
        $request = $this->getRequest();//Обращение к запросу в форме (получение запроса)
        if($request->isPost()){
            $page = new Model\Page();
            $form->setInputFilter($page->getInputFilter());//Привязываем фильтр
            //Заполняем форму значениями
            $form->setData($request->getPost());

            //Используем фильтр
            if ($form->isValid()){
                $page->exchangeArray($form->getData());//Формируем массив
                $this->getPageTable()->savePage($page);//Возвращаем и сохраняем
                return $this->redirect()->toRoute('page');
            }
        }
        return new ViewModel(['form' => $form]);
    }

    public function sitemapAction()
    {
        return new ViewModel();
    }

    public function getPageTable(){
        if(!$this->pageTable){
            $serviceManager = $this->getServiceLocator();//доступ к менеджеру сервисов
            $this->pageTable = $serviceManager->get('Page\Model\PageTable');
        }
        return $this->pageTable;
    }
}
