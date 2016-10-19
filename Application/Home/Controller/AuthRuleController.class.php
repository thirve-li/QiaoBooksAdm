<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model;

class AuthRuleController extends BaseController {

    /**
     * 权限列表页
     */

   public function listRule(){
       $dao = M("AuthRule");
       $ruleList = $dao->select();
       $this->assign('SHOW_MENU', "ADMIN_MNG");
       $this->assign('showMenu', 3);

       $this->assign('ruleList',$ruleList);
       $this->display();

   }

    /**
     * 新增修改权限页面
     */

    public function entry(){
        $id= I('param.id');
        if(!empty($id)){
            $dao = M("AuthRule");
            $rule = $dao->getById($id);
            $this->assign('rule',$rule);
        }
        $this->display();
    }

    /**
     * 新增修改权限
     */
    public function save(){
        $data['id']= I('param.id');
        $data['name']= I('post.name');
        $data['condition']= I('post.condition');
        $data['sort']= I('post.sort');

        $dao = M("AuthRule");

        if(!empty($data['id'])){
            $condition['id'] = $data['id'];
            $result = $dao->where($condition)->save($data);
        }else{
            $result = $dao->add($data);
        }
        $this->redirect(BASE_PATH.'/AuthRule/listRule');
    }


}