<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model;
use Home\Service;

class LoginController extends Controller
{

    const BASE_PATH = '/index.php';//本地环境
    //const BASE_PATH = '';//正式环境

    /**
     * 用户登录页面
     */
    public function login() {
        $this->display();
        session(null);
    }


    /**
     * 用户登录
     */
    public function loginAction()
    {

        $mobile = I('post.mobile');
        $password = I('post.password');

        $err_msg = "";

        if (empty($mobile) || empty($password)) {
            $err_msg = "请输入用户名和密码";
            $this->assign('mobile', $mobile);
            session("err_msg", $err_msg);

            $this->redirect(BASE_PATH.'/Login/login',"请输入用户名和密码");
        } else {

            $user = D("User");
            $data = $user->relation(true)->where(" mobile='" . $mobile . "'")->find();

            if ($data == null) {
                $err_msg = "登陆失败，不存在此用户名";
                session("err_msg", $err_msg);
                $this->assign('mobile', $mobile);
                $this->redirect(BASE_PATH.'/Login/login',"登陆失败，不存在此用户名");
            } else {
                $passfix = C("PASS_FIX");
                $password = md5(md5($password.$passfix).$passfix);
                echo $password;
                if ($password != $data['password']) {
                    $err_msg = "登陆失败，密码错误！";
                    session("err_msg", $err_msg);
                    $this->assign('mobile', $mobile);
                    $this->redirect(BASE_PATH.'/Login/login',"登陆失败，密码错误！");
                } else if($data['status']==0){
                    $err_msg = "登陆失败，你的账户已被禁止登录！";
                    session("err_msg", $err_msg);
                    $this->assign('mobile', $mobile);
                    $this->redirect(BASE_PATH.'/Login/login',"登陆失败，你的账户已被禁止登录！");
                }else {

                    $roleIds = explode(",",$data['groups']);
                    $roleName = "";
                    $isAdmin = false;
                    foreach($roleIds as $id){
                        $dao =  new \Think\Model();
                        $res = $dao->query("select * from qs_auth_group  where id='$id' ");
                        $roleName = $roleName.$res[0]['name']." ";
                        if($res[0]['id'] ==  2 || $res[0]['id'] ==1) {
                            $isAdmin = true;
                        }

                    }

                    if($isAdmin==false){
                        $err_msg = "登陆失败，你没有后台登录权限！";
                        session("err_msg", $err_msg);
                        $this->assign('mobile', $mobile);
                        $this->redirect(BASE_PATH.'/Login/login',$err_msg);
                    }


                    $data['roleName']=$roleName;

                    session("LOGIN_USER", $data);
                    session("uid", $data['id']);
                    //cookie("LOGIN_USER", $data, 'expire=2600000');
                    cookie("USER_ID", $data['id'], 'expire=2600000');

                    $id = $data['id'];

                    //登录成功 写登录日志。
                    $logData["user_id"] = $id;
                    date_default_timezone_set('Etc/GMT-8');
                    $logData["login_time"] = date("Y-m-d H:i:s");
                    $logData["login_ip"] = getIP();
                    $logData["login_from"] = I('post.login_from');

                    //更新登录时间
                    $dao = D("user");
                    $user = $dao->relation(true)->find($id);
                    $user['Profile']['login_time'] = date("Y-m-d H:i:s");
                    $user['Profile']['logout_time'] = null;
                    $user['Profile']['stay_time'] = null;
                    $condition['id'] = $id;
                    $result = $dao->relation(true)->where($condition)->save($user);

                    //增加log
                    $UserLog = D('UserLog');
                    $UserLog->add($logData);

                    $this->loginUser = $data;
                    $this->redirect(BASE_PATH.'/Index/index');
                }
            }

        }

    }

    /*
     * 登出
     */

    public function logout()
    {
        $userId = session('LOGIN_USER')['id'];
        date_default_timezone_set('Etc/GMT-8');
        $logData["logout_time"] = date("Y-m-d H:i:s");
        if ($userId != null) {
            $UserLog = M('UserLog');
            $log = $UserLog->query(" select id from qs_user_log where user_id= $userId  and login_time=(select max(login_time) from qs_user_log where user_id=$userId) ");
            $UserLog->where('id=' . $log[0]['id'])->save($logData);


            //更新登录时间
            $dao = D("user");
            $user = $dao->relation(true)->find($userId);
            $logoutTime = date("Y-m-d H:i:s");
            $loginTime = $user['Profile']['login_time'];
            $user['Profile']['logout_time'] = $logoutTime;
            $user['Profile']['stay_time'] = calStayTime($loginTime, $logoutTime);

            $condition['id'] = $userId;
            $result = $dao->relation(true)->where($condition)->save($user);

        }
        session(null);
        $this->redirect(BASE_PATH.'/Login/login');
    }




}