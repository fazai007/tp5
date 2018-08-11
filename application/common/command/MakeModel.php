<?php
/**
 * Created by PhpStorm.
 * User: 52721
 * Date: 2018/6/20
 * Time: 11:23
 */
namespace app\common\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use think\facade\Env;

class MakeModel extends Command
{
    protected function configure()
    {
        $this->setName('MakeModel')
            ->addArgument('table', Argument::OPTIONAL, 'table name')
            ->addArgument('pk', Argument::OPTIONAL, 'table primary key')
            ->addArgument('notes', Argument::OPTIONAL, 'table notes')
            #->addOption('notes', null, Option::VALUE_REQUIRED, 'table notes')
            ->setDescription('make model by model template !');
    }

    protected function execute(Input $input, Output $output)
    {
        //获取指令表格名
        $model = trim($input->getArgument('table'));
        $pk    = trim($input->getArgument('pk'));
        $notes    = trim($input->getArgument('notes'));

        //获取指令说明信息
        /*if ($input->hasOption('notes')) {
            $notes = $input->getOption('notes');
        }*/
        
        //获取指令主键
        /*if ($input->hasOption('pk')) {
            $pk = $input->getOption('pk');
        }*/

        //定义表格信息
        #$table     = implode(array_map('ucfirst', explode('_', $table)));
        $table      = $this->humpToLine($model);
        $py_key     = $pk ? $pk : $table .'_id';
        $remark     = $notes ? $notes : '';

        $create_result = $this->createModel($model, $table, $py_key, $remark);
        if ($create_result) {
            $output->write($model . ' create success !');
        }else{
            $output->write($model . ' create fault !');
        }
    }

    /**
     * 驼峰转下划线
     * @param $str
     * @return mixed
     * @author 牛青旺
     */
    private function humpToLine($str){
        $str = preg_replace_callback('/([A-Z]{1})/',function($matches){
            return '_'.strtolower($matches[0]);
        },$str);
        return trim($str, '_');
    }

    /**
     * 创建模型
     * @param $model
     * @param $table
     * @param $py_key
     * @param $remark
     * @return bool
     * @author 牛青旺
     */
    function createModel($model, $table, $py_key, $remark)
    {
        $appPath = Env::get('APP_PATH');
        $content = file_get_contents($appPath . 'common/model/model.template');
        $content = str_replace("__REMARK__", $remark, $content);
        $content = str_replace("__MODEL_NAME__", $model, $content);
        $content = str_replace("__PY_KEY__", $py_key, $content);
        $content = str_replace("__TABLE_NAME__", $table, $content);

        $save_path = $appPath . 'common/model/' . $model . '.php';
        if(file_exists($save_path))
        {
            return true;
        }
        $result = file_put_contents($save_path, $content);
        if($result) {
            return true;
        }else{
            return false;
        }
    }

}