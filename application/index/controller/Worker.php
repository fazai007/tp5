<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\worker\Server;

class Worker extends Server
{
    protected $socket = 'websocket://127.0.0.1:2346';

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }

    /**
     * 接收消息
     * @param $connetion
     * @param $data
     * @author 牛青旺
     */
    public function onMessage($connetion, $data)
    {
        $connetion->send('我收到你的消息了');
    }

    /**
     * 点链接是触发回调函数
     * @param $connection
     * @author 牛青旺
     */
    public function onConnect($connection)
    {
        
    }

    /**
     * 断开连接时回调函数
     * @param $connection
     * @author 牛青旺
     */
    public function onClose($connection)
    {
        
    }

    /**
     * 客户端连接出错回调函数
     * @param $connection
     * @param $code
     * @param $msg
     * @author 牛青旺
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     * @author 牛青旺
     */
    public function onWorkerStart($worker)
    {

    }


}
