<?php

namespace app\common\model;

use think\Model;

class Users extends Model
{
    protected $pk = 'user_id';

    /**
     * 一对一关联用户组
     * @return \think\model\relation\HasOne
     * @author 牛青旺
     */
    public function userGroup()
    {
        return $this->hasOne('UsersGroup', 'group_id', 'group_id');
    }

    /**
     * 一对多关联收藏表
     * @return \think\model\relation\HasMany
     * @author 牛青旺
     */
    public function userCollect()
    {
        return $this->hasMany('Collect', 'user_id', 'user_id');
    }

    /**
     * 获取用户列表
     * @param $where
     * @param $limit
     * @return $this
     * @author 牛青旺
     */
    public function getUserList($where, $limit)
    {
        return $this->where($where)->paginate($limit);
    }

    public function testFunction()
    {
        echo '111;';
    }

}
