<?php

namespace app\common\model;

use think\Model;

class Collect extends Model
{
    protected $pk = 'collect_id';

    protected $type = [
        'addtime'  =>  'timestamp:Y-m-d H:i:s',
    ];

    // 定义全局的查询范围
    /*protected function base($query)
    {
        $query->where('status',1);
    }*/

    #protected $table = 'tp_collect';
    public function getCollectList($where, $field='')
    {
        return $this->field($field)->where($where)->select();  
    }

    public function editCollect($where, $data)
    {
        return $this->where($where)->update($data);
    }
}
