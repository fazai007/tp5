<?php
namespace app\common\model;

use think\Model;

/**
 * 模型类
 * table_name = tp_item_comment
 * py_key = item_comment_id
 */

class ItemCommentModel extends Model
{
    protected $pk = 'item_comment_id';

    /**
     * 构造函数
     * @author 姜伟
     * @todo 初始化id
     */
    public function ItemCommentModel()
    {
        parent::__construct('item_comment');
    }

    /**
     * 获取信息
     * @author 姜伟
     * @param int $item_comment_id id
     * @param string $fields 要获取的字段名
     * @return array 基本信息
     * @todo 根据where查询条件查找表中的相关数据并返回
     */
    public function getItemCommentInfo($where, $fields = '')
    {
		return $this->field($fields)->where($where)->find();
    }

    /**
     * 修改信息
     * @author 姜伟
     * @param array $arr 信息数组
     * @return boolean 操作结果
     * @todo 修改信息
     */
    public function editItemComment($where='',$arr)
    {
        if (!is_array($arr)) return false;

        $arr['last_edit_time'] = time();
        $arr['last_edit_user_id'] = session('user_id');
        
        return $this->where($where)->save($arr);
    }

    /**
     * 添加
     * @author 姜伟
     * @param array $arr 信息数组
     * @return boolean 操作结果
     * @todo 添加
     */
    public function addItemComment($arr)
    {
        if (!is_array($arr)) return false;

		$arr['addtime'] = time();
        $arr['add_user_id'] = session('user_id');

        return $this->add($arr);
    }

    /**
     * 删除
     * @author 姜伟
     * @param int $item_comment_id ID
     * @param int $opt,默认为假删除，true为真删除
     * @return boolean 操作结果
     * @todo isuse设为1 || 真删除
     */
    public function delItemComment($item_comment_id,$opt = false)
    {
        if (!is_numeric($item_comment_id)) return false;
        if($opt)
        {
            return $this->where('item_comment_id = ' . $item_comment_id)->delete();
        }else{
           return $this->where('item_comment_id = ' . $item_comment_id)->save(array('isuse' => 2)); 
        }
        
    }

    /**
     * 根据where子句获取数量
     * @author 姜伟
     * @param string|array $where where子句
     * @return int 满足条件的数量
     * @todo 根据where子句获取数量
     */
    public function getItemCommentNum($where = '')
    {
        return $this->where($where)->count();
    }

    /**
     * 根据where子句查询信息
     * @author 姜伟
     * @param string $fields
     * @param string $where
     * @param string $orderby
     * @param string $group
     * @return array 基本信息
     * @todo 根据SQL查询字句查询信息
     */
    public function getItemCommentList($fields = '', $where = '', $orderby = '', $group = '')
    {
        return $this->field($fields)->where($where)->order($orderby)->group($group)->limit()->select();
    }

    /**
     * 获取某一字段的值
     * @param  string $where 
     * @param  string $field
     * @return void
     */
    public function getItemCommentField($where,$field)
    {
        return $this->where($where)->getField($field);
    }


    /**
     * 获取列表页数据信息列表
     * @author 姜伟
     * @param array $ItemComment_list
     * @return array $ItemComment_list
     * @todo 根据传入的$ItemComment_list获取更详细的列表页数据信息列表
     */
    public function getListData($ItemComment_list)
    {
        
    }

}
