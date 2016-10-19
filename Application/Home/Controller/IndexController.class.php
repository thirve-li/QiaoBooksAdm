<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model;
use Home\Service;
class IndexController extends BaseController {


    public function index(){
        $userDao = D("User");
        $bookDao = D("Books");

        $userPayHistoryDao = D("UserPayHistory");
        $userReadHistoryDao = D("UserReadHistory");

        //注册用户总数
        $userCount = $userDao->count();

        $Model = new \Think\Model();
        //作者数
         $authorCount = $userDao->where("find_in_set(6,groups)")->count();


        //已发布作品数
        $upBookCount = $bookDao->where(" type!=0 and isup=1")->count();

        //作品总数
        $allBookCount = $bookDao->where(" type!=0 ")->count();

        //昨日阅读数最高
        $yesterday = date("Y-m-d",strtotime("-1 day"));
        $sql = "SELECT  count(*) cnt,b.name ,b.id bid  FROM   qs_user_read_history  h , qs_books b WHERE h.bid=b.id and h.type=0 and  h.time BETWEEN UNIX_TIMESTAMP('$yesterday 00:00:00') and UNIX_TIMESTAMP ('$yesterday 23:59:59') GROUP BY b.id order by cnt desc LIMIT 0,1";

        $yesterdayReadCnt = $Model->query($sql);

        //var_dump($yesterdayReadCnt);


        //今日阅读数最高
        $now = date("Y-m-d");
        $sql = "SELECT  count(*) cnt,b.name,b.id bid FROM qs_user_read_history  h , qs_books b WHERE h.bid=b.id and h.type=0 and  h.time BETWEEN UNIX_TIMESTAMP('$now 00:00:00') and UNIX_TIMESTAMP ('$now 23:59:59') GROUP BY b.id order by cnt desc LIMIT 0,1";
        $todayReadCnt = $Model->query($sql);

        //昨日收益最高
        //$yesterdayMaxGain
        $sql = "SELECT SUM(h.money) amt ,b.name ,b.id FROM qs_user_pay_history h , qs_books b WHERE  h.bid=b.id and h.status=1 and h.pay_time and h.pay_time  BETWEEN '$yesterday 00:00:00' and  '$yesterday 23:59:59'  group by b.id  order by amt desc limit 0,1";
        $yesterdayMaxGain = $Model->query($sql);

        //今日收益最高
        $sql = "SELECT SUM(h.money) amt ,b.name ,b.id FROM qs_user_pay_history h , qs_books b WHERE  h.bid=b.id and h.status=1 and h.pay_time and h.pay_time  BETWEEN '$now 00:00:00' and  '$now 23:59:59'  group by b.id  order by amt desc limit 0,1";
        $todayMaxGain = $Model->query($sql);

        //昨日新增已发布作品1
        $sql = " SELECT b.name bookname,u.nick_name nickname, FROM_UNIXTIME(b.utime, '%Y-%m-%d %H:%i:%S') utime ,b.id, u.id uid FROM  qs_books b ,qs_user_profile u WHERE b.uid =u.id and  b.isup =1 and  b.utime BETWEEN UNIX_TIMESTAMP('$yesterday 00:00:00') and UNIX_TIMESTAMP ('$yesterday 23:59:59') order by b.ctime desc ";
        $yesterdayBookList = $Model->query($sql);

        //今日新增已发布作品
        $sql = " SELECT b.name bookname,u.nick_name nickname, FROM_UNIXTIME(b.utime, '%Y-%m-%d %H:%i:%S') utime,b.id , u.id uid FROM  qs_books b ,qs_user_profile u WHERE b.uid =u.id and  b.isup =1 and  b.utime BETWEEN UNIX_TIMESTAMP('$now 00:00:00') and UNIX_TIMESTAMP ('$now 23:59:59') order by b.ctime desc ";
        $todayBookList = $Model->query($sql);

        //1昨日新增作者1
        $sql = " select u.id,p.nick_name, FROM_UNIXTIME(p.reg_time, '%Y-%m-%d %H:%i:%S') regtime from qs_user u,qs_user_profile p where u.id=p.id and find_in_set(6,u.groups) and p.reg_time  BETWEEN UNIX_TIMESTAMP('$yesterday 00:00:00') and UNIX_TIMESTAMP ('$yesterday 23:59:59')  ";
         $yesterdayAuthorList = $Model->query($sql);

        //今日新增作者
        $sql = "select u.id,p.nick_name,  FROM_UNIXTIME(p.reg_time, '%Y-%m-%d %H:%i:%S') regtime  from qs_user u,qs_user_profile p where u.id=p.id and find_in_set(6,u.groups) and p.reg_time  BETWEEN UNIX_TIMESTAMP('$now 00:00:00') and UNIX_TIMESTAMP ('$now 23:59:59')";
        $todayAuthorList = $Model->query($sql);

        $this->assign('userCount', $userCount);
        $this->assign('authorCount', $authorCount);

        $this->assign('allBookCount', $allBookCount);
        $this->assign('upBookCount', $upBookCount);

        $this->assign('yesterdayReadCnt', $yesterdayReadCnt);
        $this->assign('todayReadCnt', $todayReadCnt);

        $this->assign('todayMaxGain', $todayMaxGain);
        $this->assign('yesterdayMaxGain', $yesterdayMaxGain);

        $this->assign('yesterdayBookList', $yesterdayBookList);
        $this->assign('todayBookList', $todayBookList);

        $this->assign('yesterdayBookListCnt', sizeof($yesterdayBookList));
        $this->assign('todayBookListCnt', sizeof($todayBookList));

        $this->assign('yesterdayAuthorListCnt', sizeof($yesterdayAuthorList));
        $this->assign('todayAuthorListCnt', sizeof($todayAuthorList));

        $this->assign('yesterdayAuthorList', $yesterdayAuthorList);
        $this->assign('todayAuthorList', $todayAuthorList);

        $this->display();
    }
}