<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model;

class UserController extends BaseController {


    /**
     * 手机号是否存在
     * @return 0 不存在 1存在
     */
    public function isMobileExisted(){
        $dao = D("User");
        $mobile = I('param.mobile');
        $userList = $dao->where(" mobile= $mobile ")->find();
        $result = 0;
        if(!empty($userList)){
            $result = 1;
        }
        $this->ajaxReturn($result);
    }

    /**
     * 管理员用户列表
     */
    public function listAdmin() {
        $dao = D("User");
        $userList = $dao->relation(true)->where(" find_in_set(" . $this::ADMIN_USER . ", groups) ")->Select();

        foreach($userList as $i=> $user){
            $roleIds =    explode(",",$user['groups']);
            $roleName = "";
            foreach($roleIds as $id){
                $dao =  new \Think\Model();
                $res = $dao->query("select * from qs_auth_group  where id='$id' ");
                $roleName = $roleName.$res[0]['name']."<br> ";
            }
            $userList[$i]['groups']= $roleName;
        }
        $this->assign('userList', $userList);
        $this->assign('SHOW_MENU', "ADMIN_MNG");
        $this->assign('showMenu', 1);

        $this->display();
    }


    /**
     * 备注用户列表
     */
    public function remarkUser()
    {
        $uid = I('param.id');
        $remark = I('param.remark');
        $dao =  new \Think\Model();
        $cnt = $dao->execute("update qs_user_profile set remark='$remark' where id='$uid' ");
        $this->ajaxReturn($cnt);
    }

    /**
     * 用户列表 1
     */
    public function listUser() {

        // select u.id uid, p.name name, p.nick_name , p.`reg_time`, p.`login_time`,p.`stay_time`,p.`remark` ,p.`invite_code`
        // from qs_user u, qs_user_profile p
        // where u.id=p.id and find_in_set(3, u.groups)
        // and u.id in ( select l.uid from  qs_user_label l where l.lid='39')
        // and u.id in ( select t.uid from ( select s2.uid as uid ,s2.lid,avg(s2.score) as avg_score from qs_user_score s2 where lid=32 group by s2.lid ,s2.uid  ) t where t.avg_score>=3 )

        $uid = I('param.uid');

        $lids = I('param.lids');
        $scoreIds = I('param.scoreIds');

        $lidsName = I('param.lidsName');
        $scoreIdsName = I('param.scoreName');

        $gotoPage = I('param.gotoPage');

        $sort = I('param.sort');
        $invite_code = I('param.invite_code');
        $name = I('param.name');

        $recorderCnt = I('param.recorderCnt');
        $pageCnt = I('param.pageCnt');

        if(empty($gotoPage)){
            $gotoPage = 1;
        }

        if($gotoPage<0  ){
            $gotoPage =1;
        }

        if(empty($pageCnt)){
            $pageCnt = 1;
        }

        if($gotoPage > $pageCnt){
            $gotoPage = $pageCnt;
        }



        $pageSize = I('param.pageSize');
        if(empty($pageSize)){
            $pageSize = 20;
        }


        //更新用户的邀请码
        $dao =  new \Think\Model();
        $sql = " select * from qs_invcode where uid > 0";
        $list = $dao->query($sql);
        foreach($list as $value){
            $userProfile = M("UserProfile");
            $userProfile->where("id = ".$value['uid'])->setField("invite_code",$value['code']);

        }

        //测试数据
        //        $scoreIds ="32_2,33_5";
        //        $lids = "39,40";
        //$invite_code ='NO';
//        $name = "李";
        $dao =  new \Think\Model();

        $sql =  " select u.id id,u.mobile mobile, p.name name, p.nick_name , p.reg_time , p.login_time,p.logout_time,p.stay_time,p.remark ,p.invite_code ,p.head_img,u.status,p.account_left ,p.remark,p.amt_money"
        ." from qs_user u, qs_user_profile p "
        ." where u.id=p.id and find_in_set(" . $this::FRONT_USER . ", u.groups) " ;

        if(!empty($uid)){
            $sql = $sql." and u.id=".$uid;
        }

        //邀请码
        if(!empty($invite_code)){
            if($invite_code =='HAVE'){
                $sql = $sql." and  p.invite_code is not null  ";
            }else if($invite_code =='NO' ){
                $sql = $sql." and p.invite_code is null";
            }else{
                $sql = $sql." and  p.invite_code='".$invite_code."'";
            }

        }

        //邀请码
        if(!empty($name)){
            $sql = $sql." and p.nick_name like '%".$name."%' ";

        }


        //查询用户标签
        if(!empty($lids)){
            if($lids=='NO_LABEL'){
                $sql = $sql." and  u.id not in ( select uu.uid from ( select uid,count(*) from  qs_user_label group by uid ) as uu )";
            }elseif($lids=='HAVE_LABEL'){
                 $sql = $sql." and  u.id in ( select uu.uid from ( select uid,count(*) from  qs_user_label group by uid ) as uu )";
            }else{
                $sql = $sql." and  u.id in ( select l.uid from  qs_user_label l where l.lid in (".$lids.") )";
            }

        }

        //$scoreIds : lid_score 查询用户评分的
        if(!empty($scoreIds)){

            if("NO_SCORE" == $scoreIds) {
                $sql = $sql." and  u.id not in ( select ss.uid from (select uid, count(*) cnt from qs_user_score group by uid) as ss ) ";
            }else if("HAVE_SCORE" == $scoreIds){
                $sql = $sql." and u.id  in ( select ss.uid from (select uid, count(*) cnt from qs_user_score group by uid) as ss ) ";
            }else{

                 $arrId1 = explode(",",$scoreIds);
                 if(sizeof($arrId1)==1){
                     $arrId2 = explode("_",$arrId1[0]);
                     $sql = $sql." and u.id in ( select t.uid from ( select s2.uid as uid ,s2.lid,avg(s2.score) as avg_score from qs_user_score s2 where lid=".$arrId2[0]." group by s2.lid ,s2.uid  ) t where t.avg_score>=".$arrId2[1]." )";
                 }

                if(sizeof($arrId1) > 1 ){

                    $index = 0;
                    $sql = $sql." and u.id in ( ";
                    foreach($arrId1 as $key){
                        $arrId2 = explode("_",$key);
                        if($index==0){
                            $sql = $sql." select t.uid from ( select s2.uid as uid ,s2.lid,avg(s2.score) as avg_score from qs_user_score s2 where lid=".$arrId2[0]." group by s2.lid ,s2.uid  ) t where t.avg_score>=".$arrId2[1];
                        }else{
                            $sql = $sql." union all select t.uid from ( select s2.uid as uid ,s2.lid,avg(s2.score) as avg_score from qs_user_score s2 where lid=".$arrId2[0]." group by s2.lid ,s2.uid  ) t where t.avg_score>=".$arrId2[1];
                        }
                        $index++;
                    }
                    $sql = $sql." ) ";
                }
            }
        }

        $idList = $dao->query($sql);
        $recorderCnt=sizeof($idList);
        $pageCnt = ceil($recorderCnt/$pageSize);

        //排序
        if(empty($sort)){
            $sql = $sql." order by p.reg_time desc , p.login_time desc";
        }else{
            $sql = $sql." order by ".$sort." desc";
        }

        $from = ($gotoPage-1)*$pageSize;
        // 分页
        $sql = $sql." limit ".$from.",".$pageSize;
        $idList = $dao->query($sql);


        $userList =array();
        foreach($idList as $value){

            $rowList =array("userInfo"=>array(),"acntInfo"=>array(),"labelInfo"=>array(),"scoreInfo"=>array());

            //用户基本信息
            $userInfo = array();
            $userInfo["name"]=$value['name'];
            $userInfo["nick_name"]=$value['nick_name'];
            $userInfo["head_img"]=$value['head_img'];
            $userInfo["mobile"]=$value['mobile'];
            $userInfo["reg_time"]=$value['reg_time'];
            $userInfo["login_time"]=$value['login_time'];
            $userInfo["logout_time"]=$value['logout_time'];
            $userInfo["stay_time"]=$value['stay_time'];
            $userInfo["invite_code"]=$value['invite_code'];
            $userInfo["status"]=$value['status'];
            $userInfo["id"]=$value['id'];
            $userInfo["remark"]=$value['remark'];

            if(empty($userInfo["stay_time"])){
                $userInfo["stay_time"]= calStayTime($value["login_time"], $value['logout_time']);
            }

            array_push($rowList["userInfo"],$userInfo);

            //用户账户信息
            $acntInfo = array();
            $acntInfo['account_left']=$value['account_left'];//账户余额
            $acntInfo['amt_money']=$value['amt_money'];//账户余额

            //发布数
            $Model = new \Think\Model();
            $res = $Model->query("select count(*) releaseCnt from qs_books b where b.isup=1 and b.uid=".$value['id']);
            $acntInfo['releaseCnt']=$res[0]['releasecnt'];

            //未发布数
            $Model = new \Think\Model();
            $res = $Model->query("select count(*) draftCnt from qs_books b where b.isup=0 and b.uid=".$value['id']);
            $acntInfo['draftCnt']=$res[0]['draftcnt'];


            //已读数
            $Model = new \Think\Model();
            $res = $Model->query("select count(DISTINCT(h.bid)) readCnt from  qs_user_read_history h LEFT JOIN qs_books b ON h.bid =b.id  where h.status=1 and h.type=0 and h.uid=".$value['id']." AND b.type !=0 and b.isup=1 ");
            $acntInfo['readCnt']=$res[0]['readcnt'];

            //收藏数
            $Model = new \Think\Model();
            $res = $Model->query("select count(DISTINCT(h.bid)) favoriteCnt from  qs_user_read_history h  LEFT JOIN qs_books b ON h.bid =b.id  where h.status=1 and h.type=1 and h.uid=".$value['id']." AND b.type !=0 and b.isup=1 ");
            $acntInfo['favoriteCnt']=$res[0]['favoritecnt'];
            array_push($rowList["acntInfo"],$acntInfo);


            $uid = $value['id'];
            $Model = new \Think\Model();
            $res = $Model->query("select u.name username, t.name labelname, u.id uid,t.id lid from  qs_user_profile u , qs_user_label l, qs_type_list t where u.id=l.cid  and t.status=1 and l.lid=t.id and l.uid=$uid order by t.sort_num");

            $labelList =   array();
            foreach($res as $item){
                if($labelList[$item['labelname']]==null){
                    $labelList[$item['labelname']] = array();
                }
                array_push($labelList[$item['labelname']], $item["username"]);

            }

            array_push($rowList["labelInfo"],$labelList );

            //用户评分信息
            $Model = new \Think\Model();

            $sql = " SELECT s.uid, s.lid ,round(avg(s.score) ,1) as score,t.name "
                 ." FROM qs_type_list t left join qs_user_score s  "
                 ." on t.id=s.lid  "
                 ." where t.type=".$this::TYPE_USER_SCORE
                 ." and t.status=1  "
                 ." and s.uid=  ".$value['id']
                 ." group by s.uid,s.lid  ";

            $scoreInfo = $Model->query($sql);
            array_push($rowList["scoreInfo"],$scoreInfo);
            array_push($userList,$rowList);
        }

        $this->assign('userList', $userList);

        $Model = new \Think\Model();

        $scorelabelList = $Model->query("select * from qs_type_list where status=1 and type =".$this::TYPE_USER_SCORE." order by sort_num");
        $labelList = $Model->query("select * from qs_type_list where status=1 and type =".$this::TYPE_WRITER_LABEL." order by sort_num");
        $this->assign('scorelabelList', $scorelabelList);
        $this->assign('labelList', $labelList);


        $lids = I('param.lids');
        $scoreIds = I('param.scoreIds');
        $sort = I('param.sort');
        $invite_code = I('param.invite_code');
        $name = I('param.name');

        $this->assign('lids', $lids);
        $this->assign('scoreIds', $scoreIds);

        $this->assign('sort', $sort);
        $this->assign('invite_code', $invite_code);
        $this->assign('name', $name);

        $this->assign('lidsName', $lidsName);
        $this->assign('scoreIdsName', $scoreIdsName);

        $this->assign('recorderCnt', $recorderCnt);
        $this->assign('pageCnt', $pageCnt);
        $this->assign('gotoPage', $gotoPage);
        $this->assign('pageSize', $pageSize);
        $this->assign('SHOW_MENU', "ADMIN_USER");
        $this->display();

    }



    /**
     * 新增或者修改用户页面
     */
    public function entry() {

        $id = I('param.id');

        if (!empty($id)) {
            $dao = D("user");
            $user = $dao->relation(true)->find($id);
            $this->assign('user', $user);
        }


        $dao = M("AuthGroup");
        $groupList = $dao->where("id!=1 and id!=2")->select();
        $this->assign('groupList', $groupList);


        $this->display();
    }

    /**
     * 新增或修改用户
     */
    public function save(){

        $id = I('param.id');
        $password = I('param.password');
        $groupIds = I('post.groupId');

        $name = I('param.name');
        $nick_name = I('param.nick_name');
        $age = I('param.age');
        $sex = I('param.sex');

        $dao = D("user");


        if (!empty($id)) {
            $user = $dao->relation(true)->find($id);

            if(!empty($password)){
                $user['password'] =md5($password);
            }

            if($groupIds!=null){
                $user['groups'] =implode(',', $groupIds).",".$this::ADMIN_USER;
            }else{
                $user['groups'] = $this::ADMIN_USER;
            }

            if(!empty($name)){
                $user['Profile']['name'] =$name;
            }

            if(!empty($nick_name)){
                $user['Profile']['nick_name'] =$nick_name;
            }

            if(!empty($age)){
                $user['Profile']['age'] =$age;
            }

            if(!empty($sex)){
                $user['Profile']['sex'] =$sex;
            }

            if(!empty($nick_name)){
                $user['Profile']['nick_name'] =$nick_name;
            }



            $condition['id'] = $id;
            $result = $dao->relation(true)->where($condition)->save($user);
        } else {

            $user['password'] =md5("f");
            $mobile = I('post.mobile');

            if($groupIds!=null){
                $user['groups'] =implode(',', $groupIds).",".$this::ADMIN_USER;
            }else{
                $user['groups'] = $this::ADMIN_USER;
            }

            if(!empty($mobile)){
                $user['mobile'] =$mobile;
            }

            if(!empty($name)){
                $user['Profile']['name'] =$name;
            }

            if(!empty($nick_name)){
                $user['Profile']['nick_name'] =$nick_name;
            }

            if(!empty($age)){
                $user['Profile']['age'] =$age;
            }

            if(!empty($name)){
                $user['Profile']['sex'] =$sex;
            }

            $user['status']=1;
            $user['Profile']['status'] =1;
            $dao = D("User");
            $mobile = I('param.mobile');
            $userList = $dao->where(" mobile= $mobile ")->find();

            if(!empty($userList)){
                 echo "手机号已存在!";
            }else{
                $result = $dao->relation(true)->add($user);
            }

        }
        $this->redirect(BASE_PATH.'/User/listAdmin');
    }


    /**
     * 更改用户状态
     */
    public function del()
    {

        $id = I('param.id');
        $status = I('param.status');
        $flag = I('param.flag');
        $dao = D("user");

        if (status != null) {
            $data['status'] = $status;
            $data["Profile"] = array(
                'id' => $id,
                'status' => $status,
            );
        }

        if (!empty($id)) {
            $condition['id'] = $id;
            $result = $dao->relation(true)->where($condition)->save($data);
        }
        if (!empty($flag)) {
            $this->redirect(BASE_PATH.'/User/listUser');
        }else{
            $this->redirect(BASE_PATH.'/User/listAdmin');
        }

    }


    /**
     * 阅读收藏过的列表
     */
    public function readList(){
        $type = I('param.type');
        $uid = I('param.uid');

        //收藏数
        $Model = new \Think\Model();
        $readSql = " select distinct(h.bid) bid ,b.uid authorid, b.name bookName ,b.indu ,b.utime, b.ctime, b.share_cnt,b.mark_cnt,b.buy_cnt,b.edit_cnt,b.read_cnt,b.word_cnt,b.price,u.nick_name userName, 'scoreinfo' as scoreinfo ,'labelinfo' as labelinfo ,h.time readtime ,u.id uid , 'authorname' as authorname"
                    ." from qs_user_read_history h,qs_books  b ,qs_user_profile u "
                    ." where u.id=h.uid "
                    ."and b.id=h.bid and b.isup=1 and b.type!=0 and h.status=1 and h.type=$type and h.uid=$uid GROUP BY bid order by h.time desc";
        $readList = $Model->query($readSql);
        $this->assign('readList', $readList);


        if (!empty($readList)) {
            foreach ($readList as $key=> $row) {

                //作品评分信息
                $Model = new \Think\Model();

                $authorName = $Model->query(" select p.nick_name authorname  from qs_books b ,qs_user_profile p where  p.id=b.uid  and b.id=".$row['bid']  );
                $readList[$key]['authorname']=$authorName;

                $sql = " SELECT s.bid, s.lid ,round(avg(s.score) ,1) as score,t.name "
                    ." FROM qs_type_list t left join qs_book_score s  "
                    ." on t.id=s.lid  "
                    ." where t.type=".$this::TYPE_BOOK_SCORE
                    ." and t.status=1  "
                    ." and s.bid=  ".$row['bid']
                    ." group by s.bid,s.lid  ";

                $scoreInfo = $Model->query($sql);

                $readList[$key]["scoreinfo"]=$scoreInfo ;


                $Model = new \Think\Model();

                $labelSql = ' SELECT t.id lid, t.name lname, u.id cid ,u.name username  '
                    .' FROM qs_type_list t , qs_book_label l,qs_user_profile u '
                    .' where t.id=l.lid and l.cid = u.id'
                    .' and t.type='.$this::TYPE_LABEL
                    .' and t.status=1'
                    .' and l.bid='.$row['bid'];

                $labelInfo = $Model->query($labelSql);

                $readList[$key]["labelinfo"]=$labelInfo ;

            }

        }


        $this->ajaxReturn($readList);
    }

    /**
     * 发布、未发布列表
     */
    public function writeList(){
        $type = I('param.type');
        $uid = I('param.uid');
        $this->assign('uid', $uid);
        $this->assign('type', $type);
        $this->display();

    }

    /**
     * 发布、未发布列表
     */
    public function getWriteList()
    {
        $type = I('param.type');
        $uid = I('param.uid');

        $file = 'log.txt';
        file_put_contents($file, "\r\n" . " sql=----》" , FILE_APPEND);


        $Model = new \Think\Model();
        $sql = "select b.id bid, b.name bookname, b.indu, b.price,b.utime, b.lutime, u.id uid, u.nick_name username ,b.price_or_node,b.read_cnt,b.mark_cnt,b.share_cnt,b.buy_cnt,b.money_cnt,b.word_cnt ,b.edit_cnt ,b.ctime ,'scoreinfo' as scoreInfo ,'labelinfo' as labelinfo"
            . " from qs_books b, qs_user_profile u "
            . " where b.uid = u.id and b.isup=$type and u.id=$uid order by b.ctime desc,b.utime desc";
        $writeList = $Model->query($sql);
        file_put_contents($file, "\r\n" . " sql=----》".$sql , FILE_APPEND);

        if (!empty($writeList)) {
            foreach ($writeList as $key=> $row) {

                //作品评分信息
                $Model = new \Think\Model();

                $sql = " SELECT s.bid, s.lid ,round(avg(s.score) ,1) as score,t.name "
                    ." FROM qs_type_list t left join qs_book_score s  "
                    ." on t.id=s.lid  "
                    ." where t.type=".$this::TYPE_BOOK_SCORE
                    ." and t.status=1  "
                    ." and s.bid=  ".$row['bid']
                    ." group by s.bid,s.lid  ";

                $scoreInfo = $Model->query($sql);

                $writeList[$key]["scoreinfo"]=$scoreInfo ;


                $Model = new \Think\Model();

                $labelSql = ' SELECT t.id lid, t.name lname, u.id cid ,u.name username  '
                    .' FROM qs_type_list t , qs_book_label l,qs_user_profile u '
                    .' where t.id=l.lid and l.cid = u.id'
                    .' and t.type='.$this::TYPE_LABEL
                    .' and t.status=1'
                    .' and l.bid='.$row['bid'];

                $labelInfo = $Model->query($labelSql);

                $writeList[$key]["labelinfo"]=$labelInfo ;

            }

        }

        $this->ajaxReturn($writeList);
    }

    /**
     * 用户被打的标签
     */
    public function userLabel(){
        $uid = I('param.uid');
        $this->assign('uid', $uid);
        $this->display();
        //$this->ajaxReturn($labelList);
    }

    /**
     * 用户被打的标签
     */
    public function getUserLabel(){
        $uid = I('param.uid');

        $Model = new \Think\Model();
        $res = $Model->query("select u.name username, t.name labelname, u.id uid,t.id lid from  qs_user_profile u , qs_user_label l, qs_type_list t where u.id=l.cid  and t.status=1 and l.lid=t.id and l.uid=$uid order by t.sort_num");

        //用户被打标签
        $labelList =   array();
        foreach($res as $item){
            if($labelList[$item['labelname']]==null){
                $labelList[$item['labelname']] = array();
            }
            array_push($labelList[$item['labelname']], $item["username"]);

        }

        //我的标签
        $cid = session('LOGIN_USER')['id'];
        $myLabelList  = $Model->query("select * from qs_user_label where  cid=$cid and uid=$uid  ");

        //所有标签
        $allLabelList = $Model->query("select t.*,'selected' from qs_type_list t where status=1 and type =".$this::TYPE_WRITER_LABEL." order by sort_num");
        foreach($allLabelList as $key=>$row){
            foreach($myLabelList as $my){
                if($row['id'] == $my['lid']){
                    $allLabelList[$key]['selected']=1;
                }
            }

        }
        $result = array('labelInfo'=>$labelList,'allLabel'=>$allLabelList);
        $this->ajaxReturn($result);
    }



    /**
     * 给用户打标签
     */
    public function labelUser(){
        $uid = I('param.uid');
        $lid = I('param.lid');

        $cid = session('LOGIN_USER')['id'];
        $data['uid'] = $uid;
        $data['lid'] = $lid;
        $data['cid'] = $cid;
        $data['time'] = date("Y-m-d H:i:s");;

        $UserLabel = M('UserLabel');
        $condition['uid'] = $uid;
        $condition['lid'] = $lid;
        $condition['cid'] = $cid;
        $res = $UserLabel->where($condition)->select();
        $id =-1;
        if(empty($res)){
            $id=$UserLabel->data($data)->add();
        }

        $this->ajaxReturn($id);

    }

    /**
     * 取消用户标签
     */
    public function cancelLabel(){
        $uid = I('param.uid');
        $lid = I('param.lid');

        $cid = session('LOGIN_USER')['id'];
        $data['uid'] = $uid;
        $data['lid'] = $lid;
        $data['cid'] = $cid;
        $data['time'] = date("Y-m-d H:i:s");;

        $UserLabel = M('UserLabel');
        $condition['uid'] = $uid;
        $condition['lid'] = $lid;
        $condition['cid'] = $cid;
        $res = $UserLabel->where($condition)->delete();

        $this->ajaxReturn($res);

    }


    /**
     * 取得所有用户类型标签
     */
    public function getAllLabel(){
        $Model = new \Think\Model();
        $labelList = $Model->query("select *  from qs_type_list where status=1 and type =".$this::TYPE_WRITER_LABEL." order by sort_num");

        $this->ajaxReturn($labelList);
    }

    /**
     * 用户评分页面
     */
    public function userScore(){
        $uid = I('param.uid');
        $this->assign('uid', $uid);
        $this->display();
    }


    public function getUserAvgScore(){
        $Model = new \Think\Model();
        $uid = I('param.uid');
        $sql = " SELECT s.uid, s.lid ,round(avg(s.score) ,1) as score,t.name "
            ." FROM  qs_user_score s left join qs_type_list t  "
            ." on t.id=s.lid   "
            ." where t.type=".$this::TYPE_USER_SCORE
            ." and t.status=1  "
            ." and s.uid=  ".$uid
            ." group by s.uid,s.lid  ";

        $scoreInfo = $Model->query($sql);
        $this->ajaxReturn($scoreInfo);
    }

    /**
     * 用户被评的分
     */
    public function getUserScore(){
        $uid = I('param.uid');
        $cid = session('LOGIN_USER')['id'];
        $cname = session('LOGIN_USER')['Profile']['name'];

        $Model = new \Think\Model();
        $labelList =   array();

        $scoreLabelList = $Model->query("select * from qs_type_list where status=1 and type =".$this::TYPE_USER_SCORE." order by sort_num");
        foreach($scoreLabelList as $item){

            //查找操作人为非session用户的评分记录
            $userList = $Model->query("select u.name username, t.name labelname, s.lid lid, s.score score,s.cid "
                                        ." from  qs_user_score s ,qs_user_profile u , qs_type_list t "
                                        ." where s.lid = t.id"
                                        ." and s.cid = u.id"
                                        ." and s.uid=$uid"
                                        ." and s.lid=".$item['id']
                                        ." and s.cid !=$cid");
            if(!empty($userList)){
                foreach($userList as $item2) {

                    if(empty($labelList[$item2['username']])){
                        $labelList[$item2['username']] = array();
                    }
                     array_push($labelList[$item2['username']], $item2);
                }
            }

            $myList = $Model->query(" select u.name username, t.name labelname, s.lid lid, s.score score,s.cid "
                ." from  qs_user_score s ,qs_user_profile u , qs_type_list t "
                ." where s.lid = t.id "
                ." and s.cid = u.id "
                ." and s.uid=$uid "
                ." and s.lid=".$item['id']
                ." and s.cid=$cid ");

            if(!empty($myList)){

                if(empty($labelList[$cname])){
                    $labelList[$cname] = array();
                }
                array_push($labelList[$cname], $myList[0]);


            }else{
                $rec= array("username"=>$cname,"labelname"=>$item['name'],"lid"=>$item['id'],"score"=>0,"cid"=>$item['cid']);

                if(empty($labelList[$cname])){
                    $labelList[$cname] = array();
                }
                array_push($labelList[$cname], $rec);

            }


        }

        $this->ajaxReturn($labelList);
    }


    /**
     * 给用户打分
     */
    public function scoreUser(){
        $uid = I('param.uid');
        $lid = I('param.lid');
        $score = I('param.score');

        $cid = session('LOGIN_USER')['id'];
        $data['uid'] = $uid;
        $data['lid'] = $lid;
        $data['cid'] = $cid;
        $data['time'] = date("Y-m-d H:i:s");;
        $data['score'] = $score;

        $UserLabel = M('UserScore');
        $condition['uid'] = $uid;
        $condition['lid'] = $lid;
        $condition['cid'] = $cid;

        $res = $UserLabel->where($condition)->select();
        $id =-1;
        if(empty($res)){
            $id=$UserLabel->data($data)->add();
        }else{
            $id=$UserLabel->where($condition)->save($data);
        }

        $this->ajaxReturn($id);

    }

    /**
     * 账户信息
     */
    public function getUserAccountInfo(){
        $uid = I('param.uid');

        $profile = M("userProfile");
        $condition = array(
            "id" =>$uid
        );
        $actInfo = $profile->field('id,name,nick_name,amt_money,account_left,get_money')->where($condition)->find();


        //收益记录
        $Model = new \Think\Model();
        $gainList = $Model->query("select h.*,p.nick_name,b.name book_name from qs_user_pay_history h ,qs_user_profile  p ,qs_books b where b.id=h.bid and p.id= h.uid and h.author_id=$uid and h.status=1 and h.money <> 0 order by h.pay_time desc,h.order_time desc");

        //购买记录
        $Model = new \Think\Model();
        $buyList = $Model->query("select h.*,p.nick_name,b.name book_name  from qs_user_pay_history h left join qs_user_profile  p on h.author_id = p.id  left join qs_books b on h.bid = b.id where h.uid=$uid and h.status=1 and h.money > 0 order by h.pay_time desc,h.order_time desc ");

        //提现记录
        $Model = new \Think\Model();
        $cashList = $Model->query("select * from qs_user_apply_history where uid=$uid order by apply_date desc,pay_time desc ");

        $userAcntInfo = array("amt"=>$actInfo['amt_money'],"left"=>$actInfo['account_left']
            ,"gains_history"=> $gainList
            ,"buy_history"=>$buyList
            ,"cash_history"=>$cashList
        );

        $this->ajaxReturn($userAcntInfo);

    }
}