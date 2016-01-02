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

class PageController extends AbstractActionController
{
    protected $pageTable;

    //page
    public function indexAction()
    {
        return new ViewModel(array(
            'pages' => $this->getPageTable()->fetchAll(),
        ));
    }

    //page/delete
    public function deleteAction()
    {
        return new ViewModel();
    }


    //page/modify
    public function modifyAction()
    {
        return new ViewModel();
    }


    //page/add
    public function addAction()
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
