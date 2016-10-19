<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model;

class UserPayController extends BaseController {

    /**
     * 购买列表
     */
    public function listPay() {

        $showMenu = I('param.showMenu');
        $status = I('param.status');

        $sql = " select p.*, u.nick_name user_name,r.mobile,b.name bookname "
            . " from qs_user_pay_history p "
            . " left join qs_books b on p.bid=b.id "
            . " left join qs_user r on p.uid=r.id "
            . " left join qs_user_profile u on p.uid=u.id "
            . " where u.id = r.id ";


        if($status!=""){
            $sql = $sql ." and p.status=$status ";
        }else{
            $status =1;
            $sql = $sql ." and p.status=$status ";
        }

        $sql = $sql." order by order_time desc ";
        $Model = new \Think\Model();
        $payList = $Model->query($sql);
        $this->assign('payList', $payList);

        $this->assign('SHOW_MENU', "ADMIN_PAY");
        $this->assign('status', $status);
        $this->assign('showMenu', $showMenu);
        $this->display();
    }


    /**
     * 提现申请列表
     */
    public function listApply() {

        $status = I('param.status');
        $showMenu = I('param.showMenu');

        $sql = " select  h.*,p.nick_name apply_name, h.name receiver_name,u.mobile  ,p2.name approver_name ,h.status approvve_status"
            ." from qs_user_apply_history h  "
            ." left join qs_user u on h.uid=u.id "
            ." left join qs_user_profile p on h.uid=p.id "
            ." left join qs_user_profile p2 on h.approver_id=p2.id  ";


        if($status!=""){
            $sql = $sql ." where h.status=$status ";
        }else{
            $status =1;
            $sql = $sql ." where h.status=$status ";
        }


        $sql = $sql. " order by h.apply_date desc ";

        $Model = new \Think\Model();
        $payList = $Model->query($sql);
        $this->assign('payList', $payList);

        $this->assign('SHOW_MENU', "ADMIN_PAY");
        $this->assign('status', $status);
        $this->assign('showMenu', $showMenu);
        $this->display();
    }



    /**
     * 提现初始化页面
     */
    public function entry() {

        $id = I('param.id');

        if (!empty($id)) {

            $sql = " select  h.*,p.nick_name apply_name, h.name receiver_name,u.mobile  ,p2.name approver_name "
                ." from qs_user_apply_history h  "
                ." left join qs_user u on h.uid=u.id "
                ." left join qs_user_profile p on h.uid=p.id "
                ." left join qs_user_profile p2 on h.approver_id=p2.id  "
            ." where h.id = ".$id;

            $Model = new \Think\Model();
            $payHistory = $Model-> query($sql);
            $this->assign('payHistory', $payHistory[0]);
        }

        $this->display();
    }

    /**
     * 提现
     */
    public function save(){

        $id = I('param.id');

        $money = I('post.money');
        $name = I('param.name');
        $receive_account = I('param.receive_account');
        $money = I('param.money');
        $account_desc = I('param.account_desc');

        $apply_reason = I('param.apply_reason');
        $optType = I('param.optType');

        $cid = session('LOGIN_USER')['id'];
        $updateTime = date("Y-m-d H:i:s");

        $UserApplyHistory = M('UserApplyHistory');
        $condition = array();
        $data = array();

        if(!empty($id)){
            $condition['id'] = $id;

            $data= $UserApplyHistory->where("id=$id")->find();

            $pay_account = I('param.pay_account');
            $opt_reason = I('param.opt_reason');
            $pay_type = I('param.pay_type');

            $data['id'] = $id;
            $data['pay_time'] = $updateTime;
            $data['approver_id'] =$cid;
            $data['status'] =$optType;
            $data['transaction_no'] =I('param.transaction_no');
            $data['order_no'] = I('param.order_no');
            $data['opt_reason'] = $opt_reason;
            $data['id'] = $id;
            $data['pay_type'] = $pay_type;
            $data['pay_account'] = $pay_account;

            $result = $UserApplyHistory->where($condition)->save($data);

            if($result){
                $userDao = D("userProfile");
                $uid =$data['uid'];
                $user = $userDao->where("id=$uid")->find();


                if($optType == 2){
                    $user['account_left'] = $user['account_left']+$money;
                    $user['get_money'] = $user['get_money']-$money;
                }
                $userDao->where("id=$uid")->save($user);
            }

        }else{
            $data['name'] =$name;
            $data['receive_account'] =$receive_account;
            $data['money'] =$money;
            $data['apply_date'] = $updateTime;
            $data['account_desc'] =$account_desc;
            $data['apply_reason'] = $apply_reason;
            $data['uid'] =$cid;
            $data['status'] =0;
            $data['money'] = $money;
            $result = $UserApplyHistory->add($data);
        }

        $this->redirect(BASE_PATH.'/UserPay/listApply');
    }



}