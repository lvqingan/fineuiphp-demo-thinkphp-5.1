<?php
namespace app\index\controller;

class Index extends BaseController
{
    public function index()
    {
        return $this->fetch();
    }

    public function res()
    {
        $handler = new \FineUIPHP\ResourceManager\ResourceHandler();

        $handler->ProcessRequest();
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
