<?php

namespace app\index\model;

use think\Model;

class ItemComment extends Model
{
    //设置主键
    protected $pk = 'item_comment_id';

    // 设置json类型字段
    protected $json = ['images'];

    public function addItemComment($data)
    {
        return $this->create($data)->save();
    }
}
