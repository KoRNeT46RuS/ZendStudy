<?php
namespace Admin\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class AdminTable extends AbstractTableGateway
{
    protected  $table = 'admins';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Admin());
        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function getAdmin($login, $password)
    {
        $rowSet = $this->select(['login' => $login, 'password' => $password]);
        $row = $rowSet->current();
        if(!$row) return false;
        return $row;
    }

    public function saveAdmin(Admin $admin)
    {
        $data = [
            'login' => $admin->login,
            'password' => $admin->password,
        ];
        $id = (int) $admin->idadmin;
        if(!$id){
            $this->insert($data);
        }else{
            $this->update($data, ['idadmin' => $id]);
        }
        return true;
    }
}