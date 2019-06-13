# ThinkPHP 5.1

@(FineUIPHP)

[TOC]

1. 安装

首先您需要按照 [ThinkPHP 5.1 官方文档](https://www.kancloud.cn/manual/thinkphp5_1/353948) 的说明进行安装

假设您的安装目录是 /home/http/tp

a. 将 `FineUIPHP` 的代码解压缩到您认为合适的任意目录，您可以将代码放到项目内，也可以放到项目外

假设您的解压目录是 /home/fineui-lib

b. 修改 `composer.json` 增加下面的配置信息

```json
    "repositories": [
        {
            "type": "path",
            "url": "../fineui-lib"
        }
    ]
```

c. 执行安装命令
```bash
composer require lvqingan/fineuiphp:dev-master
```

2. 配置

2.1 初级化 TP 的行为

修改 `application/tags.php`

```php
    'app_init'     => [
        'app\\index\\behavior\\AppInitBehavior'
    ],
```

创建文件 `application/index/behavior/AppInitBehavior.php`

```php
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
```

2.2 配置 View Filter

由于 TP 5.1.3 里面把 `view_filter` 已经移除了，所以只能通过 `Controller` 的 `initialize` 来实现

创建文件 `application/index/controller/BaseController.php`

```php
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

```

并将 `application/index/controller/Index.php` 的父类改为 `BaseController`

3. 静态资源入口文件

在 `application/index/controller/Index.php` 中增加方法，对应到 `AppInitBehavior.php` 中 `ResourceHandler` 配置的地址
`index/index/res`

```php
    public function res()
    {
        $handler = new \FineUIPHP\ResourceManager\ResourceHandler();

        $handler->ProcessRequest();
    }
```

4. 演示例子

在 `application/index/controller/Index.php` 修改方法 `index`

```php
    public function index()
    {
        return $this->fetch();
    }
```

并创建模板 `application/index/view/index/index/index.html`

```html
<html>
<head>
    <title>ThinkPHP 3.2 使用教程</title>
</head>
<body style="padding: 20px;">
<?php
echo \FineUIPHP\FineUIControls::textBox()->text('默认文字');
echo '<hr/>';
echo \FineUIPHP\FineUIControls::button()->text('提交');
?>
</body>
</html>
```
