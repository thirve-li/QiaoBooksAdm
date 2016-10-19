<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>巧书后台首页</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/Public/css/bootstrap.css">
    <link rel="stylesheet" href="/Public/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/css/ionicons.min.css">
    <link rel="stylesheet" href="/Public/css/AdminLTE.css">
    <link rel="stylesheet" href="/Public/css/_all-skins.css">
    <link rel="stylesheet" href="/Public/css/base.css">
  <link rel="stylesheet" href="/Public/css/index/index.css">
  <link rel="stylesheet" type="text/css" media="all" href="/Public/css/index/daterangepicker-bs3.css"/>
  <script src="/Public/js/jQuery-2.2.0.min.js"></script>
	<script src="/Public/js/bootstrap.js"></script>
	<script type="text/javascript" src="/Public/js/index/moment.js"></script>
	<script type="text/javascript" src="/Public/js/index/daterangepicker.js"></script>
	<script type="text/javascript">
		   $(document).ready(function() {
          $('input[name="birthday"]').daterangepicker({ singleDatePicker: true ,
          		startDate:new Date(),
          		format:'YYYY/MM/DD'
          });
          $('input[name="reservation"]').daterangepicker({
							startDate:new Date(),
					    format:'YYYY/MM/DD'
					 });
	       });
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-------------头部模板 header.html main-header begin-->
    <header class="main-header">

    <a href="<?php echo (C("QS_BASE_PATH")); ?>/Index/index" class="logo">
        <span class="logo-mini"><img src="/Public/img/Oval 1.png"/></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="/Public/img/Oval 1.png"/>&nbsp;<b>巧书后台管理</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                
               <!--用户信息--> 
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="current_icon small_user_icon"><?php echo (msubstr($_SESSION["LOGIN_USER"]["Profile"]["name"],0,1,'utf-8',false)); ?> </i>
                        <span class="hidden-xs"><?php echo ($_SESSION["LOGIN_USER"]["Profile"]["name"]); ?></span>
                    </a>
                    <!--用户信息-->
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <i class="current_icon user_icon"><?php echo (msubstr($_SESSION["LOGIN_USER"]["Profile"]["name"],0,1,'utf-8',false)); ?> </i>

                            <p>
                                <span><?php echo ($_SESSION["LOGIN_USER"]["Profile"]["nick_name"]); ?></span>
                                <small>ID:<?php echo ($_SESSION["LOGIN_USER"]["mobile"]); ?></small>
                                <small>权限：<?php echo ($_SESSION["LOGIN_USER"]["roleName"]); ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="setup">设置</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo (C("QS_BASE_PATH")); ?>/Login/logout" class="setup exit">退出</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

</header>
    <!-------------头部模板 header.html main-header end-->


    <!------------- 左侧菜单栏 leftMenu.html aside begin-->
    <!-- 左侧菜单栏 -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">主导航</li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-user"></i> <span>用户管理</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if($SHOW_MENU == 'ADMIN_USER' ): ?><ul class="treeview-menu menu-open" style="display: block;">

                <?php else: ?>
                    <ul class="treeview-menu" style="display: none;"><?php endif; ?>
                    <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/User/listUser" class="selecter"><i class="fa fa-circle-o"></i>用户列表</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-book"></i>
                    <span>作品管理</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if($SHOW_MENU == 'ADMIN_BOOK' ): ?><ul class="treeview-menu menu-open" style="display: block;">
                <?php else: ?>
                        <ul class="treeview-menu" style="display: none;"><?php endif; ?>
                    <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/Book/bookList" class="selecter"><i class="fa fa-circle-o"></i>作品列表</a></li>
                    <!--<li><a href="<?php echo (C("QS_BASE_PATH")); ?>/Book/bookList/isup/0"><i class="fa fa-circle-o"></i> 未发布作品</a></li>-->
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-star"></i>
                    <span>日常推荐</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if($SHOW_MENU == 'ADMIN_BANNER' ): ?><ul class="treeview-menu menu-open" style="display: block;">
                <?php else: ?>
                    <ul class="treeview-menu" style="display: none;"><?php endif; ?>
                <?php if($type == 8 ): ?><li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/8" class="selecter"><i class="fa fa-circle-o"></i>首页Banner</a></li>
                <?php else: ?>
                    <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/8"><i class="fa fa-circle-o"></i>首页Banner</a></li><?php endif; ?>
                <?php if($type == 10 ): ?><li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/10/showMenu/ADMIN_BANNER" class="selecter"><i class="fa fa-circle-o"></i>首页作品推荐</a></li>
                <?php else: ?>
                    <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/10/showMenu/ADMIN_BANNER"><i class="fa fa-circle-o"></i>首页作品推荐</a></li><?php endif; ?>

                    <!--<li><a href="#"><i class="fa fa-circle-o"></i> 最新推荐</a></li>-->
                </ul>
            </li>


        <li class="treeview">
            <a href="#">
                <i class="glyphicon glyphicon-usd"></i>
                <span>常规维护</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <?php if($SHOW_MENU == 'ADMIN_PAY' ): ?><ul class="treeview-menu menu-open" style="display: block;">
            <?php else: ?>
                <ul class="treeview-menu" style="display: none;"><?php endif; ?>

            <?php if($showMenu == 'apply' ): ?><li><a href="<?php echo (C("QS_BASE_PATH")); ?>/UserPay/listApply/status/0/showMenu/apply" class="selecter"><i class="fa fa-circle-o"></i>提现申请</a></li>
                <?php else: ?>
                <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/UserPay/listApply/status/0/showMenu/apply"><i class="fa fa-circle-o"></i>提现申请</a></li><?php endif; ?>

            <?php if($showMenu == 'buyList' ): ?><li><a href="<?php echo (C("QS_BASE_PATH")); ?>/UserPay/listPay/showMenu/buyList"  class="selecter"><i class="fa fa-circle-o"></i>购买历史</a></li>
            <?php else: ?>
                <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/UserPay/listPay/showMenu/buyList"><i class="fa fa-circle-o"></i>购买历史</a></li><?php endif; ?>


            </ul>
        </li>

            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-wrench"></i>
                    <span>内容设置</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if($SHOW_MENU == 'ADMIN_MST' ): ?><ul class="treeview-menu menu-open" style="display: block;">
                <?php else: ?>
                    <ul class="treeview-menu" style="display: none;"><?php endif; ?>

                <?php if($type == 1 ): ?><li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/1" class="selecter"><i class="fa fa-circle-o"></i>作品分类</a></li>
                <?php else: ?>
                    <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/1"><i class="fa fa-circle-o"></i>作品分类</a></li><?php endif; ?>

                <?php if($type == 2 ): ?><li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/2" class="selecter"><i class="fa fa-circle-o"></i>作品标签</a></li>
                <?php else: ?>
                    <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/2"><i class="fa fa-circle-o"></i>作品标签</a></li><?php endif; ?>

                <?php if($type == 9 ): ?><li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/9" class="selecter"><i class="fa fa-circle-o"></i>作者标签</a></li>
                <?php else: ?>
                    <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/9"><i class="fa fa-circle-o"></i>作者标签</a></li><?php endif; ?>

                <?php if($type == 3 ): ?><li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/3"  class="selecter"><i class="fa fa-circle-o"></i>作者评分标准</a></li>
                <?php else: ?>
                    <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/3"><i class="fa fa-circle-o"></i>作者评分标准</a></li><?php endif; ?>

                <?php if($type == 4 ): ?><li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/4"  class="selecter"><i class="fa fa-circle-o"></i>作品评分标准</a></li>
                <?php else: ?>
                    <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/4"><i class="fa fa-circle-o"></i>作品评分标准</a></li><?php endif; ?>



                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-record"></i>
                    <span>管理中心</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <?php if($SHOW_MENU == 'ADMIN_MNG' ): ?><ul class="treeview-menu menu-open" style="display: block;">
                 <?php else: ?>
                    <ul class="treeview-menu" style="display: none;"><?php endif; ?>

                <?php if($showMenu == 1 ): ?><li><a href="<?php echo (C("QS_BASE_PATH")); ?>/User/listAdmin/showMenu/1" class="selecter"><i class="fa fa-circle-o"></i>管理员列表</a></li>
                <?php else: ?>
                    <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/User/listAdmin/showMenu/1" ><i class="fa fa-circle-o"></i>管理员列表</a></li><?php endif; ?>

                <?php if($showMenu == 2 ): ?><li><a href="<?php echo (C("QS_BASE_PATH")); ?>/AuthGroup/listGroup/showMenu/2" class="selecter"><i class="fa fa-circle-o"></i>用户组管理</a></li>
                <?php else: ?>
                    <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/AuthGroup/listGroup/showMenu/2" ><i class="fa fa-circle-o"></i>用户组管理</a></li><?php endif; ?>

                <?php if($showMenu == 3): ?><li><a href="<?php echo (C("QS_BASE_PATH")); ?>/AuthRule/listRule/showMenu/3" class="selecter"><i class="fa fa-circle-o"></i>权限管理</a></li>
                <?php else: ?>
                    <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/AuthRule/listRule/showMenu/3" ><i class="fa fa-circle-o"></i>权限管理</a></li><?php endif; ?>

                </ul>
            </li>

        </ul>
    </section>
</aside>
    <!------------- 左侧菜单栏 leftMenu.html aside end-->

    <!-- 所有内容部分 -->
    <div class="content-wrapper">

        <!-- 主要内容 -->
        <section class="content pt-70">
			<div class="row">
		        <div class="col-lg-3 col-xs-6">
		          <!-- small box -->
		          <div class="small-box small-box1 bg-aqua">
		            <div class="inner">
		              <h3><?php echo ($authorCount); ?></h3>
		              <p>作者数</p>
		            </div>
		            <!--<a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>-->
		          </div>
		        </div>
        <!-- ./col -->
		        <div class="col-lg-3 col-xs-6">
		          <!-- small box -->
		          <div class="small-box small-box1 bg-green">
		            <div class="inner">
		              <h3><?php echo ($userCount); ?></h3>
		              <p>注册用户总数</p>
		            </div>
		            <!--<a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>-->
		          </div>
		        </div>
        <!-- ./col -->
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box small-box1 bg-yellow">
	            <div class="inner">
	              <h3><?php echo ($upBookCount); ?></h3>
	              <p>已发布作品数</p>
	            </div>
	            <!--<a href="#" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>-->
	          </div>
	        </div>
        <!-- ./col -->
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box small-box1 bg-red">
	            <div class="inner">
	              <h3><?php echo ($allBookCount); ?></h3>
	              <p>作品总数</p>
	            </div>
	            <!--<a href="#" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>-->
	          </div>
	        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box small-box1 bg_light_green">
            <div class="inner">
              <h3><a href="/Book/bookList/bid/<?php echo ($yesterdayReadCnt[0]['bid']); ?>" target="_blank" ><?php echo ($yesterdayReadCnt[0]['name']); ?></a>&nbsp;<?php echo ($yesterdayReadCnt[0]['cnt']); ?>次</h3>
              <p>昨日阅读数最高</p>
            </div>
            <!--<a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box small-box1 bg_purple">
            <div class="inner">
              <h3><a href="/Book/bookList/bid/<?php echo ($yesterdayReadCnt[0]['bid']); ?>" target="_blank" ><?php echo ($todayReadCnt[0]['name']); ?></a>&nbsp;<?php echo ($todayReadCnt[0]['cnt']); ?>次</h3>
              <p>今日阅读数最高</p>
            </div>
            <!--<a href="#" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box small-box1 bg_orange">
            <div class="inner">
              <h3><a href="/Book/bookList/bid/<?php echo ($yesterdayMaxGain[0]['id']); ?>" target="_blank" ><?php echo ($yesterdayMaxGain[0]['name']); ?></a>&nbsp;<?php echo ($yesterdayMaxGain[0]['amt']); ?>元</h3>
              <p>昨日收益最高</p>
            </div>
            <!--<a href="#" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box small-box1 bg_light_red">
            <div class="inner">
              <h3><a href="/Book/bookList/bid/<?php echo ($yesterdayMaxGain[0]['id']); ?>" target="_blank" ><?php echo ($yesterdayMaxGain[0]['name']); ?></a>&nbsp;<?php echo ($yesterdayMaxGain[0]['amt']); ?>元</h3>
              <p>今日收益最高</p>
            </div>
            <!--<a href="#" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <!-- ./col -->
      </div>
			<!---/.row--->
    </section>
        <!-- /.content -->
    <section class='content bg-w'>
    	
    		<ul class="top_list table_border" id="top_list">
				<li class="tag_border">昨日新增已发布作品<b class="data-num"><?php echo ($yesterdayBookListCnt); ?></b></li>
				<li>今日新增已发布作品<b class="data-num"><?php echo ($todayBookListCnt); ?></b></li>
				<li>昨日新增作者<b class="data-num"><?php echo ($yesterdayAuthorListCnt); ?></b></li>
				<li>今日新增作者<b class="data-num"><?php echo ($todayAuthorListCnt); ?></b></li>
			</ul>
			<div class='row tag_list_box'>
				<div class="col-md-8">
				<!--昨日新增已发布作品-->
		    	<table class="table table-bordered example1" style="display:table">
		        <thead>
			        <tr>
			          <th class="c2">作品</th>
			          <th class="c2">作者</th>
			          <th class="c2">发布时间</th>
			        </tr>
		        </thead>
		        <tbody>

                <?php if(is_array($yesterdayBookList)): $i = 0; $__LIST__ = $yesterdayBookList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$book): $mod = ($i % 2 );++$i;?><tr>
			          <td class="c3"><a href="/Book/bookList/bid/<?php echo ($book['id']); ?>" target="_blank" ><?php echo ($book['bookname']); ?></a></td>
			          <td class="c3"><a href="/User/listUser/uid/<?php echo ($book['uid']); ?>" target="_blank" ><?php echo ($book['nickname']); ?></a></td>
			          <td class="c2"><?php echo ($book['utime']); ?></td>
			        </tr><?php endforeach; endif; else: echo "" ;endif; ?>

		        </tbody>
				</table>
					<!--今日新增已发布作品-->
				<table class="table table-bordered example1">
			        <thead>
			        <tr>
			          <th class="c2">作品</th>
			          <th class="c2">作者</th>
			          <th class="c2">发布时间</th>
			        </tr>
			        </thead>
			        <tbody>
                        <?php if(is_array($todayBookList)): $i = 0; $__LIST__ = $todayBookList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$book): $mod = ($i % 2 );++$i;?><tr>
                                <td class="c3"><a href="/Book/bookList/bid/<?php echo ($book['id']); ?>" target="_blank" ><?php echo ($book['bookname']); ?></a></td>
                                <td class="c3"><a href="/User/listUser/uid/<?php echo ($book['uid']); ?>" target="_blank" ><?php echo ($book['nickname']); ?></a></td>
                                <td class="c2"><?php echo ($book['utime']); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
			        </tbody>
					</table>
					<!--昨日新增作者-->
				<table class="table table-bordered example1">
			        <thead>
				        <tr>
				          <th class="c2">作者</th>
				          <th class="c2">注册时间</th>
				        </tr>
			        </thead>
			        <tbody>
                    <?php if(is_array($yesterdayAuthorList)): $i = 0; $__LIST__ = $yesterdayAuthorList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
				          <td class="c3"><a href="/User/listUser/uid/<?php echo ($user['id']); ?>" target="_blank" ><?php echo ($user['nick_name']); ?></a></td>
				          <td class="c2"><?php echo ($user['regtime']); ?></td>
				        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
			        </tbody>
				</table>
					<!--今日新增作者-->
				<table class="table table-bordered example1">
			        <thead>
				        <tr>
				          <th class="c2">作者</th>
				          <th class="c2">注册时间</th>
				        </tr>
			        </thead>
			        <tbody>
                        <?php if(is_array($todayAuthorList)): $i = 0; $__LIST__ = $todayAuthorList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                                <td class="c3"><a href="/User/listUser/uid/<?php echo ($user['id']); ?>" target="_blank" ><?php echo ($user['nick_name']); ?></a></td>
                                <td class="c2"><?php echo ($user['regtime']); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
			        </tbody>
				</table>
				</div>
			</div>
    </section>
    <section class='content bg-w'>
    	<div id="time-cont" class="canvas-box">
    		<div class="page-container row">
    			<div class="cont-list">
    				<h3>时段分析
    					<i>
    						i
    						<ul class="explain">
    							<li><span>在线数：</span>某个时间段内正在访问咱们网站的用户数。</li>
    							<li><span>注册数：</span>某个时间段内新增的注册用户数。</li>
    						</ul>
    					</i>
    				</h3>
		    			<ul class="left-cont">
		    				<li>昨日</li>
		    				<li>前日</li>
		    				<div class="well">
		               <form class="form-horizontal">
		                  <div class="control-group">
		                    <div class="controls">
		                     <div class="input-prepend input-group">
		                       <input type="text" readonly  name="birthday" id="birthday" class="form-control" placeholder="自定义时间" />
				                    <div class="input-group-btn">
				                        <button type="button" class="btn dropdown-toggle drop-btn" data-toggle="dropdown" id="drop-btn1">
				                            <span class="caret"></span>
				                        </button>
				                        
				                    </div><!-- /btn-group -->
		                     </div>
		                    </div>
		                  </div>
		               </form>
            		</div>
		    				<div class='clear'></div>
		    			</ul>
		    			<ul class="right-cont">
		    				<li>在线数</li>
		    				<li>注册数</li>
		    				<div class='clear'></div>
		    			</ul>
		    			<div class="clear"></div>
		    		</div>	
			 <!--图表 Str-->
		        <div>
		          <!-- Tab panes -->
		          <div class="tab-content tab-chart" style="min-height:auto;">
		            <div role="tabpanel" class="tab-pane active" id="chart1">
		              <div id="chart-main" style="width: 100%;height:380px;"></div>
		            </div>
		          </div>
		        </div>
        <!--图表 End--> 
      </div>

      <div class="page-footer" style="border:none;"></div>
    </div>
    <div id="trend-cont" class="canvas-box">
    		<div class="page-container row">
    			<div class="cont-list">
    				<h3>趋势分析</h3>
		    			<ul class="left-cont wider-left">
		    				<li>最近7天</li>
		    				<li>最近30天</li>
		    				<li>最近60天</li>
		    				<div class="well">
		               <form class="form-horizontal">
		                  <div class="control-group">
		                    <div class="controls">
		                     <div class="input-prepend input-group">
		                       <input type="text" readonly style="width: 200px" name="reservation" id="reservation" class="form-control" placeholder="自定义时间" /> 
		                     		<div class="input-group-btn">
				                        <button type="button" class="btn dropdown-toggle drop-btn" data-toggle="dropdown" id="drop-btn2">
				                            <span class="caret"></span>
				                        </button>
				                        
				                    </div>
		                     </div>
		                    </div>
		                  </div>
		               </form>
		            </div>
		    				<div class='clear'></div>
		    			</ul>
		    			<ul class="right-cont">
		    				<li class="online-num">在线数</li>
		    				<li class="register">注册数</li>
		    				<div class='clear'></div>
		    			</ul>
		    			<div class="clear"></div>
		    		</div>	
			 <!--图表 Str-->
        <div>

          <!-- Tab panes -->
          <div class="tab-content tab-chart" style="min-height:auto;">
            <div role="tabpanel" class="tab-pane active" id="chart3">
              <div id="chart-main1" style="width: 100%;height:380px;"></div>
              <select class="selections">
              	<option>按注册位置查看</option>
              	<option>按注册方式查看</option>
              </select>
            </div>
          </div>

        </div>
        <!--图表 End--> 
      </div>

      <div class="page-footer" style="border:none;"></div>
    </div>
    </section>
    </div>
</div>

<script src="/Public/js/jQuery-2.2.0.min.js"></script>
<script src="/Public/js/bootstrap.js"></script>
<script src="/Public/js/app.js"></script>
<script src="/Public/js/jquery.slimscroll.js"></script>
<script src="/Public/js/index/echarts.js" ></script>
<script src="/Public/js/index/index.js" ></script>

<script>
$(function(){
	$('#top_list li').click(function(){
		var index = $(this).index();
		$(this).addClass('tag_border').siblings().removeClass('tag_border').parent('#top_list').siblings('.tag_list_box').children('div').children('.example1').eq(index).show().siblings().hide();
	})
	
})
</script>
<script type="text/javascript">
    //拆线图
    var myChart = echarts.init(document.getElementById('chart-main'));
    var myChart1 = echarts.init(document.getElementById('chart-main1'));
    option = {
//  title: {
//      text: '时段分析'
//  },
    tooltip: {
        trigger: 'item'
    },
    legend: {
         bottom: '10%',
//       selectedMode:false,
        data:[
            {
                name:'全部',
                textStyle:{
                    fontSize:12,//图例文字的大小
                    color:'#333333'//图例文字的颜色
                },
                icon:'roundRect',//图例形状
            },
            {
                name:'游客',
                textStyle:{
                    fontSize:12,
                    color:'#333333'
                },
                icon:'roundRect',
            },
            {
                name:'注册用户',
                textStyle:{
                    fontSize:12,
                    color:'#333333'
                },
                icon:'roundRect',
            }
        ]
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '20%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
       
    },
     calculable : true,
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: ['0:00','02:00','04:00','06:00','08:00','10:00','12:00','14:00','16:00','18:00','20:00','22:00','24:00']
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'全部',
            type:'line',
            symbol:'circle',
            symbolSize:10,
            itemStyle : {  
            normal : {
                    color:'rgba(85,130,228,0.3)',
                lineStyle:{  
                    color:'rgba(85,130,228,0.3)',
                    width:3//折线条的粗细
                }  
            }  
            },  
            stack: '总量',
            data:[120, 132, 101, 134, 90, 230, 210,120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'游客',
            type:'line',
            symbol:'circle',//折线点的形状
            symbolSize:10,//折线点的大小
            itemStyle : {  
            normal : {  
                    color:'rgba(0,192,239,0.3)',//折线点颜色
                lineStyle:{  
                    color:'rgba(0,192,239,0.3)',//折线颜色
                    width:3//折线条的粗细
                }  
            }  
            },
            data:[220, 182, 191, 234, 290, 330, 310,220, 182, 191, 234, 290, 330, 310]
        },
        {
            name:'注册用户',
            type:'line',
            symbol:'circle',
            symbolSize:10,
            itemStyle : {  
            normal : {
                    color:'rgba(96,90,170,0.3)',
                lineStyle:{  
                    color:'rgba(96,90,170,0.3)',
                    width:3//折线条的粗细
                }  
            }  
            },  
            data:[150, 232, 201, 154, 190, 330, 410,150, 232, 201, 154, 190, 330, 410]
        }
    ]
};
$(function(){
        indexObj.chart(myChart,option);
        indexObj.chart(myChart1,option);
});
   </script>
</body>
</html>