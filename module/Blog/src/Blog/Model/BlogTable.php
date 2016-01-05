<?php
namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class BlogTable extends AbstractTableGateway
{
    protected $table = 'blog';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Blog());
        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function getArticle($id)
    {
        $id = (int) $id;
        $rowSet = $this->select(['idblog' => $id]);
        $row = $rowSet->current();
        if(!$row) throw new \Exception('Не найден пост $id');
        return $row;
    }

    public function saveArticle(Blog $blog){
        $data = [
            'title' => $blog->title,
            'article' => $blog->article,
            'text' => $blog->text,
        ];
        $id = (int) $blog->idblog;
        if(!$id){
            $this->insert($data);
        }else{
            $this->update($data, ['idblog' => $id]);
        }
        return true;
    }

    public function deleteArticle($id)
    {
        $this->delete(['idblog'=>$id]);
        return true;
    }
}