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
		     <section class="content" id="fixed">
		   		  <div class="box border-box">
		   		  <div class="box-body box-profile">
		   		  <form class="form-inline" action="<?php echo (C("QS_BASE_PATH")); ?>/User/listUser" method="post" id="userForm" name="userForm">
                      <input name="lids" id="lids" type="hidden" value="<?php echo ($lids); ?>">
                      <input name="lidsName" id="lidsName" type="hidden" value="<?php echo ($lidsName); ?>">
                      <input name="scoreIds" id="scoreIds" type="hidden" value="<?php echo ($scoreIds); ?>">
                      <input name="scoreName" id="scoreName" type="hidden" value="<?php echo ($scoreName); ?>">
                      <input name="sort" id="sort" type="hidden" value="<?php echo ($sort); ?>">
                      <input name="invite_code" id="invite_code" type="hidden" value="<?php echo ($invite_code); ?>">
                      <input name="recorderCnt" id="recorderCnt" type="hidden" value="<?php echo ($recorderCnt); ?>">
                      <input name="pageCnt" id="pageCnt" type="hidden" value="<?php echo ($pageCnt); ?>">
                      <input name="gotoPage" id="gotoPage" type="hidden" value="<?php echo ($gotoPage); ?>">
                      <input name="pageSize" id="pageSize" type="hidden" value="<?php echo ($pageSize); ?>">

		   		  	<div class="form-group">
		   		  	<div class="row">
		   		  		<div class="col-lg-4 col-xs-12 mb-10">
		   		  			<input type="text" class="form-control input_style mr-10" placeholder="用户名" name="name" value="<?php echo ($name); ?>">
		   		  			<select class="form-control select2 input_style2" name="invite_code" onchange="doSearch()">
 			   		  		  <option value="" <?php if($invite_code == '' ): ?>selected<?php endif; ?> >全部显示</option>
								<option value="HAVE" <?php if( $invite_code == 'HAVE' ): ?>selected<?php endif; ?>  >有邀请码</option>
				              <option value="NO" <?php if( $invite_code == 'NO' ): ?>selected<?php endif; ?> >没有邀请码</option>
		                    </select>
		   		  		</div>
		   		  		<!--用户评分-->
		   		  	<div class="col-lg-4 col-xs-12">
		            		<div class="box border collapsed-box">
				           	<div class="box-header with-border h30 box_content">
				              	<span class="user_score">&nbsp;&nbsp;用户评分</span>
				              <div class="box-tools">
				                <button name="score" id="score" type="button" class="btn btn-box-tool re" data-widget="collapse" ><i class="fa fa-plus incre"></i>
				                </button>
				              </div>
				            </div>
				            <div class="box-body box_close">
				              <ul class="nav nav-pills nav-stacked">
				                <li>
                                    <button type="btn" class="btn btn1 btn-border btn-flat bg mr-10 f12" onclick="allScore()">全部</button>
				                	<button type="btn" class="btn btn1 btn-border btn-flat bg mr-10 f12" onclick="haveScore()">有评分</button>
				                	<button type="btn" class="btn btn1 btn-border btn-flat bg mr-10 f12" onclick="noScore()">没有评分</button>
				                </li>
		
		                      <?php if(is_array($scorelabelList)): $i = 0; $__LIST__ = $scorelabelList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$scorelabel): $mod = ($i % 2 );++$i;?><li class="m10" id='<?php echo ($scorelabel["name"]); ?>'>
				                	<span class="display"><?php echo ($scorelabel["name"]); ?></span>
				                	<span class="btn_style score_btn1" a='<?php echo ($scorelabel["id"]); ?>' s='1'>1分</span>
				                	<span class="btn_style score_btn1" a='<?php echo ($scorelabel["id"]); ?>' s='2'>2分</span>
				                	<span class="btn_style score_btn1" a='<?php echo ($scorelabel["id"]); ?>' s='3'>3分</span>
				                	<span class="btn_style score_btn1" a='<?php echo ($scorelabel["id"]); ?>' s='4'>4分</span>
				                	<span class="btn_style score_btn1 no-margin" a='<?php echo ($scorelabel["id"]); ?>' s='5'>5分</span>
				                </li><?php endforeach; endif; else: echo "" ;endif; ?>
		
				                <li class="text-right m10">
				                	<span id='sure_score' class="btn_style score_btn2">确定</span>
				                	<span class="btn_style score_btn2 no-margin" id="cancel_score">取消</span>
				                </li>
				              </ul>
				            </div>
		         		</div>
		         </div><!--/.用户评分-->
		         
		         
		          <!--用户标签-->
		          <div class="col-lg-4 col-xs-12">
		 			<div class="box border collapsed-box">
		            <div class="box-header with-border h30 tag_content">
		              <span class="user_tag">&nbsp;&nbsp;标签</span>
		              <div class="box-tools">
                        <button type="button" class="btn btn-box-tool re" data-widget="collapse"><i class="fa fa-plus incre"></i>
                        </button>
                   	 </div>
		            </div>
		            <div class="box-body box_close">
		              <ul class="nav nav-pills nav-stacked">
		                <li>
                            <button type="btn" class="btn btn1 btn-border btn-flat bg mr-10 f12" onclick="allLabel()">全部</button>
		                	<button type="btn" class="btn btn1 btn-border btn-flat bg mr-10 f12" onclick="haveLabel()">有标签</button>
		                	<button type="btn" class="btn btn1 btn-border btn-flat bg mr-10 f12" onclick="noLabel()">没有标签</button>
		                </li>
                      
		                <li class="m10">
		                	<?php if(is_array($labelList)): $i = 0; $__LIST__ = $labelList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$label): $mod = ($i % 2 );++$i;?><span class="btn_style tag_btn m10" a='<?php echo ($label["id"]); ?>' id='<?php echo ($label["name"]); ?>'><?php echo ($label["name"]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
		                </li>
                    

		                <li class="text-right m10">
		                	<span id='sure_tag' class="btn_style score_btn2">确定</span>
				            <span class="btn_style score_btn2 no-margin" id="cancel_tag">取消</span>
		                </li>

		              </ul>
		            </div>
		            <!-- /.box-body -->
		          </div>
		 		</div><!--/.用户标签-->
		 </div>	
		 
		          <div class='row'>
		          	<div class="col-lg-2 col-xs-12">
		          		<div class="btn-group">
		          			<button type="button" class="btn_style search f14" onclick="$('#gotoPage').val(1);doSearch()">搜索</button>
		          		</div>
		          	</div>
		          	<div class="col-lg-5 col-xs-12 text-right m5">
		          		<div>
		          			<span>排序</span>
                            <?php if($sort=='reg_time'): ?><button type="button" class="btn_style active1" onclick="setSort('reg_time')">按注册时间排序</button>
                           <?php else: ?>
                               <button type="button" class="btn_style" onclick="setSort('reg_time')">按注册时间排序</button><?php endif; ?>

                            <?php if($sort=='login_time'): ?><button type="button" class="btn_style active1" onclick="setSort('login_time')">按登陆时间排序</button>
                            <?php else: ?>
                                <button type="button" class="btn_style" onclick="setSort('login_time')">按登陆时间排序</button><?php endif; ?>


                            <?php if($sort=='amt_money'): ?><button type="button" class="btn_style active1" onclick="setSort('amt_money')">按收益排序</button>
                            <?php else: ?>
                                <button type="button" class="btn_style" onclick="setSort('amt_money')">按收益排序</button><?php endif; ?>



		          		</div>
		          	</div>
		          	<div class="col-lg-5 col-xs-12 text-right m5">
                        <ul class="pagination">
                            <li><a href="###" onclick="gotoPage(<?php echo ($gotoPage-1); ?>)">上一页</a></li>

                            <!--<?php $__FOR_START_1484681541__=0;$__FOR_END_1484681541__=$pageCnt;for($i=$__FOR_START_1484681541__;$i < $__FOR_END_1484681541__;$i+=1){ ?>-->
                                <!--<?php if($i+1 == $gotoPage): ?>-->
                                    <!--<li class="active"><a href="###" onclick="gotoPage(<?php echo ($i+1); ?>)"><?php echo ($i+1); ?></a></li>-->
                                    <!--<?php else: ?>-->
                                    <!--<li><a href="###" onclick="gotoPage(<?php echo ($i+1); ?>)"><?php echo ($i+1); ?></a></li>-->
                                <!--<?php endif; ?>-->
                            <!--<?php } ?>-->

                                <li>跳至</span><select name="aGoPage" id="aGoPage">
                                    <option value=""> </option>
                                    <?php $__FOR_START_751683638__=0;$__FOR_END_751683638__=$pageCnt;for($i=$__FOR_START_751683638__;$i < $__FOR_END_751683638__;$i+=1){ if($i+1 == $gotoPage): ?><option value="<?php echo ($gotoPage); ?>" selected ><?php echo ($i+1); ?></option>
                                            <?php else: ?>
                                            <option value="<?php echo ($gotoPage); ?>"><?php echo ($i+1); ?></option><?php endif; } ?>
                                </select>页</li>

                            <li><a href="###" onclick="gotoPage(<?php echo ($gotoPage+1); ?>)">下一页</a></li>
                        </ul>

		          	</div>
		          </div>
		   		  </div>
		   		  </form>
		        </div>
		   		</div>
		</section>
		
		<section class="content" id="alert_user">
			<div class="box box-style">
			 <?php if(is_array($userList)): $k = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($k % 2 );++$k;?><div <?php if($k%2== '0'): ?>style="background-color:#FFFFF0;"<?php endif; ?> class="row user_list_bor box_hover" id="userInfo" >
		        <div class="col-lg-4 col-xs-6 re alert_box">
		          	<div class="pull-left">
                        <a target="_blank" href="http://www.qiaobooks.com/Home/<?php echo ($row['userInfo'][0]['id']); ?>">
                            <?php if(empty($row['userInfo'][0]['head_img'])): ?><img src="http://tva2.sinaimg.cn/crop.0.0.256.256.180/006kopAXjw8f1xnvcum68j30740740su.jpg" width="50" height="50" class="pull-left mr-10">
                            <?php else: ?>
                                <?php if(stripos($row['userInfo'][0]['head_img'],'http') !== false): ?><img src="<?php echo ($row['userInfo'][0]['head_img']); ?>" width="50" height="50" class="pull-left mr-10">
                                <?php else: ?>
                                    <img src="http://img.qiaobooks.com/<?php echo ($row['userInfo'][0]['head_img']); ?>" width="50" height="50" class="pull-left mr-10"><?php endif; endif; ?>
                        </a>
				 			<div class="author_name"><a target="_blank" href="http://www.qiaobooks.com/Home/<?php echo ($row['userInfo'][0]['id']); ?>"><?php echo ($row['userInfo'][0]['nick_name']); ?></a></div>
				 			<div class="c2 f14 c2">ID:<?php echo ($row['userInfo'][0]['id']); ?></div>
				 			<div class="clear"></div>
				 			<ul class="fl2 c2">
						 		<li class="w210 f12">邀请码：<?php echo ($row['userInfo'][0]['invite_code']); ?></li>
                                <li class="w210 f12">手机号码：<?php echo ($row['userInfo'][0]['mobile']); ?></li>
						 		<li class="w210 f12">注册时间：<span><?php echo date('Y-m-d H:i:s' , $row['userInfo'][0]['reg_time']);?></span></li>
						 		<li class="w210 f12">最近登陆：<span><?php echo ($row['userInfo'][0]['login_time']); ?></span></li>
						 		<li class="w210 f12">在线时长：<span><?php echo ($row['userInfo'][0]['stay_time']); ?></span></li>
						 		<li class="w210 f12">
					 				<div class="input-group m5">
		                   				<span class="input-group-addon h24 w36">备注</span>
		                				<input type="text" class="form-control h24 w165" name="remark" id="remark_<?php echo ($row['userInfo'][0]['id']); ?>" oldval="<?php echo ($row['userInfo'][0]['remark']); ?>" value="<?php echo ($row['userInfo'][0]['remark']); ?>" onblur="remarkUser(<?php echo ($row['userInfo'][0]['id']); ?>,this)">
		              				</div>
				 				</li>
				 			</ul>
					</div>
					 			
				 			<ul class="pull-right">
				 				<li><button class="a0 details mb-65 check" value="<?php echo ($row['userInfo'][0]['id']); ?>">查看详情</button></li>
				 				<!--<li><a href="javaScript:void(0);" class="a0 details">清除数据</a></li>-->
				 				<li>
                                    <?php if($row['userInfo'][0]['status'] == 1): ?><a href="javaScript:void(0);" t="<?php echo ($row['userInfo'][0]['id']); ?>" s="<?php echo ($row['userInfo'][0]['status']); ?>" class="a0 details state">禁止登陆</a><?php endif; ?>

                                    <?php if($row['userInfo'][0]['status'] == 0): ?><a href="javaScript:void(0);" t="<?php echo ($row['userInfo'][0]['id']); ?>" s="<?php echo ($row['userInfo'][0]['status']); ?>" class="a0 details state">已禁止</a><?php endif; ?>

                                </li>
				 			</ul>
		       </div>
		        <!-- ./col -->
		        <div class="col-lg-2 col-xs-6 alert_box">
		          	<div>
					 		<p class="f14 c2">账户信息</p>
				 			<ul class="pull-left">
				 				<li class="mb-11 f12">账户收益：</li>
				 				<li class="mb-11 f12">发布作品数：</li>
				 				<li class="mb-11 f12">未发布作品数：</li>
				 				<li class="mb-11 f12">收藏作品数：</li>
				 				<li class="f12">读过作品数：</li>
				 			</ul>
				 			<ul class="ml-20 pull-left">
				 				<li class="number1 profit pros1" value="<?php echo ($row['userInfo'][0]['id']); ?>"><b>¥<?php echo ((isset($row['acntInfo'][0]['amt_money']) && ($row['acntInfo'][0]['amt_money'] !== ""))?($row['acntInfo'][0]['amt_money']):0); ?></b></li>
				 				<li class="number1 profit pros2" value="<?php echo ($row['userInfo'][0]['id']); ?>"><b><?php echo ((isset($row['acntInfo'][0]['releaseCnt']) && ($row['acntInfo'][0]['releaseCnt'] !== ""))?($row['acntInfo'][0]['releaseCnt']):0); ?></b></li>
				 				<li class="number1 profit pros3" value="<?php echo ($row['userInfo'][0]['id']); ?>"><b><?php echo ((isset($row['acntInfo'][0]['draftCnt']) && ($row['acntInfo'][0]['draftCnt'] !== ""))?($row['acntInfo'][0]['draftCnt']):0); ?></b></li>
				 				<li class="number1 profit pros4" value="<?php echo ($row['userInfo'][0]['id']); ?>"><b><?php echo ((isset($row['acntInfo'][0]['favoriteCnt']) && ($row['acntInfo'][0]['favoriteCnt'] !== ""))?($row['acntInfo'][0]['favoriteCnt']):0); ?></b></li>
				 				<li class="number1 profit pros5" value="<?php echo ($row['userInfo'][0]['id']); ?>"><b><?php echo ((isset($row['acntInfo'][0]['readCnt']) && ($row['acntInfo'][0]['readCnt'] !== ""))?($row['acntInfo'][0]['readCnt']):0); ?></b></li>
				 			</ul>
					</div>
		        </div>
		        <!-- ./col -->
		        <?php if(!empty($row['labelInfo'][0])): ?><div class="col-lg-2 col-xs-6 alert_box" id="userLabel_<?php echo ($row['userInfo'][0]['id']); ?>">
		         	<div>
				 			<p class="f14 c2">用户标签</p>
				 			<ul class="pull-left mr-10 tag-nav">
				 				<?php $i=1; ?>
                                <?php if(is_array($row['labelInfo'][0])): $i = 0; $__LIST__ = $row['labelInfo'][0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$label): $mod = ($i % 2 );++$i;?><li class="tag orange f12 tag_hover1 re" <?php echo ($i>3?'style="display:none"':''); ?>>
				 					<?php echo ($key); ?>
				 					   <div class="manager ab">
						 					<span>
                                                <?php if(is_array($label)): $i = 0; $__LIST__ = $label;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; echo ($item); ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                                            </span>
						 					<div class="sign ab"></div>
					 					</div>
				 				</li>
                                <?php $i=$i+1; endforeach; endif; else: echo "" ;endif; ?>
                                <li class="tag a0 f12 c2 addtag">添加标签</li>
                                <?php if($i > 3): ?><li class="tag a0 f12 c2 showAll"><?php echo ($i); ?>显示全部</li><?php endif; ?>
				 			</ul>
						</div>
		        </div>
		        <?php else: ?>
		        <!--无数据-->
		        <div class="col-lg-2 col-xs-6 alert_box" id="userLabel_<?php echo ($row['userInfo'][0]['id']); ?>">
 					<div>
	 				<p class="f14 c2">用户标签</p>
	 					<ul>
			 				<li class="f12 mb-11 c2">无标签</li>
			 				<li><a href="javaScript:void(0);" class="a0 details c-l addlabel">添加标签</a></li>
	 					</ul>
	 				</div>
 				 </div><?php endif; ?>
		        <!-- ./col -->
		        <?php if(!empty($row['scoreInfo'][0])): ?><div class="col-lg-4 col-xs-6 alert_box">
		         	<div>
					 			<p class="f14 c2">用户评分</p>
					 			<ul class="progress_score" id="userScoreUL_<?php echo ($row['userInfo'][0]['id']); ?>">
                                            <?php if(is_array($row['scoreInfo'][0])): $i = 0; $__LIST__ = $row['scoreInfo'][0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_score): $mod = ($i % 2 );++$i;?><li>
                                                    <span class="pull-left w60 f12"><?php echo ($_score["name"]); ?></span>
                                                    <div class="progress progress_style">
                                                        <div class="progress-bar progress_color" role="progressbar"
                                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                             style="width: <?php echo ($_score['score']/5*100); ?>%;">
                                                        </div>
                                                    </div>
                                                    <span class="f18 pull-left ml-20"><?php echo ($_score["score"]); ?></span>
                                                </li><?php endforeach; endif; else: echo "" ;endif; ?>

               						<li><a href="javaScript:void(0);" class="a0 details c-l score_user ml-230">评分</a></li>
					 			</ul>
					</div>
		        </div>
		        <?php else: ?>
		        <!--无数据-->
		        <div class="col-lg-2 col-xs-6 alert_box">
 					<div>
	 				<p class="f14 c2">用户评分</p>
			 			<ul>
			 				<li class="f12 mb-11 c2">尚未评分</li>
			 				<li><a href="javaScript:void(0);" class="a0 details c-l score_user">评分</a></li>
			 			</ul>
	 				</div>
  				</div><?php endif; ?>
		        
<!--弹窗部分-->        	
					
					<div class="col-lg-8 col-xs-6 author_box">
							<i></i>
							<div class="close_btn"><span uid="<?php echo ($row['userInfo'][0]['id']); ?>" >关闭</span></div>
									<ul class="top_list" id="top_list">
										<li class="tag_border" value="<?php echo ($row['userInfo'][0]['id']); ?>">用户标签</li>
										<li onclick="getUserScore(<?php echo ($row['userInfo'][0]['id']); ?>)" value="<?php echo ($row['userInfo'][0]['id']); ?>">用户评分</li>
										<li onclick="getWriteList(<?php echo ($row['userInfo'][0]['id']); ?>,1)">已发布<b class="data-num"><?php echo ((isset($row['acntInfo'][0]['releaseCnt']) && ($row['acntInfo'][0]['releaseCnt'] !== ""))?($row['acntInfo'][0]['releaseCnt']):0); ?></b></li>
										<li onclick="getWriteList(<?php echo ($row['userInfo'][0]['id']); ?>,0)">未发布<b class="data-num"><?php echo ((isset($row['acntInfo'][0]['draftCnt']) && ($row['acntInfo'][0]['draftCnt'] !== ""))?($row['acntInfo'][0]['draftCnt']):0); ?></b></li>
										<li onclick="readList(<?php echo ($row['userInfo'][0]['id']); ?>,1)">收藏<b class="data-num"><?php echo ((isset($row['acntInfo'][0]['favoriteCnt']) && ($row['acntInfo'][0]['favoriteCnt'] !== ""))?($row['acntInfo'][0]['favoriteCnt']):0); ?></b></li>
										<li onclick="readList(<?php echo ($row['userInfo'][0]['id']); ?>,0)">读过<b class="data-num"><?php echo ((isset($row['acntInfo'][0]['readCnt']) && ($row['acntInfo'][0]['readCnt'] !== ""))?($row['acntInfo'][0]['readCnt']):0); ?></b></li>
										<li class="no-margin" onclick="getUserAccountInfo(<?php echo ($row['userInfo'][0]['id']); ?>)">账户</li>
									</ul>
									<div class="clear"></div>
							
							
									<div class="tag_list_box">
										<!--用户标签弹窗-->
										<div class="tag_list m20 tag_show">
											<ul class="tag_name labelcont"  id="userLabelUL_<?php echo ($row['userInfo'][0]['id']); ?>"></ul>
											 <ul ><li class="nihao" id="labelUL_<?php echo ($row['userInfo'][0]['id']); ?>"></li></ul>
											
										</div>
								
										<!--用户评分弹窗-->	
										<div class="tag_list" id="getUserScore_<?php echo ($row['userInfo'][0]['id']); ?>"></div>	

										<!---已发布无数据---->
										<div class="tag_list">
											<!---------已发布有数据---------->
											<div class="row" id="Book_<?php echo ($row['userInfo'][0]['id']); ?>">

											</div>

										</div>
										
										<!--------------------未发布----------------------------->
									     <div class="tag_list" >
												 <!--<div>-->
												    <!--<a href="###" class="a0 no_publish">管理未发布作品</a>-->
												 <!--</div>-->
											 <div class="row" id="Book2_<?php echo ($row['userInfo'][0]['id']); ?>">
											 </div>
										 </div>
										<!------------------------收藏-------------------------->
										<div class="tag_list">

											<!--收藏有数据-->
											<div id="Already_<?php echo ($row['userInfo'][0]['id']); ?>">
											
											</div>
										</div>
										<!--读过的-->
										<div class="tag_list">
											
											<!--读过的有数据-->
											<div id="Already1_<?php echo ($row['userInfo'][0]['id']); ?>">
											
											</div>
										</div>
										<!--账户-->
										<div class="tag_list" id="Account_<?php echo ($row['userInfo'][0]['id']); ?>">
											
										</div>
								
								</div>
							
										

										
									
							
					</div>
					
<!--/.弹窗部分-->				
		    </div><?php endforeach; endif; else: echo "" ;endif; ?>
			<!--<div class="load_more">-->
				<!--<span>更多用户加载中...</span>-->
			<!--</div>-->
		</div>

    		</div><!--/.row user_list_bor-->
	    		
			</div><!--/.box box-style-->	
		</section>
		
   </div>
</div>

<script src="/Public/js/jQuery-2.2.0.min.js"></script>
<script src="/Public/js/bootstrap.js"></script>
<script src="/Public/js/app.js"></script>
<script src="/Public/js/listUser.js"></script>
<script>

    if('<?php echo ($scoreIds); ?>' == 'NO_SCORE'){
        $('.user_score').html('没有评分');
    }

    if('<?php echo ($scoreIds); ?>' == 'HAVE_SCORE'){
        $('.user_score').html('有评分');
    }

    if('<?php echo ($scoreIds); ?>' == ''){
        $('.user_score').html('全部评分');
    }

    if('<?php echo ($lids); ?>' == 'HAVE_LABEL'){
        $('.user_tag').html('有标签');
    }

    if('<?php echo ($lids); ?>' == 'NO_LABEL'){
        $('.user_tag').html('没有标签');
    }

    if('<?php echo ($lids); ?>' == ''){
        $('.user_tag').html('全部标签');
    }

function refreshLabel(uid){
    var _url = '<?php echo (C("QS_BASE_PATH")); ?>/User/getUserLabel';
    var param = {
        'uid': uid
    };

    $.ajax({
        method: "POST",
        url: _url,
        data: param,
        dataType: 'json',
        success: function(data) {
            $("#userLabel_"+uid).empty();

            var html = "";
            var cnt =0;

            //html += '<li>';
            html += '<div>';
            html += '<p class="f14 c2">用户标签</p>';


            html += '<ul class="pull-left mr-10 tag-nav">';
            $.each(data.labelInfo, function(i, item) {
                var style ="";

                //if(cnt>3){
                    html += '<li class="tag orange f12 tag_hover1 re"   >'+i;
                //}else{
                //    html += '<li class="tag orange f12 tag_hover1 re" >'+i;
                //}

                html += '<div class="manager ab" stye="display:none" >';
                html += '<span>';
                $.each(item, function(k, item2) {
                    html += item + '&nbsp;';
                });
                html += '</span>';
                html += '<div class="sign ab"></div>';
                html += '</div>';

                html += '</li> ';

                cnt++;
            });
            html += '<li class="tag a0 f12 c2 addtag">添加标签</li>';
            html += '</ul>';



            if(cnt>3){
                //html += '<li class="tag a0 f12 c2 showAll"> 显示全部</li>';
            }

            html += '</div>';


            if(cnt==0){
                html ="";
                html += '<div>';
                html += '<p class="f14 c2">用户标签</p>';
                html += '<ul>';
                html += '<li class="f12 mb-11 c2">无标签</li>';
                html += '<li><a href="javaScript:void(0);" class="tag a0 f12 c2 addtag">添加标签</a></li>';
                html += '</ul>';
                html += '</div>';
             }



            $("#userLabel_"+uid).append(html);
            addtagObj.addtagDome();

        }
    });
}


function refreshUserScore(uid) {


    var _url = '<?php echo (C("QS_BASE_PATH")); ?>/User/getUserAvgScore';
    var param = {
        'uid': uid
    };
    $.ajax({
        method: "POST",
        url: _url,
        data: param,
        dataType: 'json',
        success: function(data) {
            var html = "";

            var cnt = 0;
            $.each(data, function(i, item) {
                html +='<li>';
                html +='<span class="pull-left w60 f12">'+item.name+'</span>';
                html +='<div class="progress progress_style">';
                var par = (item.score/5)*100
                html +='<div class="progress-bar progress_color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '+par+'%;">';
                html +='</div>';
                html +='</div>';
                html +='<span class="f18 pull-left ml-20">'+item.score+'</span>';
                html +='</li>';
                cnt++;
            });

            if(cnt==0){
                html +='<li class="f12 mb-11 c2">尚未评分</li>';
            }

            html +=' <li><a href="javaScript:void(0);" class="a0 details c-l score_user ml-230">评分</a></li>';

            $("#userScoreUL_"+uid).empty();
            $("#userScoreUL_"+uid).append(html);

            addtagObj.scoreuserDom();
        }
    });
}


 /**
 *
 * 显示用户被打标签
 * @param uid 用户ID
 **/
function getUserLabel(uid) {
	var _url = '<?php echo (C("QS_BASE_PATH")); ?>/User/getUserLabel';
	var param = {
		'uid': uid
	};
	$.ajax({
		method: "POST",
		url: _url,
		data: param,
		dataType: 'json',
		success: function(data) {
			var html = "";
			$.each(data.labelInfo, function(i, item) {
					
                html += '<li>';
				html += '<label class="tag orange f12 mr-10 mb-11">' + i + '</label>';

				$.each(item, function(k, item2) {
					html += '<span class="mr-20">' + item2 + '</span>';
				});
				html += '</li>';

			});
			html += '<div class="clear"></div>';
			html += '<span class="span_title">选择标签</span>';
			html += '<div class="clear"></div>';
			
			$("#userLabelUL_"+uid).empty();
			$("#userLabelUL_"+uid).append(html);


            var html = "";
            $.each(data.allLabel, function(i, item) {
                if(item.selected == 1){
                    html += ' <button type="btn" class="tag orange f12 mr-10 mb-11" onclick="cancelLabel(' + item.id + ',' + uid + ')">' + item.name + '</button>';
                }else{
                    html += ' <button type="btn" class="btn_style tag_btn tag_btn1" onclick="labelUser(' + item.id + ',' + uid + ')">' + item.name + '</button>';
                }

            });
            $("#labelUL_"+uid).empty();
            $("#labelUL_"+uid).append(html);
		}
	});
}


/**
 * 给用户取消打标签
 * @param uid 用户ID
 * @param lid 标签ID
 */
function cancelLabel(lid, uid) {
    var _url = '<?php echo (C("QS_BASE_PATH")); ?>/User/cancelLabel';
    var param = {
        'uid': uid,
        'lid': lid
    };

    //if(window.confirm("你确定要取消吗？")){
        $.ajax({
            method: "POST",
            url: _url,
            data: param,
            dataType: 'json',
            success: function(data) {
                if(data > 0) {
                    alert("取消成功");
                    getUserLabel(uid);
                } else {
                    alert("取消失败！");
                }
            }
        });
    //}
}

/**
 * 给用户打标签
 * @param uid 用户ID
 * @param lid 标签ID
 */
function labelUser(lid, uid) {
	var _url = '<?php echo (C("QS_BASE_PATH")); ?>/User/labelUser';
	var param = {
		'uid': uid,
		'lid': lid
	};
    //if(window.confirm("你确定要打该标签吗？")) {
        $.ajax({
            method: "POST",
            url: _url,
            data: param,
            dataType: 'json',
            success: function (data) {
                if (data == -1) {
                    alert("您已经对该用户打过该标签！");
                } else {
                    alert("打标签成功");
                    getUserLabel(uid);
                }
            }
        });
    //}
}

/**
 *
 * 显示用户评分
 * @param uid 用户ID
 **/
function getUserScore(uid) {
	var _url = '<?php echo (C("QS_BASE_PATH")); ?>/User/getUserScore';
	var param = {
		'uid': uid
	};
	$.ajax({
		method: "POST",
		url: _url,
		data: param,
		dataType: 'json',
		success: function(data) {
			var html = "";
			$.each(data, function(userName, item) {

				if('<?php echo ($_SESSION["LOGIN_USER"]["Profile"]["name"]); ?>' != userName) {

					html += '<div class="score">';
					html += '<p class="f14 c2">' + userName + '的评分</p>';
					html += '<ul class="progress_score">';

					$.each(item, function(key, item2) {
						html += '<li>';
						html += '<span class="pull-left w60 f12">' + item2.labelname + '</span>';
						html += '<div class="progress progress_style">';
						html += '<div class="progress-bar progress_color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: ' + (item2.score/5)*100  + '%;"></div>';
						html += '</div>';
						html += '<span class="f18 pull-right">' + item2.score + '</span>';
						html += '</li>';
					});
					html += '</ul>';
					html += '</div>';

				} else {
					html += '<div class="score">';
					html += '<p class="f14 c2">我的评分</p>';
					html += '<ul class="progress_score">';
					$.each(item, function(key, item2) {
						html += '<li>';
						html += '<span class="pull-left w60 f12">' + item2.labelname + '</span>';
						html += '<div class="progress progress_style">';
						html += '<div class="progress-bar progress_color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: ' + (item2.score/5)*100 + '%;"></div>';
						html += '</div>';
						html += '<div class="score1 pull-right">';
						html += '<input id="s_' + uid + '_' + item2.lid + '"   type="number"  min="1" max="5"   class="f18 myscore" value="' + item2.score + '" onblur="scoreUser(this)" />';
						html += '</div>';
						html += '</li>';
					});
					html += '</ul>';
					html += '</div>';
				}
			});
			
			$("#getUserScore_"+uid).empty();
			$("#getUserScore_"+uid).append(html);
		}
	});
}
/**
 * 给用户打分
 * @param item
 */
function scoreUser(item) {

	var id = item.id;
	var ary = item.id.split("_");
	var uid = ary[1];
	var lid = ary[2];
	var score = item.value;

	if(score > 5) {
		alert("请输入不大于5的数字");
		item.focus();
		return;
	}
	var _url = '<?php echo (C("QS_BASE_PATH")); ?>/User/scoreUser';
	var param = {
		'uid': uid,
		'lid': lid,
		'score': score
	};
	$.ajax({
		method: "POST",
		url: _url,
		data: param,
		dataType: 'json',
		success: function(data) {
			if(data != -1) {
				alert("打分成功");
				getUserScore(uid);
			} else {
				alert("打分失败");
			}
		}
	});
}

function   getLocalTime(nS)   {
   return   new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
}


/**
 * 获取已发布、未发布信息
 * @param uid 用户ID
 * @param type 类型
 */
function getWriteList(uid,type) {
	var _url = '<?php echo (C("QS_BASE_PATH")); ?>/User/getWriteList';
	var param = {
		'uid': uid,
		'type': type
	};
	$.ajax({
		method: "POST",
		url: _url,
		data: param,
		dataType: 'json',
		success: function(data) {
			var html = "";
			$.each(data, function(i, item) {
				html+='<div class="col-lg-12 collect_border">';
				html+='<ul class="already">';
				
				if(type==1){
					html+='<li><h3 class="c3"> <a target="_blank" href="http://www.qiaobooks.com/read/'+item.bid+'">'+item.bookname+'</a></h3><span class="f12 c4 ml-20">创建于 '+getLocalTime(item.ctime)+'</span><a href="<?php echo (C("QS_BASE_PATH")); ?>/Book/bookList/bid/'+item.bid+'" class="a0 work_detail mr-20 pull-right">管理</a></li>';
					html+='</ul>';
					html+='<div class="clear"></div>';
					html+='<ul class="detail">';
					html+='<li>';
					html+='<span class="mr-10">定价</span><b>'+item.price+'</b>';
					html+='</li>';
					html+='<li>';
					html+='<span class="mr-10">字数</span><b>'+item.word_cnt+'</b>';
					html+='</li>';
					html+='<li>';
					html+='<span class="mr-10">阅读</span><b>'+item.read_cnt+'</b>';
					html+='</li>';
					html+='<li>';
					html+='<span class="mr-10">购买</span><b>'+item.buy_cnt+'</b>';
					html+='</li>';
					html+='<li>';
					html+='<span class="mr-10">分享</span><b>'+item.share_cnt+'</b>';
					html+='</li>';
                    html+='<li>';
                    html+='<span class="mr-10">收藏</span><b>'+item.mark_cnt+'</b>';
                    html+='</li>';
					html+='<div class="clear"></div>';
					html+='<p><span class="mr-10">发布时间</span><b>'+ getLocalTime(item.utime)+'</b></p>';
					html+='<div class="row">';
					html+='<div class="col-md-8">';
					html+='<div class="pull-left f14 mr-20">作品评分</div>';
					html+='<ul class="progress_score pull-left mr-10">';

                    var recCnt=0;
                    if(item.scoreinfo!='scoreinfo') {
                        $.each(item.scoreinfo, function (k, _score) {
                            html += '<li>';
                            html += '<span class="pull-left f12 w50 mr-10">' + _score.name + '</span>';
                            html += '<div class="progress progress_style1">';
                            var width = (_score.score / 5) * 100
                            html += '<div class="progress-bar purple" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: ' + width + '%;"></div>';
                            html += '</div>';
                            html += '<div class="f18 pull-right ml-10">' + _score.score + '</div>';
                            html += '</li>';
                            recCnt++;
                        });
                    }
                    if(recCnt==0){
                        html+='<li class="f12">尚未评分</li>';
                        html+='<li class="no-margin"><a href="<?php echo (C("QS_BASE_PATH")); ?>/Book/bookList/bid/'+item.bid+'"  class="a0 grade no-margin">评分</a></li>';
                    }

                    html += '</ul>';
                    html += '</div>';
                    html += '<div class="pull-left col-md-4">';
                    html += '<div class="pull-left f14 mr-20">作品标签</div>';
                    html += '<div class="pull-left">';
                    html += '<ul class="mb-2">';

                    recCnt=0;
                    if(item.labelinfo != 'labelinfo') {
                        $.each(item.labelinfo, function (m, _label) {
                            html += '<li class="work_tag">' + _label.lname + '</li>';
                            recCnt++;
                        });
                    }
                    if(recCnt==0){
                        html+='<li class="f12">尚未添加标签</li>';
                        html+='<li class="no-margin"><a href="<?php echo (C("QS_BASE_PATH")); ?>/Book/bookList/bid/'+item.bid+'"  class="a0 grade no-margin">追加标签</a></li>';
                    }

                    html += '</ul>';
                    html += '<div class="clear"></div>';
                    html += '</div>';
                    html += '<div class="clear"></div>';
					html+='</div>';
					html+='</div>';
					html+='</div>';
				}else if(type==0){
					html+='<li><h3 class="c3"><a target="_blank" href="http://www.qiaobooks.com/read/'+item.bid+'">'+item.bookname+'</a></h3><span class="f12 c4 ml-20">创建时间 '+getLocalTime(item.ctime)+'</span></li>';
					html+='</ul>';	
					html+='<div class="clear"></div>';
					html+='<ul class="detail">';	
					html+='<li class="mr-128">';
					html+='<span class="mr-10">总字数</span> <b>'+item.word_cnt+'</b>';
					html+='</li>';
					html+='<li>';
					html+='<span class="mr-10">最后保存时间</span><b>'+getLocalTime(item.lutime)+'</b>';
					html+='</li>';
					html+='</ul>';
					html+='<div class="clear"></div></div>';
				}
				
			});

            if(html ==''){
                html="未查询到相关记录!"
            }
			if(type==1){
				$("#Book_"+uid).empty();
				$("#Book_"+uid).append(html);
			}else if(type==0){
				$("#Book2_"+uid).empty();
				$("#Book2_"+uid).append(html);
			}
		}
	});
}


/**
 * 获取收藏、读过的信息
 * @param uid 用户ID
 * @param type 类型
 */
function readList(uid,type) {
	var _url = '<?php echo (C("QS_BASE_PATH")); ?>/User/readList';
	var param = {
		'uid': uid,
		'type': type
	};
	$.ajax({
		method: "POST",
		url: _url,
		data: param,
		dataType: 'json',
		success: function(data) {
			var html = "";

			$.each(data, function(i, item) {
				html+='<div class="row collect_border">';
				html+='<div class="col-lg-12">';
				html+='<ul class="already">';

				html+='<li><h3 class="c3"> <a target="_blank" href="http://www.qiaobooks.com/read/'+item.bid+'">'+item.bookname+'</a></h3><span class="f12 c4 ml-20"><span class="c3"> <a target="_blank" href="http://www.qiaobooks.com/Home/'+item.authorid+'">'+item.authorname[0]['authorname']+'&nbsp;&nbsp;</a></span>发布于 '+getLocalTime(item.utime)+'</span><a href="<?php echo (C("QS_BASE_PATH")); ?>/Book/bookList/bid/'+item.bid+'" class="a0 work_detail mr-20 pull-right">管理</a></li>';
				html+='</ul>';
				html+='<div class="clear"></div>';
				html+='<ul class="detail">';
				html+='<li>';
				html+='<span class="mr-10">定价</span><b>'+item.price+'</b>';
				html+='</li>';
				html+='<li>';
				html+='<span class="mr-10">字数</span><b>'+item.word_cnt+'</b>';
				html+='</li>';
				html+='<li>';
				html+='<span class="mr-10">阅读</span><b>'+item.read_cnt+'</b>';
				html+='</li>';
				html+='<li>';
				html+='<span class="mr-10">购买</span><b>'+item.buy_cnt+'</b>';
				html+='</li>';
				html+='<li>';
				html+='<span class="mr-10">分享</span><b>'+item.share_cnt+'</b>';
				html+='</li>';
                html+='<li>';
                html+='<span class="mr-10">收藏</span><b>'+item.mark_cnt+'</b>';
                html+='</li>';
				html+='<div class="clear"></div>';
				if(type==1){
					html+='<p><span class="mr-10">收藏时间</span><b>'+getLocalTime(item.readtime)+'</b></p>';
				}else if(type==0){
					html+='<p><span class="mr-10">阅读时间</span><b>'+getLocalTime(item.readtime)+'</b></p>';
				}
				html+='<div class="row">';
				html+='<div class="col-md-8">';
				html+='<div class="pull-left f14 mr-20">作品评分</div>';
				html+='<ul class="progress_score pull-left mr-10">';

                var recCnt=0;

                if(item.scoreinfo!='scoreinfo'){
                    $.each(item.scoreinfo, function(k, _score) {
                        html+='<li>';
                        html+='<span class="pull-left f12 w50 mr-10">'+_score.name+'</span>';
                        html+='<div class="progress progress_style1">';
                        var width= (_score.score/5)*100
                        html+='<div class="progress-bar purple" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '+width+'%;"></div>';
                        html+='</div>';
                        html+='<div class="f18 pull-right ml-10">'+_score.score+'</div>';
                        html+='</li>';
                        recCnt++;
                    });
                }
                if(recCnt==0){
                    html+='<li class="f12">尚未评分</li>';
                    html+='<li class="no-margin"><a href="<?php echo (C("QS_BASE_PATH")); ?>/Book/bookList/bid/'+item.bid+'"  class="a0 grade no-margin">评分</a></li>';
                }

				html+='</ul>';
				html+='</div>';
				html+='<div class="col-md-4">'
				html+='<div class="pull-left">';
				html+='<div class="pull-left f14 mr-20">作品标签</div>';
				html+='<div class="pull-left">';
				html+='<ul class="mb-2">';
                recCnt=0;
                if(item.labelinfo!='labelinfo') {
                    $.each(item.labelinfo, function (m, _label) {
                        html += '<li class="work_tag">' + _label.lname + '</li>';
                        recCnt++;
                    });
                }
                if(recCnt==0){
                    html+='<li class="f12">尚未添加标签</li>';
                    html+='<li class="no-margin"><a href="<?php echo (C("QS_BASE_PATH")); ?>/Book/bookList/bid/'+item.bid+'"  class="a0 grade no-margin">追加标签</a></li>';
                }

				html+='</ul>';
				html+='<div class="clear"></div>';
				html+='<ul>';
//				html+='<li class="work_tag">'+item.price+'</li>';
                if(recCnt>3) {
                    html += '<li class="work_tag show_all">显示全部</li>';
                }
				html+='</div>';
				html+='<div class="clear"></div>';
				html+='</div>';
				html+='</div>';
				html+='</div>';
				html+='</div>';
				html+='</div>';
			});

            if(html ==""){
                html="未查询到相关记录!"
            }

			if(type==1){
				$("#Already_"+uid).empty();
				$("#Already_"+uid).append(html);
			}else if(type==0){
				$("#Already1_"+uid).empty();
				$("#Already1_"+uid).append(html);
			}
			
		}
	});
}
/**
 * 获取账户信息
 * @param uid 用户ID
 *
 */
function getUserAccountInfo(uid) {
	var _url = '<?php echo (C("QS_BASE_PATH")); ?>/User/getUserAccountInfo';
	var param = {
		'uid': uid
	};
	$.ajax({
		method: "POST",
		url: _url,
		data: param,
		dataType: 'json',
		success: function(data) {
			var html = "";
			var amt = data.amt;
		    var left = data.left;
		    
		    var gains_history = data.gains_history;
		    var buy_history = data.buy_history;
		    var cash_history = data.cash_history;

		    	html+='<ul class="account c2">';
				html+='<li>总收益：<span class="f14 c3">&nbsp;'+amt+'</span></li>';
				html+='<li>账户余额:<span class="f14 c3">&nbsp;&nbsp;'+left+'</span></li>';
				html+='</ul>';
				html+='<div class="clear"></div>';
				html+='<div class="accounts" id="account_btn">';
				html+='<a href="###" class="a0 account_btn active1 gains_'+uid+'"  onclick="showDiv(\'gains_'+uid+'\')">收益</a>';
				html+='<a href="###" class="a0 account_btn gains1_'+uid+'"  onclick="showDiv(\'gains1_'+uid+'\')">消费</a>';
				html+='<a href="###" class="a0 account_btn gains2_'+uid+'"  onclick="showDiv(\'gains2_'+uid+'\')">提现</a>';
				html+='</div>';
				html+='<div class="box-body">';
				html+='<table id="gains_'+uid+'" class="table table-bordered">';
				html+='<thead>';
				html+='<tr>';
				html+='<th class="col-md-2">时间</th>';
				html+='<th>作品</th>';
				html+='<th>购买者</th>';
				html+='<th>金额</th>';
				html+='</tr>';
				html+='</thead>';
				html+='<tbody>';

                $.each(gains_history, function(k, _history) {
                    html += '<tr>';
                    html += '<td>' + _history.pay_time + '</td>';
                    html += '<td><a target="_blank" href="<?php echo (C("QS_BASE_PATH")); ?>/Book/bookList/bid/'+_history.bid+'">' + _history.book_name + '</a></td>';
                    html += '<td><a target="_blank" href="<?php echo (C("QS_BASE_PATH")); ?>/User/listUser/uid/'+_history.uid+'">' + _history.nick_name + '</a></td>';
                    html += '<td>' + _history.money + '</td>';
                    html += '</tr>';
                });


				html+='</tbody>';
				html+='</table>';
				
				html+='<table id="gains1_'+uid+'" class="table table-bordered example1">';
				html+='<thead>';
				html+='<tr>';
				html+='<th class="col-md-2">时间</th>';
				html+='<th>作品</th>';
				html+='<th>作者</th>';
				html+='<th>金额</th>';
				html+='</tr>';
				html+='</thead>';
				html+='<tbody>';


                $.each(buy_history, function(l, _b) {
                    html += '<tr>';
                    html += '<td>' + _b.pay_time + '</td>';
                    html += '<td><a target="_blank" href="<?php echo (C("QS_BASE_PATH")); ?>/Book/bookList/bid/'+_b.bid+'">' + _b.book_name + '</a></td>';
                    html += '<td><a target="_blank" href="<?php echo (C("QS_BASE_PATH")); ?>/User/listUser/uid/'+_b.author_id+'">' + _b.nick_name + '</a></td>';
                    html += '<td>' + _b.money + '</td>';
                    html += '</tr>';
                });



				html+='</tbody>';
				html+='</table>';
				
				html+='<table id="gains2_'+uid+'" class="table table-bordered example1">';
				html+='<thead>';
				html+='<tr>';
				html+='<th class="col-md-2">申请时间</th>';
				html+='<th>提现金额</th>';
				html+='<th>提现渠道</th>';
				html+='<th>处理状态</th>';
                html+='<th>处理时间</th>';
				html+='</tr>';
				html+='</thead>';
				html+='<tbody>';

                $.each(cash_history, function(n, _c) {
                    html += '<tr>';
                    html += '<td>' + _c.apply_date + '</td>';
                    html += '<td>' + _c.money + '</td>';

                    if(_c.pay_type==0){
                        html += '<td>支付宝</td>';
                    }else{
                        html += '<td>微信</td>';
                    }

                    if(_c.status==0){
                        html += '<td>申请中</td>';
                    }else if (_c.status==1) {
                        html += '<td>已同意</td>';
                    }else {
                        html += '<td>已拒绝</td>';
                    }

                    html += '<td>' + _c.pay_time + '</td>';
                    html += '</tr>';
                });

				html+='</tbody>';
				html+='</table>';
				html+='</div>'
			$("#Account_"+uid).empty();
			$("#Account_"+uid).append(html);
		}
	});
}
/**
 * 备注用户
 * @param com
 */
function remarkUser(id,com){
    var _url = '<?php echo (C("QS_BASE_PATH")); ?>/User/remarkUser';
    var remark = com.value;
    var oldval = $("#remark_"+id).attr('oldval');
    var param = {
        'id': id,
        'remark': remark,
        'oldval':oldval
    };
    if(remark!=oldval){
    	 $.ajax({
        method: "POST",
        url: _url,
        data: param,
        dataType: 'json',
        success: function(data) {
            if(data > 0) {
                alert("备注成功");
            } else {
                alert("备注失败");
            }
        }
    });
    }
   
}

/**
 * 搜索
  */
function doSearch(){
  $("#userForm").submit();
}
/**
 * 排序
 * @param fieldName
 */
function setSort(fieldName){
    $('#gotoPage').val(1);
    $('#sort').val(fieldName);
    doSearch();

}

/**
 * 跳转页
 * @param com
 */
function setPageNum(pageNum){
    $('#gotoPage').val(pageNum);
    doSearch();
}

$("#aGoPage").change(function(){
    var pageNum = $("#aGoPage option:selected").text();
    $('#gotoPage').val(pageNum);
    doSearch();
});

/**
 * 选择标签页
 * @param lid
 */
function setLabel(lid){
//  $('#lids').val(lid);
//  doSearch();
}


/**
 * 选择所有标签页
 * @param lid
 */
function allLabel(){
    $('#gotoPage').val(1);
    $('#lids').val("");
    doSearch();
}

    /**
 * 有标签页
 * @param lid
 */
function haveLabel(){
    $('#gotoPage').val(1);
    $('#lids').val("HAVE_LABEL");
    doSearch();
}

/**
 * 选择所有标签页
 * @param lid
 */
function noLabel(){
    $('#gotoPage').val(1);
    $('#lids').val("NO_LABEL");
    doSearch();
}

/**
 * 选择评分
 * @param lid 标签id
 * @param score 分数id
 */
function setScore(lid,score){
//	alert($(this).attr('class'));	
 
 
}

/**
 * 选择有评分
 */
function allScore(){
    $('#scoreIds').val("");
    $('#gotoPage').val(1);
    doSearch();
}

/**
 * 选择有评分
 */
function haveScore(){
    $('#scoreIds').val("HAVE_SCORE");
    $('#gotoPage').val(1);
    doSearch();
}
/**
 * 没评分
 */
function noScore(){
    $('#scoreIds').val("NO_SCORE");
    $('#gotoPage').val(1);
    doSearch();
}

/**
 * 跳转页
 */
function gotoPage(pageNum){
    $('#gotoPage').val(pageNum);
    doSearch();
}
//表格显示
function showDiv(target){
    $('#account_btn').children("."+target).addClass('active1').siblings().removeClass("active1");
    $('#'+target).show().siblings().hide();
}
</script>
</body>
</html>