#! /usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: 52721
 * Date: 2018/6/21
 * Time: 11:27
 */
namespace  think;

define('APP_PATH', __DIR__ . '/application/');

//加载基础文件
require __DIR__ . '/thinkphp/base.php';

//执行应用并响应
Container::get('app', [APP_PATH])->bind('index/Worker')->run()->send();