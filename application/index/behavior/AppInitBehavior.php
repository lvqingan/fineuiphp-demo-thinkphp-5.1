<?php

namespace app\index\behavior;

class AppInitBehavior
{
    public function run()
    {
        // 初始化配置信息
        \FineUIPHP\Config\GlobalConfig::loadConfig(array(
            'Theme'           => 'Default',  // 默认主题
            'ResourceHandler' => 'index/index/res'  // 资源文件获取入口
        ));
    }
}
