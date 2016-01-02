<?php

namespace Page\Model;

class Page
{
    public $idpage;
    public $title;
    public $article;
    public $pub;

    //получаем массив из базы и заполняем его
    public function exchangeArray($data)
    {
        $this->idpage = (isset($data['idpage'])) ? $data['idpage'] : null;
        $this->idpage = (isset($data['title'])) ? $data['title'] : null;
        $this->idpage = (isset($data['article'])) ? $data['article'] : null;
        $this->idpage = (isset($data['pub'])) ? $data['pub'] : null;

    }
}