<?php
namespace app\index\controller;

use app\common\model\Users;
use app\common\model\Collect;
use app\index\model\ItemComment;
use app\index\validate\User;
use Monolog\Logger;
use think\Controller;
use think\Debug;
use \think\facade\Cache;
use think\facade\Log;
use think\facade\Request;
use think\facade\Session;
use think\helper\Time;

class Index extends Controller
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public function getMonolog()
    {
        $log = new Logger('note_log');
        return redirect('www.baidu.com');
    }

    public function getDataByDatabase()
    {
        #$model = new Model
        $condition = [
            ['user_id', '>', '39454']
        ];
        db()->table('tp_users')->where($condition)->cache('userList', 60)->select();
        $data = Cache::get('userList');
        dump($data);die;
    }

    public function addTest()
    {
        $collectModel = new Collect();
        $collectList = $collectModel->where('user_id = 39454')->buildSql();
        #echo $collectList;die;
        dump($collectList);die;

        //test add
        /*$collectData = [
            [
                'user_id' => 39611,
                'item_id' => 12
            ],
            [
                'user_id' => 39611,
                'item_id' => 23
            ]
        ];
        $collectModel->saveAll($collectData);*/
    }

    /**
     * 测试json格式数据存储
     * @author 牛青旺
     */
    public function insertItemComment()
    {
        /*$comment_data = [
            'item_id' => 87,
            'shopping_cart_id' => 193,
            'user_id' => 39611,
            'content' => 'json格式图片测试',
            'images' => [
                'www.baidu.com',
                'www.wangyi.com'
            ]
        ];*/
        $itemComment = new ItemComment();
        $itemCommentInfo = ItemComment::get(91);
        dump($itemCommentInfo);die;
    }

    /**
     * 连表查询测试
     * @author 牛青旺
     */
    public function getRelationSearch()
    {
        debug('begin');
        Debug::remark('start');
        $userList = Users::withCount('user_collect')->where('user_id = 39454')->select();

        #$group_name = $user->user_group->group_name;
        #$userCollectList = $user->user_collect;
        #$userCollectNum = $user->withCount();
        foreach ($userList as $key => $user) {
            echo $user->user_collect_count;
        }
        debug('end');
        echo debug('begin', 'end');
        
        #dump($user->user_collect_count);die;
        #$userCollectList->data;
    }

    /**
     * 视图测试
     * @return mixed
     * @author 牛青旺
     */
    public function viewLayout()
    {
        return $this->fetch();
    }

    /**
     * 日志测试
     * @author 牛青旺
     */
    public function testLog()
    {
        #Log::write('日志测试，不具有实际意义！');
        trace('trace 日志测试，不具有实际意义', 'error');
    }

    /**
     * sql性能调试
     * @author 牛青旺
     */
    public function getSqlLog()
    {
        $collectObj = new Collect();
        $collectWhere = 'user_id = 39454';

        $collectList = $collectObj->getCollectList($collectWhere, 'collect_id, user_id, item_id, addtime');
        dump($collectList);die;
    }

    /**
     * 验证器测试
     * @author 牛青旺
     */
    public function testValidate()
    {
        $userInfo = [
            'user_id' => 'nihao',
            'age' => 131
        ];

        $userValidate = new User();
        if (!$userValidate->scene('edit')->check($userInfo)) {
            dump($userValidate->getError());
        }
    }

    /**
     * 缓存测试
     * @author 牛青旺
     */
    public function testRedis()
    {
        /*Cache::set('name', 'niu');
        $name = Cache::get('name');
        echo $name;*/

        cache('userName', 'baoma', 3600);
        echo cache('userName');
    }

    /**
     * 测试session
     * @author 牛青旺
     */
    public function testSession()
    {
        //保存用户信息
        /*$userInfo = [
            'user_name' => 'baobao',
            'sex' => 'woman',
            'age' => '18'
        ];
        Session::flash('userInfo', $userInfo);*/
        #Session::delete('userInfo');

        //获取session用户信息
        #$sessionUserInfo = Session::get('userInfo');
        #dump($sessionUserInfo);
    }

    /**
     * 获取用户列表
     * @author 牛青旺
     */
    public function getUserList()
    {
        $userObj = new Users();
        $userList = $userObj->getUserList('role_type = 3', 10);



        // 获取分页显示
        #$page = $userList->render();
        #$total = $userList->total();
        #$this->assign('page', $page);
        $this->assign('list', $userList);

        #dump($total);die;
        return $this->fetch();
    }

    /**
     * 文件上传测试
     * @return mixed
     * @author 牛青旺
     */
    public function testUpload()
    {
        $file = request()->file('image');

        if ($file) {
            $fileInfo = $file->validate(['size' => 15678, 'ext' => 'jpg, png, gif'])->move('../uploads');
            if ($fileInfo) {
                echo $fileInfo->getExtension(),"<br>";
                echo $fileInfo->getSaveName(),"<br>";
                echo $fileInfo->getFileName(),"<br>";
            }else{
                echo $fileInfo->getError(),"<br>";
            }
        }else{
            return $this->fetch();
        }
    }

    /**
     * 验证码测试
     * @return mixed
     * @author 牛青旺
     */
    public function testCaptcha()
    {
        $captcha = Request::param('captcha');
        if(captcha_check($captcha)) {
            echo '校验通过';die;
        }
        return $this->fetch();
    }

    /**
     * 时间扩展测试
     * @author 牛青旺
     */
    public function testTime()
    {
        list($start, $end) = Time::today();

        echo $start, '<br>';
        echo $end;
    }

    /**
     * mongoDb测试
     * @author 牛青旺
     */
    public function testMongoDb()
    {
        phpinfo();
    }

    /**
     * 测试助手函数
     * @author 牛青旺
     */
    public function testFace()
    {
        #cache('name', '牛青旺');
        #echo cache('name');
        app('cache')->set('name', '小李子');
        echo app('cache')->get('name');
    }
}
