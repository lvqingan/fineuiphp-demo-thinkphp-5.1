<?php

namespace app\index\controller;

use think\Controller;

abstract class BaseController extends Controller
{
    protected function initialize()
    {
        parent::initialize();

        $this->view->filter(function($content){
            return \FineUIPHP\ResourceManager\ResourceManager::finish($content);
        });
    }
}
