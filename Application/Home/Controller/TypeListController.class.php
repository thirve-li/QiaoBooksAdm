<?php
/**
 * Created by PhpStorm.
 * User: LiXin
 * Date: 16/7/11
 * Time: 20:51
 */

namespace Home\Controller;
import("@.ORG.UploadFile");
use OSS\OssClient;
use OSS\Core\OssException;

class TypeListController extends BaseController {

    /**
     * 查询列表
     */
    function listType(){
        $type = I('param.type');
        $status = I('param.status');
        $showMenu = I('param.showMenu');
        $condtion = "type = '$type'";
        if($type ==8 || $type == 10 ){
            if($status != ""){
                $condtion =  $condtion." and status=".$status;
            }else{
                $status =1;
                $condtion =  $condtion." and status=".$status;
            }
        }

        $dao = M("TypeList");
        $dataList = $dao->where($condtion)->order('sort_num DESC')->select();
        $this->assign('dataList',$dataList);

        if($type==$this::TYPE_BANNER || !empty($showMenu) ){
            $this->assign('SHOW_MENU', "ADMIN_BANNER");
        }else{
            $this->assign('SHOW_MENU', "ADMIN_MST");
        }


        $this->assign('type',$type);
        $this->assign('status',$status);
        $this->display();

    }

    /**
     *新增、修改
     */
    function save(){

        $id= I('param.id');
        $type = I('param.type');

        $dao = M("TypeList");
        $pid=  I('post.pid');

        $data = array();
        if(!empty($id)){
            $dao = M("TypeList");
            $data = $dao->where("id = $id ")->find();
        }


        $data['type']= $type;
        $data['name']= I('post.name');
        $data['remark']= I('post.remark');
        $data['sort_num']= I('post.sort_num');
        $data['url']= I('post.url');
        $data['mobile_or_pc']= I('post.mobile_or_pc');
        $userId = session('LOGIN_USER')['id'];
        $userName = session('LOGIN_USER')['Profile']['name'];


        if(!empty($pid)){
            $data['pid']= $pid;
        }


        if($type == $this::TYPE_REC_BOOK) {
            $bookId = $data['url'];
            $bookDao = new \Think\Model();
            $sql = " select *  from qs_books where id=$bookId";
            $book = $bookDao->query($sql);

            $data['name'] = $book[0]['name'];
        }

        if($type == $this::TYPE_BANNER){

            if(!empty($_FILES)) {

                $accessKeyId="jqw3Pos5u7Fwe1Dc";
                $accessKeySecret="m2APlObELCrPvA7U27bqdoS52S9OYw";
                $endpoint="oss-cn-shanghai-internal.aliyuncs.com";

                if ((($_FILES["img"]["type"] == "image/gif")
                    || ($_FILES["img"]["type"] == "image/jpeg")
                    || ($_FILES["img"]["type"] == "image/jpg")
                    || ($_FILES["img"]["type"] == "image/png")
                    || ($_FILES["img"]["type"] == "image/pjpeg"))
                    //&& ($_FILES["img"]["size"] < 20000)
                ) {

                    $file_name = $_FILES["img"]["name"];
                    if ($_FILES["img"]["error"] == 0  ) {
                        $extendFileName = substr($file_name, strrpos($file_name, '.')+1);
                        $timeStr = date("YmdHis");
                        $file_name = $timeStr.'.'.$extendFileName;
                        $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
                        $ossClient->uploadFile("publicimgbucket",$file_name,$_FILES["img"]['tmp_name']);
                    }
                }

            }
        }

        if(!empty($id)){
            $condition['id'] = $id;
            $data['update_time']= date("Y-m-d H:i:s");
            $data['updater_id']= $userId;
            $data['updater_name']= $userName;
            if(!empty($file_name)){
                $data['img']= $file_name;
            }
            $result = $dao->where($condition)->save($data);
        }else{
            $data['create_time']= date("Y-m-d H:i:s");
            $data['creater_id']= $userId;
            $data['creater_name']= $userName;
            $data['img']= $file_name;
            $result = $dao->add($data);
        }


        $dao = M("TypeList");
        $dataList = $dao->where("type = '$type'")->order('sort_num ASC')->select();
        $this->assign('dataList',$dataList);
        $this->assign('type',$type);
        $this->redirect(BASE_PATH.'/TypeList/listType/type/'.$type,"'页面跳转中...'");
    }


    /**
     *新增、修改页面
     */
    function entry(){
        $id= I('param.id');
        $type = I('param.type');
        if(!empty($id)){
            $dao = M("TypeList");
            $data = $dao->getById($id);
            $type = $data['type'];
            $this->assign('data',$data);
        }

        $this->assign('type',$type);
        $this->display();
    }

    /**
     * 禁用
     */
    function del(){
        $id= I('param.id');
        $type = I('param.type');
        if(!empty($id)){
            $dao = M("TypeList");
            $data = $dao->getById($id);
            $type = $data['type'];

            $userId = session('LOGIN_USER')['id'];
            $userName = session('LOGIN_USER')['Profile']['name'];

            $condition['id'] = $id;
            $data['status']= I('param.status');
            $data['update_time']= date("Y-m-d H:i:s");
            $data['updater_id']= $userId;
            $data['updater_name']= $userName;

            $result = $dao->where($condition)->save($data);
        }

        $dao = M("TypeList");
        $dataList = $dao->where("type = '$type'")->order('sort_num ASC')->select();
        $this->assign('dataList',$dataList);
        $this->assign('type',$type);
        $this->redirect(BASE_PATH.'/TypeList/listType/type/'.$type,"'页面跳转中...'");
    }


    Public function upload(){
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Public/Uploads/';// 设置附件上传目录
        if(!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        }else{// 上传成功 获取上传文件信息
            $info =  $upload->getUploadFileInfo();
        }
       // 保存表单数据 包括附件数据
        $User = M("User"); // 实例化User对象
        $User->create(); // 创建数据对象
        $User->photo = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        $User->add(); // 写入用户数据到数据库
        $this->success('数据保存成功！');
    }

}