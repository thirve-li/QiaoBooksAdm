<?php
namespace Home\Controller;

use Think\Controller;

class BaseController extends Controller
{


//    const BASE_PATH = '/index.php';//本地环境
    //const BASE_PATH = '';//正式环境

    /**
     * 超级用户
     */
    const SUPER_USER = 1;

    /**
     * 后台系统管理员
     */
    const ADMIN_USER = 2;

    /**
     * 前台用户
     */
    const FRONT_USER = 3;


    /**
     * 1、书籍分类  2、作品标签 3、用户评分标准 4、作品评分标准 5、国家  6、省份 7、城市 8.首页banner 9、作者标签 10作品推荐
     */
    const TYPE_BOOK = 1;
    const TYPE_LABEL= 2;
    const TYPE_USER_SCORE = 3;
    const TYPE_BOOK_SCORE=4;
    const TYPE_CONTRY=5;
    const TYPE_PROVINCE=6;
    const TYPE_CITY=7;
    const TYPE_BANNER=8;
    const TYPE_WRITER_LABEL=9;
    const TYPE_REC_BOOK=10;





    public function _initialize()
    {
        $loginUser = session('LOGIN_USER');
        if ($loginUser == null) {
            $this->redirect(__ROOT__ . "index.php/Login/login");
        } else {
            $this->assign("loginUser", $loginUser);
        }
    }

}