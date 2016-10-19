<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model;

class AuthGroupController extends BaseController {

    /**
     * 用户组列表页面
     */
   public function listGroup(){
       $dao = M("AuthGroup");
       $groupList = $dao->select();
       $this->assign('groupList',$groupList);
       $this->assign('SHOW_MENU', "ADMIN_MNG");
       $this->assign('showMenu', 2);
       $this->display();

   }

    /**
     * 新增或者修改用户组页面
     */
    public function entry(){
        $id= I('param.id');
        if(!empty($id)){
            $dao = M("AuthGroup");
            $group = $dao->getById($id);
            if($group['is_edit']==1){
                $group['is_edit']='可修改';
            }else{
                $group['is_edit']='不可修改';
            }
            $this->assign('group',$group);
        }

        $dao = M("AuthRule");
        $ruleList = $dao->select();
        $this->assign('ruleList',$ruleList);
        $this->display();
    }

    /**
     * 新增或者修改用户组
     */
    public function save(){

        $id= I('param.id');
        $ruleIds = $_POST['ruleId'];

        $dao = M("AuthGroup");
        $isEdit = $dao->getById($id)['is_edit'];

        if($isEdit == 1 || $isEdit ==null){//可修改或新增时
            $data['name']= I('post.name');
            $data['remark']= I('post.remark');
            $data['rules']=implode(',',$ruleIds);
        }


        if(!empty($id)){
            $condition['id'] = $id;
            $result = $dao->where($condition)->save($data);
        }else{
            $result = $dao->add($data);
        }
        $this->redirect(BASE_PATH.'/AuthGroup/listGroup');
    }


    /**
     * 禁用
     */
    function del(){
        $id= I('param.id');
        if(!empty($id)){
            $dao = M("AuthGroup");
            $data = $dao->getById($id);

//            $userId = session('LOGIN_USER')['id'];
//            $userName = session('LOGIN_USER')['Profile']['name'];

            $condition['id'] = $id;
            $data['status']= I('param.status');
//            $data['update_time']= date("Y-m-d H:i:s");
//            $data['updater_id']= $userId;
//            $data['updater_name']= $userName;

            $result = $dao->where($condition)->save($data);
        }

        $this->redirect(BASE_PATH.'/AuthGroup/listGroup');
    }

}