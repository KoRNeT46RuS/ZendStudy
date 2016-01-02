<?php
//Связывает базу данных и модель

namespace Page\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class PageTable extends AbstractTableGateway
{
    private $table = 'page';//таблица

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();//позволяет получать все записи, выполненные запросом
        $this->resultSetPrototype->setArrayObjectPrototype(new Page());
        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function getPage($id)
    {
        $id = (int) $id;
        $rowSet = $this->select(array('idpage' => $id,));
        $row = $rowSet->current();//получаем строчку
        if(!$row) throw new \Exception('Не найдена страница $id');
        return $row;
    }

    public function savePage(Page $page)
    {
        $data = array('title' => $page->title, 'article' => $page->article, 'pub' => date("d-m-Y H:i:s"));
        $id = (int) $page->idpage;
        if(!$id){
            $this->insert($data);
        }else{
            $this->update($data, array('idpage' => $id,));
        }
        return true;
    }

    public function deletePage($id)
    {
        $this->delete(array('idpage' => $id,));
    }

    //получаем массив из базы и заполняем его
    public function exchangeArray($data)
    {
        $this->idpage = (isset($data['idpage'])) ? $data['idpage'] : null;
        $this->idpage = (isset($data['title'])) ? $data['title'] : null;
        $this->idpage = (isset($data['article'])) ? $data['article'] : null;
        $this->idpage = (isset($data['pub'])) ? $data['pub'] : null;

    }
}

