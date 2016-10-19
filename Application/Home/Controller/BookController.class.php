<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model;
use Home\Service;
class BookController extends BaseController {

    /**
     * 模糊搜索用户
     */
    public function getUserByName()
    {
        $nick_name = I('param.nick_name');
        if (!empty($nick_name)) {
            $Model = new \Think\Model();
            $userList = $Model->query("select * from qs_user_profile where nick_name  like '%$nick_name%' order by reg_time");
        }
        $this->ajaxReturn($userList);
    }


    public function getBookById()
    {
        $id = I('param.id');
        $bookDao = D('Books');
        $book = $bookDao->where("id=$id")->find();
        $this->ajaxReturn($book);
    }


    public function setBookType()
    {
        $id = I('param.id');
        $type = I('param.type');

        if(empty($id)||empty($type)){
            $this->ajaxReturn(false);
        }

        $bookDao = D('Books');
        $book = $bookDao->where("id=$id")->find();
        $book['type']=$type;
        $bookDao->where("id=$id")->save($book);
        $this->ajaxReturn(true);
    }


    /**
     * 作品列表页面
     */
    public function bookList() {
        $file  = 'log.txt';
        $lids = I('param.lids');
        $scoreIds = I('param.scoreIds');
        $gotoPage = I('param.gotoPage');
        $sort = I('param.sort');
        $begin_time = I('param.begin_time');
        $end_time = I('param.end_time');
        $name = I('param.name');
        $bid = I('param.bid');
        $isup = I('param.isup');
        $upTime = I('param.upTime');
        $uid = I('param.uid');
        $nick_name = I('param.nick_name');
        $bookType = I('param.bookType');


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


        //作品分类
        $Model = new \Think\Model();
        $bookTypeList = $Model->query("select * from qs_type_list where status=1 and type =".$this::TYPE_BOOK." order by sort_num desc");
        $this->assign('bookTypeList', $bookTypeList);

        //作品评分标准
        $Model = new \Think\Model();
        $scoreLabelList = $Model->query("select * from qs_type_list where status=1 and type =".$this::TYPE_BOOK_SCORE." order by sort_num");
        $this->assign('scoreLabelList', $scoreLabelList);

        //作品标签
        $bookLabelList = $Model->query("select * from qs_type_list where status=1 and type =".$this::TYPE_LABEL." order by sort_num");
        $this->assign('bookLabelList', $bookLabelList);

        $sql = " select b.*,b.utime uptime,u.id authorid,u.nick_name authorname from qs_books b, qs_user_profile u where u.id=b.uid and b.type<>0  ";

        if(!empty($name)){
            $sql = $sql." and b.name like '%$name%' ";
        }

        if(!empty($nick_name)){
            $sql = $sql." and u.nick_name like '%$nick_name%' ";
        }


        if(!empty($bid)){
            $sql = $sql." and b.id=$bid  ";
        }

        if($isup!=''){
            $sql = $sql." and b.isup=$isup  ";
        }

        if(!empty($uid)){
            $sql = $sql." and b.uid=$uid  ";
        }

        if(!empty($bookType)){
            $sql = $sql." and b.type=$bookType  ";
        }

        if(!empty($upTime)){

            $dates = explode("-",$upTime);
            $startDate = strtotime(trim($dates[0]).' 00:00:00');
            $endDate = strtotime(trim($dates[1]).' 23:59:59');

            $sql = $sql." and b.utime between  $startDate and $endDate";
        }

        //标签不为空
        if(!empty($lids)){
            if($lids=='NO_LABEL'){
                $sql = $sql." and  b.id not in ( select uu.bid from ( select bid,count(*) from qs_book_label where lid=$lids  group by bid ) as uu )";
            }else{
                $sql = $sql." and  b.id in ( select bid from qs_book_label where   lid in ( $lids ) )";
            }
        }


//        $scoreIds="25_4,26_4";
        //评分不为空
        if(!empty($scoreIds)){
            if("NO_SCORE" == $scoreIds) {
                $sql = $sql." and  b.id not in ( select uu.bid from ( select bid,count(*) from qs_book_score group by bid ) as uu ) ";
            }else{

                $arrId1 = explode(",",$scoreIds);
                if(sizeof($arrId1)==1){
                    $arrId2 = explode("_",$arrId1[0]);
                    $sql = $sql." and b.id in ( select t.bid from ( select s2.bid as bid ,s2.lid,avg(s2.score) as avg_score from qs_book_score s2 where lid=".$arrId2[0]." group by s2.lid ,s2.bid  ) t where t.avg_score>=".$arrId2[1]." )";
                }

                if(sizeof($arrId1) > 1 ){

                    $index = 0;
                    $sql = $sql." and b.id in ( ";
                    foreach($arrId1 as $key){
                        $arrId2 = explode("_",$key);
                        if($index==0){
                            $sql = $sql." select t.bid from ( select s2.bid as bid ,s2.lid,avg(s2.score) as avg_score from qs_book_score s2 where lid=".$arrId2[0]." group by s2.lid ,s2.bid  ) t where t.avg_score>=".$arrId2[1];
                        }else{
                            $sql = $sql." union all select t.bid from ( select s2.bid as bid ,s2.lid,avg(s2.score) as avg_score from qs_book_score s2 where lid=".$arrId2[0]." group by s2.lid ,s2.bid  ) t where t.avg_score>=".$arrId2[1];
                        }
                        $index++;
                    }
                    $sql = $sql." ) ";
                }
            }
        }

        //var_dump($sql);
        file_put_contents($file,"\r\n"." book query sql =".$sql,FILE_APPEND);

        //作品列表
        $idList = $Model->query($sql);

        //总记录数
        $recorderCnt=sizeof($idList);

        //总页数
        $pageCnt = ceil($recorderCnt/$pageSize);


        //排序
        if(empty($sort)){
            $sql = $sql." order by b.utime desc,b.etime desc,b.ctime desc";
        }else{

            $sql = $sql." order by ".$sort ." desc";
        }

        // 分页
        $from = ($gotoPage-1)*$pageSize;
        $sql = $sql." limit ".$from.",".$pageSize;

        $idList = $Model->query($sql);

        $bookList =array();
        foreach($idList as $value){
            $rowList =array("bookInfo"=>array(),"labelInfo"=>array(),"scoreInfo"=>array(),"priceInfo"=>array());

            //作品基本信息
            $bookInfo = array();
            $bookInfo["id"]=$value['id'];
            $bookInfo["type"]=$value['type'];
            $bookInfo["uid"]=$value['authorid'];
            $bookInfo["authorname"]=$value['authorname'];
            $bookInfo["name"]=$value['name'];
            $bookInfo["indu"]=$value['indu'];
            $bookInfo["price"]=$value['price'];
            $bookInfo["isup"]=$value['isup'];
            $bookInfo["isover"]=$value['isover'];
            $bookInfo["ctime"]=$value['ctime'];
            $bookInfo["price_or_node"]=$value['price_or_node'];
            $bookInfo["or_cnt"]=$value['or_cnt'];
            $bookInfo["uptime"]=$value['uptime'];
            $bookInfo["lutime"]=$value['lutime'];
            $bookInfo["or_cnt"]=$value['or_cnt'];

            $bookInfo["read_cnt"]=$value['read_cnt'];
            $bookInfo["mark_cnt"]=$value['mark_cnt'];
            $bookInfo["buy_cnt"]=$value['buy_cnt'];
            $bookInfo["money_cnt"]=$value['money_cnt'];
            $bookInfo["share_cnt"]=$value['share_cnt'];
            $bookInfo["word_cnt"]=$value['word_cnt'];
            array_push($rowList["bookInfo"],$bookInfo);


            //作品标签信息
            $Model = new \Think\Model();

            $labelSql = ' SELECT t.id lid, t.name lname, u.id cid ,u.name username  '
                        .' FROM qs_type_list t , qs_book_label l,qs_user_profile u '
                        .' where t.id=l.lid and l.cid = u.id'
                        .' and t.type='.$this::TYPE_LABEL
                        .' and t.status=1'
                        .' and l.bid='.$value['id'];

            $labelInfo = $Model->query($labelSql);


            $tempArry = array();
            foreach($labelInfo as $row){
                if(empty($tempArry[$row['lname']]) ){
                    $tempArry[$row['lname']] = array();
                }
                array_push($tempArry[$row['lname']],$row['username']);
            }


            array_push($rowList["labelInfo"],$tempArry);

            //作品评分信息
            $Model = new \Think\Model();

            $sql = " SELECT s.bid, s.lid ,round(avg(s.score) ,1) as score,t.name "
                ." FROM qs_type_list t left join qs_book_score s  "
                ." on t.id=s.lid  "
                ." where t.type=".$this::TYPE_BOOK_SCORE
                ." and t.status=1  "
                ." and s.bid=  ".$value['id']
                ." group by s.bid,s.lid  ";

            $scoreInfo = $Model->query($sql);
            array_push($rowList["scoreInfo"],$scoreInfo);

            //价格修改历史
            $sql = " SELECT * "
                ." FROM qs_book_price_history  "
                ." where bid=".$value['id']
                ." order by time desc  ";
            $priceInfo = $Model->query($sql);
            array_push($rowList["priceInfo"],$priceInfo);

            array_push($bookList,$rowList);

        }

        $this->assign('bookList', $bookList);

        $this->assign('lids', $lids);
        $this->assign('scoreIds', $scoreIds);

        $this->assign('sort', $sort);
        $this->assign('begin_time', $begin_time);
        $this->assign('end_time', $end_time);
        $this->assign('name', $name);
        $this->assign('isup', $isup);

        $this->assign('recorderCnt', $recorderCnt);
        $this->assign('pageCnt', $pageCnt);
        $this->assign('gotoPage', $gotoPage);
        $this->assign('uid', $uid);
        $this->assign('nick_name', $nick_name);
        $this->assign('bookType', $bookType);
        $this->assign('upTime', $upTime);

        $this->assign('SHOW_MENU', "ADMIN_BOOK");
        $this->display();
    }

    /**
     * 编辑书名
     */
    public function editBookName(){
        $bid = I('param.bid');
        $bookName = I('param.bookName');

        $cid = session('LOGIN_USER')['id'];
        $updateTime = date("Y-m-d H:i:s");;

        $dao =  new \Think\Model();
        $cnt = $dao->execute("update qs_books set name='$bookName' , update_time='$updateTime' ,updater_id=$cid where id='$bid' ");
        $this->ajaxReturn($cnt);

    }

    /**
     * 上架、下架
     */
    public function del(){
        $id = I('param.id');
        $status = I('param.status');

        $cid = session('LOGIN_USER')['id'];
        $updateTime = date("Y-m-d H:i:s");;

        $dao =  new \Think\Model();
        $cnt = $dao->execute("update qs_books set isup=$status , update_time='$updateTime' ,updater_id=$cid  where id=$id ");
        $this->ajaxReturn($cnt);

    }

    public function refreshBookLabel(){

        $bid = I('param.bid');
        //作品标签信息
        $Model = new \Think\Model();

        $labelSql = ' SELECT t.id lid, t.name lname, u.id cid ,u.name username  '
            .' FROM qs_type_list t , qs_book_label l,qs_user_profile u '
            .' where t.id=l.lid and l.cid = u.id'
            .' and t.type='.$this::TYPE_LABEL
            .' and t.status=1'
            .' and l.bid='.$bid;
        $labelInfo = $Model->query($labelSql);

        $this->ajaxReturn($labelInfo);
    }

    public function refreshBookScore(){

        $bid = I('param.bid');
        //作品评分信息
        $Model = new \Think\Model();

        $sql = " SELECT s.bid, s.lid ,round(avg(s.score) ,1) as score,t.name "
            ." FROM qs_type_list t left join qs_book_score s  "
            ." on t.id=s.lid  "
            ." where t.type=".$this::TYPE_BOOK_SCORE
            ." and t.status=1  "
            ." and s.bid=  ".$bid
            ." group by s.bid,s.lid  ";

        $scoreInfo = $Model->query($sql);

        $this->ajaxReturn($scoreInfo);
    }

    /**
     * 作品标签页
     */
    public function getBookLabel(){

        $bid = I('param.id');

        $Model =  new \Think\Model();

        //作品被打标签
        $labelSql = ' SELECT t.id lid, t.name lname, u.id cid ,u.name username  '
            .' FROM qs_type_list t , qs_book_label l,qs_user_profile u '
            .' where t.id=l.lid and l.cid = u.id'
            .' and t.type='.$this::TYPE_LABEL
            .' and t.status=1'
            .' and l.bid='.$bid;
        $bookLabel= $Model->query($labelSql);
        $tempArry = array();
        foreach($bookLabel as $row){
            if(empty($tempArry[$row['lname']]) ){
                $tempArry[$row['lname']] = array();
            }
            array_push($tempArry[$row['lname']],$row['username']);
        }


        //我的标签
        $cid = session('LOGIN_USER')['id'];
        $myLabelList  = $Model->query("select * from qs_book_label where  cid=$cid and bid=$bid  ");


        //所有作品标签
        $allLabelList = $Model->query("select t.*,'selected' from qs_type_list t  where status=1 and type =".$this::TYPE_LABEL." order by sort_num");
        foreach($allLabelList as $key=>$row){
            foreach($myLabelList as $my){
                if($row['id'] == $my['lid']){
                    $allLabelList[$key]['selected']=1;
                }
            }

        }

        $bookInfo = array("bookLabel"=>$tempArry,"allLabel"=>$allLabelList);
        $this->ajaxReturn($bookInfo);
    }


    /**
     * 作品分类
     */
    public function getBookType(){

        //作品分类
        $Model = new \Think\Model();
        $bookTypeList = $Model->query("select * from qs_type_list where status=1 and type =".$this::TYPE_BOOK." order by sort_num desc");
        $this->ajaxReturn($bookTypeList);
    }


    /**
     * 取消作品标签
     */
    public function cancelLabel(){
        $uid = I('param.uid');
        $lid = I('param.lid');

        $cid = session('LOGIN_USER')['id'];
        $data['uid'] = $uid;
        $data['lid'] = $lid;
        $data['cid'] = $cid;
        $data['time'] = date("Y-m-d H:i:s");;

        $UserLabel = M('BookLabel');
        $condition['uid'] = $uid;
        $condition['lid'] = $lid;
        $condition['cid'] = $cid;
        $res = $UserLabel->where($condition)->delete();

        $this->ajaxReturn($res);
    }

    /**
     * 给作品打标签
     */
    public function labelBook(){
        $bid = I('param.bid');
        $lid = I('param.lid');

        $cid = session('LOGIN_USER')['id'];
        $data['bid'] = $bid;
        $data['lid'] = $lid;
        $data['cid'] = $cid;
        $data['time'] = date("Y-m-d H:i:s");;

        $UserLabel = M('BookLabel');
        $condition['bid'] = $bid;
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
     * 作品评分页面
     */
    public function getBookScore(){

        $id = I('param.id');
        $cid = session('LOGIN_USER')['id'];
        $cname = session('LOGIN_USER')['Profile']['name'];

        $Model = new \Think\Model();
        $labelList =   array();

        $scoreLabelList = $Model->query("select * from qs_type_list where status=1 and type =".$this::TYPE_BOOK_SCORE." order by sort_num");
        foreach($scoreLabelList as $item){

            //查找操作人为非session用户的评分记录
            $userList = $Model->query("select u.name username, t.name labelname, s.lid lid, s.score score,s.cid "
                ." from  qs_book_score s ,qs_user_profile u , qs_type_list t "
                ." where s.lid = t.id"
                ." and s.cid = u.id"
                ." and s.bid=$id"
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
                ." from  qs_book_score s ,qs_user_profile u , qs_type_list t "
                ." where s.lid = t.id "
                ." and s.cid = u.id "
                ." and s.bid=$id "
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
     * 作品购买记录
     */
    public function getBookBuy(){
        $id = I('param.id');
        $Model =  new \Think\Model();
        $buySql = " select h.*,u.nick_name name from qs_user_pay_history h ,qs_user_profile u where h.uid=u.id and h.status=1 and bid=$id order by h.pay_time desc ";
        $buyList= $Model->query($buySql);

        $amtSql = " select sum(money) amt from qs_user_pay_history h   where   bid=$id and status=1   ";
        $amt = $Model->query($amtSql);
        if($amt[0]['amt']==null){
            $buyInfo = array("amt"=>0,"buyHistory"=>$buyList);
        }else{
            $buyInfo = array("amt"=>$amt[0]['amt'],"buyHistory"=>$buyList);
        }

        $this->ajaxReturn($buyInfo);

    }

    /**
     * 给作品评分
     */
    public function scoreBook(){
        $bid = I('param.bid');
        $lid = I('param.lid');
        $score = I('param.score');


        $cid = session('LOGIN_USER')['id'];
        $data['bid'] = $bid;
        $data['lid'] = $lid;
        $data['cid'] = $cid;
        $data['time'] = date("Y-m-d H:i:s");;
        $data['score'] = $score;

        $UserLabel = M('BookScore');
        $condition['bid'] = $bid;
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

}