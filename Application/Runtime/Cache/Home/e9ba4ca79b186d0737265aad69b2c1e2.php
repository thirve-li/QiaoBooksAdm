<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>作品列表</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/Public/css/bootstrap.css">
    <link rel="stylesheet" href="/Public/css/datepicker3.css">
    <link rel="stylesheet" href="/Public/css/daterangepicker-bs3.css">
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



        <!-- 主要内容 -->
        <section class="content" id="fixed">
            <div class="box border-box">

                <div class="box-body box-profile">
                    <form class="form-inline"  action="<?php echo (C("QS_BASE_PATH")); ?>/Book/bookList" method="post" id="bookForm" name="bookForm">

                        <input name="lids" id="lids" type="hidden" value="<?php echo ($lids); ?>">
                        <input name="lidsName" id="lidsName" type="hidden" value="<?php echo ($lidsName); ?>">
                        <input name="scoreIds" id="scoreIds" type="hidden" value="<?php echo ($scoreIds); ?>">
                        <input name="scoreName" id="scoreName" type="hidden" value="<?php echo ($scoreName); ?>">
                        <input name="sort" id="sort" type="hidden" value="<?php echo ($sort); ?>">
                        <input id="uid" name="uid" type="hidden" placeholder="作者ID" >
						
                        <input name="recorderCnt" id="recorderCnt" type="hidden" value="<?php echo ($recorderCnt); ?>">
                        <input name="pageCnt" id="pageCnt" type="hidden" value="<?php echo ($pageCnt); ?>">
                        <input name="gotoPage" id="gotoPage" type="hidden" value="<?php echo ($gotoPage); ?>">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-xs-6 mb-10">
                                    <input id="name" name="name" value="<?php echo ($name); ?>" type="text" class="form-control input_style mr-5" placeholder="作品名称">
                                    <input class="form-control input_style mr-5" name="nick_name" type="text" placeholder="&nbsp;&nbsp;作者昵称" value="<?php echo ($nick_name); ?>">
                                     <div class="form-group">
						                <div class="input-group">
						                  <input type="text" name="upTime"  class="form-control pull-right time_width" id="daterange-btn" placeholder="发布时间" value="<?php echo ($upTime); ?>">
							                   <span></span>
						                </div>
						             </div>


                                    <div class="form-group">
                                        <div class="input-group">
                                            <select class="form-control select2 input_style1" name="bookType" onchange="doSearch()" placeholder="作品分类">
                                                <option value="" <?php if($bookType == '' ): ?>selected<?php endif; ?> >全部显示</option>

                                                <?php if(is_array($bookTypeList)): $i = 0; $__LIST__ = $bookTypeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($type["id"]); ?>" <?php if($bookType == $type["id"] ): ?>selected<?php endif; ?> ><?php echo ($type["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                    </div>

						              <div class="form-group ">
                                        <div class="input-group">
                                            <select class="form-control select2 input_style1" name="isup" onchange="doSearch()" placeholder="是否已发布">
                                                <option value="" <?php if($isup == 'ALL' ): ?>selected<?php endif; ?> >全部显示</option>
                                                <option value="1" <?php if( $isup == '1' ): ?>selected<?php endif; ?>  >已发布</option>
                                                <option value="0" <?php if( $isup == '0' ): ?>selected<?php endif; ?> >未发布</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>

                                <!--用户评分-->
                                <div class="col-lg-2 col-xs-6">
                                    <div class="box dropdown_input collapsed-box">
                                        <div class="box-header with-border box_content">
                                            <span class="work_score">&nbsp;&nbsp;作品评分</span>
                                            <div class="box-tools">
                                                <button type="button" class="btn btn-box-tool re" data-widget="collapse"><i class="fa fa-plus incre"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="box-body box_close">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li class="text-center">
                                                    <button type="btn" class="btn_style score_btn2" onclick="allScore()">全部评分</button>
                                                    <button type="btn" class="btn_style score_btn2" onclick="noScore()">没有评分</button>
                                                </li>
                                                <?php if(is_array($scoreLabelList)): $i = 0; $__LIST__ = $scoreLabelList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li class="m10" id='<?php echo ($row["name"]); ?>'>
                                                        <span class="display1"><?php echo ($row["name"]); ?></span>
									                	<span class="btn_style score_btn3 mr-1" a='<?php echo ($row["id"]); ?>' s='1'>1分</span>
									                	<span class="btn_style score_btn3 mr-1" a='<?php echo ($row["id"]); ?>' s='2'>2分</span>
									                	<span class="btn_style score_btn3 mr-1" a='<?php echo ($row["id"]); ?>' s='3'>3分</span>
									                	<span class="btn_style score_btn3 mr-1" a='<?php echo ($row["id"]); ?>' s='4'>4分</span>
									                	<span class="btn_style score_btn3" a='<?php echo ($row["id"]); ?>' s='5'>5分</span>
                                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    <li class="text-center m10">
                                                        <span id='sure_score' class="btn_style score_btn2">确定</span>
				                						<span class="btn_style score_btn2 no-margin" id="cancel_score">取消</span>
                                                    </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div><!--/.用户评分-->
                                <!--用户标签-->
                                <div class="col-lg-2 col-xs-6">
                                    <div class="box dropdown_input collapsed-box">
                                        <div class="box-header with-border tag_content">
                                            <span class="workTag">&nbsp;&nbsp;标签</span>
                                            <div class="box-tools">
                                                <button type="button" class="btn btn-box-tool re" data-widget="collapse"><i class="fa fa-plus incre"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="box-body box_close">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li class="text-center">
                                                    <button type="btn" class="btn_style score_btn2">全部标签</button>
                                                    <button type="btn" class="btn_style score_btn2">没有标签</button>
                                                </li>
                                                
                                                <li class="m10 text-center">
								                	<?php if(is_array($bookLabelList)): $i = 0; $__LIST__ = $bookLabelList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><span class="tag_btn m10 tagNs" a='<?php echo ($row["id"]); ?>' id='<?php echo ($row["name"]); ?>'><?php echo ($row["name"]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
		                					    </li>

                                                <li class="text-center m10">
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
                                <div class="col-lg-8 col-xs-12 text-left m5">
                                	<div class="btn-group pull-left mr-10">
                                        <button type="button" class="btn_style search1 f14" onclick="$('#gotoPage').val(1);doSearch()">搜索</button>
                                    </div>
                                	
                                    <div class="pull-left">
                                        <span>排序</span>

                                        <?php if($sort=='utime'): ?><button type="button" class="btn_style btn_style1 active1" onclick="setSort('utime')">按发布时间</button>
                                            <?php else: ?>
                                            <button type="button" class="btn_style btn_style1" onclick="setSort('utime')">按发布时间</button><?php endif; ?>

                                        <?php if($sort=='read_cnt'): ?><button type="button" class="btn_style btn_style1 active1" onclick="setSort('read_cnt')">按阅读数</button>
                                            <?php else: ?>
                                            <button type="button" class="btn_style btn_style1" onclick="setSort('read_cnt')">按阅读数</button><?php endif; ?>


                                        <?php if($sort=='mark_cnt'): ?><button type="button" class="btn_style btn_style1 active1" onclick="setSort('mark_cnt')">按收藏数</button>
                                        <?php else: ?>
                                            <button type="button" class="btn_style btn_style1" onclick="setSort('mark_cnt')">按收藏数</button><?php endif; ?>

                                        <?php if($sort=='buy_cnt'): ?><button type="button" class="btn_style btn_style1 active1" onclick="setSort('buy_cnt')">按购买数</button>
                                        <?php else: ?>
                                            <button type="button" class="btn_style btn_style1" onclick="setSort('buy_cnt')">按购买数</button><?php endif; ?>

                                        <?php if($sort=='money_cnt'): ?><button type="button" class="btn_style btn_style1 active1" onclick="setSort('money_cnt')">按收益数</button>
                                        <?php else: ?>
                                            <button type="button" class="btn_style btn_style1" onclick="setSort('money_cnt')">按收益数</button><?php endif; ?>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-4 col-xs-12 text-right">
                                    <ul class="pagination">
										<li><a href="###" onclick="gotoPage(<?php echo ($gotoPage-1); ?>)">上一页</a></li>
				
			                            <!--<?php $__FOR_START_1447205635__=0;$__FOR_END_1447205635__=$pageCnt;for($i=$__FOR_START_1447205635__;$i < $__FOR_END_1447205635__;$i+=1){ ?>-->
			                            	<!--<?php if($i+1 == $gotoPage): ?>-->
			                                   <!--<li class="active"><a href="###" onclick="gotoPage(<?php echo ($i+1); ?>)"><?php echo ($i+1); ?></a></li>-->
			                                <!--<?php else: ?>-->
			                                	<!--<li><a href="###" onclick="gotoPage(<?php echo ($i+1); ?>)"><?php echo ($i+1); ?></a></li>-->
			                                <!--<?php endif; ?>	-->
			                            <!--<?php } ?>-->


                                        <li>跳至<select name="aGoPage" id="aGoPage" >
                                            <option value=""> </option>
                                            <?php $__FOR_START_893654743__=0;$__FOR_END_893654743__=$pageCnt;for($i=$__FOR_START_893654743__;$i < $__FOR_END_893654743__;$i+=1){ if($i+1 == $gotoPage): ?><option value="<?php echo ($gotoPage); ?>" selected ><?php echo ($i+1); ?></option>
                                                    <?php else: ?>
                                                    <option value="<?php echo ($gotoPage); ?>"><?php echo ($i+1); ?></option><?php endif; } ?>
                                        </select>页<li>
				
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

                        <?php if(is_array($bookList)): $k = 0; $__LIST__ = $bookList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$book): $mod = ($k % 2 );++$k;?><div <?php if($k%2== '0'): ?>style="background-color:#FFFFF0;"<?php endif; ?> class="row user_list_bor box_hover" id="userInfo">
        					<div class="col-lg-4 col-xs-6 re alert_box">
         						 <div class="pull-left details_bottom">

                                     <?php if($book['bookInfo'][0]['isup'] == 1): ?><div class="author_name fb c3 l20 pull-left mr-20">
                                             <a href="http://www.qiaobooks.com/read/<?php echo ($book['bookInfo'][0]['id']); ?>" target="_blank"><?php echo ($book['bookInfo'][0]['name']); ?></a>
                                         </div><a href="####" value="0" bid="<?php echo ($book['bookInfo'][0]['id']); ?>" class="a0 details pull-left detail_change">修改书名</a><?php endif; ?>
                                     <?php if($book['bookInfo'][0]['isup'] == 0): ?><div class="author_name fb c3 l20 pull-left mr-20">
                                             <?php echo ($book['bookInfo'][0]['name']); ?>
                                         </div><?php endif; ?>


         						 	<div class="clear"></div>
				 					<ul class="c2">
                                        <li class="c2 f12">作者ID：<a target="_blank" href="http://adm.qiaobooks.com/User/listUser/uid/<?php echo ($book['bookInfo'][0]['uid']); ?>"><?php echo ($book['bookInfo'][0]['uid']); ?></a></li>
				 						<li class="c2 f12">作者：<span class="c3"><a  target="_blank" href="http://adm.qiaobooks.com/User/listUser/uid/<?php echo ($book['bookInfo'][0]['uid']); ?>"><?php echo ($book['bookInfo'][0]['authorname']); ?></a></span></li>
                                        <li class="c2 f12">创建时间：<?php echo date('Y-m-d H:i:s' ,$book['bookInfo'][0]['ctime']);?>  </li>
                                        <?php if($book['bookInfo'][0]['isup'] == 1): ?><li class="c2 f12">发布时间：<?php echo date('Y-m-d H:i:s' ,$book['bookInfo'][0]['uptime']);?>  </li>
                                        <?php else: ?>
                                            <li class="c2 f12">最后保存：<?php echo date('Y-m-d H:i:s' ,$book['bookInfo'][0]['lutime']);?>  </li><?php endif; ?>

                                        <li class="c2 f12">作品ID：<?php echo ($book['bookInfo'][0]['id']); ?></li>
						 				<li class="c2 f12">OR数：<?php echo ($book['bookInfo'][0]['or_cnt']); ?>个</li>

                                        <?php if($book['bookInfo'][0]['isup'] == 1): if($book['bookInfo'][0]['price'] == 0): ?><li class="c2 f12 re">免费<i class="price_tip">i</i>
                                            <?php else: ?>
                                                <li class="c2 f12">收费节点：第<?php echo ($book['bookInfo'][0]['price_or_node']); ?>个OR</span></li>
                                                <li class="c2 f12 re">收费价格：<b>¥<?php echo ($book['bookInfo'][0]['price']); ?></b><i class="price_tip">i</i><?php endif; ?>
                                        <?php else: ?>
                                            <li class="c2 f12 re">免费<i class="price_tip">i</i><?php endif; ?>

						 					<div class="re price_height p_price">
						 					<ul>
                                                <?php if(is_array($book['priceInfo'][0])): $i = 0; $__LIST__ = $book['priceInfo'][0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li class="valer">第<?php echo ($i); ?>次（<?php echo ($row['time']); ?>）:<b class="c2">¥<?php echo ($row['price']); ?></b></li><?php endforeach; endif; else: echo "" ;endif; ?>
						 					</ul>
						 					<div class="sign ab"></div>
								 			</div>
						 				</li>
						 				
						 				
				 					</ul>
			 					</div>
			 					
					 			<ul class="pull-right">
					 				<li>
                                        <?php if($book['bookInfo'][0]['isup'] == 1): ?><a id="showDetail_<?php echo ($book['bookInfo'][0]['id']); ?>" href="###" class="a0 details mb-65 check" onclick="showDetail(<?php echo ($book['bookInfo'][0]['id']); ?>)">查看详情</a><?php endif; ?>
                                        <?php if($book['bookInfo'][0]['isup'] == 0): ?><a id="showDetail_<?php echo ($book['bookInfo'][0]['id']); ?>" href="###" class="a0 details mb-65 check">未发布</a><?php endif; ?>
                                    </li>

                                    <li>
                                        <a href="http://www.qiaobooks.com/Fix/book/id/<?php echo ($book['bookInfo'][0]['id']); ?>" class="a0 details mb-65 check" style="background-color: #ac2925" target="_blank" >检查错误</a>
                                    </li>

                                    <li>

                                        <?php if($book['bookInfo'][0]['isup'] == 1): ?><a href="javaScript:void(0);" t="<?php echo ($book['bookInfo'][0]['id']); ?>" s="<?php echo ($book['bookInfo'][0]['isup']); ?>" class="a0 details isup">下架</a><?php endif; ?>

                                        <?php if($book['bookInfo'][0]['isup'] == 0): ?><a href="javaScript:void(0);" t="<?php echo ($book['bookInfo'][0]['id']); ?>" s="<?php echo ($book['bookInfo'][0]['isup']); ?>" class="a0 details isup">上架</a><?php endif; ?>

                                    </li>
					 			</ul>
       						</div>
        					<!-- ./用户信息 -->
        					<!--作品信息-->
					        <div class="col-lg-2 col-xs-6">
					          			<div>
								 				<p class="f14 c2">作品信息</p>
								 			<ul class="pull-left">
								 				<li class="mb-5 f12">字数：</li>
								 				<li class="mb-5 f12">阅读数：</li>
								 				<li class="mb-5 f12">收藏数：</li>
								 				<li class="mb-5 f12">购买数：</li>
								 				<li class="mb-5 f12">分享数：</li>
								 				<li class="f12">收益数：</li>
								 			</ul>
								 			<ul class="ml-48 pull-left">
								 				<li class="number"><b><?php echo ((isset($book['bookInfo'][0]['word_cnt']) && ($book['bookInfo'][0]['word_cnt'] !== ""))?($book['bookInfo'][0]['word_cnt']):0); ?></b></li>
								 				<li class="number"><b><?php echo ((isset($book['bookInfo'][0]['read_cnt']) && ($book['bookInfo'][0]['read_cnt'] !== ""))?($book['bookInfo'][0]['read_cnt']):0); ?></b></li>
								 				<li class="number"><b><?php echo ((isset($book['bookInfo'][0]['mark_cnt']) && ($book['bookInfo'][0]['mark_cnt'] !== ""))?($book['bookInfo'][0]['mark_cnt']):0); ?></b></li>
								 				<li class="number"><b> <?php echo ((isset($book['bookInfo'][0]['buy_cnt']) && ($book['bookInfo'][0]['buy_cnt'] !== ""))?($book['bookInfo'][0]['buy_cnt']):0); ?></b></li>
								 				<li class="number"><b> <?php echo ((isset($book['bookInfo'][0]['share_cnt']) && ($book['bookInfo'][0]['share_cnt'] !== ""))?($book['bookInfo'][0]['share_cnt']):0); ?></b></li>
								 				<li class="number"><b>¥<?php echo ((isset($book['bookInfo'][0]['money_cnt']) && ($book['bookInfo'][0]['money_cnt'] !== ""))?($book['bookInfo'][0]['money_cnt']):0); ?></b></li>
								 			</ul>
								 		</div>
					        </div>
					        <!--/.作品信息-->
                            <?php if($book['bookInfo'][0]['isup'] == 1): ?><!--作品标签 -->
                            <?php if(!empty($book['labelInfo'][0])): ?><div class="col-lg-2 col-xs-6 alert_box">
					         	<div>
								 			<p class="f14 c2">作品标签</p>
								 			<ul class="pull-left tag-nav" id="bookLabelUL_<?php echo ($book['bookInfo'][0]['id']); ?>">
								 				<?php $s=1; ?>
                                                <?php if(is_array($book['labelInfo'][0])): $i = 0; $__LIST__ = $book['labelInfo'][0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li class="tag light_blue f12 tag_hover re" <?php echo ($s>3?'style="display:none"':''); ?>>
                                                        <?php echo ($key); ?>
                                                            <div class="manager ab">
                                                                <span>
                                                                    <?php if(is_array($row)): $i = 0; $__LIST__ = $row;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; echo ($item); ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                                                                </span>
                                                                    <div class="sign ab"></div>

                                                            </div>
                                                    </li>
                                                    <?php $s++; endforeach; endif; else: echo "" ;endif; ?>
				 									<li class="tag a0 f12 c2 addtag">添加标签</li>
				 								<?php if($s > 3): ?><li class="tag a0 f12 c2 showAll">显示全部</li><?php endif; ?>	
								 			</ul>
								</div>
					        </div><!-- ./作品标签 -->
							<?php else: ?>
        					<!--无数据--用户标签-->	
							<div class="col-lg-2 col-xs-6 alert_box">
						 			<div>
							 			<p class="f14 c2">作品标签</p>
							 			<ul>
							 				<li class="f12 mb-11 c2">无标签</li>
							 				<li><a href="javaScript:void(0);" class="a0 details c-l add_label">添加标签</a></li>
							 			</ul>
							 		</div>
							 </div><?php endif; ?>
							
        					<?php if(!empty($book['scoreInfo'][0])): ?><div class="col-lg-4 col-xs-6 alert_box">
						         			<div>
									 			<p class="f14 c2">作品评分</p>
	                                            <ul class="progress_score" id="bookScoreUL_<?php echo ($book['bookInfo'][0]['id']); ?>">
	                                            <?php if(is_array($book['scoreInfo'][0])): $i = 0; $__LIST__ = $book['scoreInfo'][0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li>
	                                                    <span class="pull-left w60 f12"><?php echo ($row['name']); ?></span>
	
	                                                    <div class="progress progress_style">
	                                                        <div class="progress-bar purple" role="progressbar"
	                                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
	                                                             style="width: <?php echo ($row['score']/5*100); ?>%;">
	                                                        </div>
	                                                    </div>
	                                                    <span class="f18 pull-left ml-20"><?php echo ($row['score']); ?></span>
	                                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
	                                            	<li ><a href="javaScript:void(0);" class="a0 details c-l add_score ml-230">评分</a></li>
	                                            </ul>
									 		</div>
						        </div><!--作品评分 end-->
					        <?php else: ?>
					        <!--作品评分无数据-->

					        <div class="col-lg-4 col-xs-6 alert_box">
						 			<div>
							 				<p class="f14 c2">作品评分</p>
							 			<ul>
							 				<li class="f12 mb-11 c2">尚未评分</li>
							 				<li><a href="javaScript:void(0);"  class="a0 details c-l add_score">评分</a></li>
							 			</ul>
							 		</div>
						  </div><?php endif; endif; ?>
						  <!--------弹窗部分------->
						  	<div class="col-lg-8 col-xs-6 author_box">
							<i></i>
							<div class="close_btn" id="close_btn"><span bid="<?php echo ($book['bookInfo'][0]['id']); ?>">关闭</span></div>
							<ul class="top_list" id="top_list">
								<li class="tag_border" value="<?php echo ($book['bookInfo'][0]['id']); ?>">作品标签</li>
								<li onclick="getBookScore(<?php echo ($book['bookInfo'][0]['id']); ?>)" value="<?php echo ($book['bookInfo'][0]['id']); ?>">作品评分</li>
								<li onclick="getBookBuy(<?php echo ($book['bookInfo'][0]['id']); ?>)">购买记录</li>
							</ul>
							<div class="clear"></div>
							<div class="tag_list_box">
							<!--作品标签弹窗-->
								<div class="tag_list m20 tag_show">

                                    <ul class="tag_name labelcont" id="bookType_<?php echo ($book['bookInfo'][0]['id']); ?>"></ul>
                                    <ul ><li class="m20 nihao" id="bookTypeLi_<?php echo ($book['bookInfo'][0]['id']); ?>"></li></ul>

									<ul ><li class="m20 nihao" id="labelUL_<?php echo ($book['bookInfo'][0]['id']); ?>"></li></ul>
								</div>

								<!--作品评分弹窗-->
								<div class="tag_list" id="getBookScore_<?php echo ($book['bookInfo'][0]['id']); ?>">
									
						 			<!-----无评分样式------>
						 			<!--<if condition="empty($book['scoreInfo'][0])">
						 			<div class="score">
						 				<p>大家还没有评分，赶快添加你的评分吧！</p>
							 			<p class="f14 c2">我的评分</p>
							 			<ul class="progress_score">
							 				<li>
							 					<span class="pull-left w60 f12">创作</span>
							 					<div class="progress progress_style">
													<div class="progress-bar purple" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<div class="score1">
													<input type="text" class="f18 pull-right myscore fraction" value="3.5" id="my_score"/>
												</div>
							 				</li>
							 				<li>
							 					<span class="pull-left w60 f12">知识面</span>
							 					<div class="progress progress_style">
													<div class="progress-bar purple" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<div class="score1">
													<input type="text" class="f18 pull-right myscore fraction" value="4" id="my_score"/>
												</div>
		
							 				</li>
							 				<li>
							 					<span class="pull-left w60 f12">沟通能力</span>
							 					<div class="progress progress_style">
													<div class="progress-bar purple" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<div class="score1">
													<input type="text" class="f18 pull-right myscore fraction" value="3" id="my_score"/>
												</div>
		
							 				</li>
							 				<li>
							 					<span class="pull-left w60 f12">形象</span>
							 					<div class="progress progress_style">
													<div class="progress-bar purple" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<div class="score1">
													<input type="text" class="f18 pull-right myscore fraction" value="2" id="my_score"/>
												</div>
		
							 				</li>
							 			</ul>
						 			</div>
						 		<if/>	-->
								</div>
								<!----------购买记录------------->
								<div class="tag_list" id="bookBuy_<?php echo ($book['bookInfo'][0]['id']); ?>">
		
								</div>

						</div><!------/.tag_list_box------>
						</div><!-------/.#popup------->

						</div><!--row user_list_bor--><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div><!-- ./box-style -->
		</section>
        <!-- /.content -->

    </div>

    <!------ 设置的滑动菜单 recent.html aside begin------>
    <!-- 设置的滑动菜单 -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                            <p>New phone +1(800)555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                            <p>Execution time 5 seconds</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="label label-danger pull-right">70%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Update Resume
                            <span class="label label-success pull-right">95%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Laravel Integration
                            <span class="label label-warning pull-right">50%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Back End Framework
                            <span class="label label-primary pull-right">68%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->

        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Other sets of options are available
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Allow the user to show his name in blog posts
                    </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-right" checked>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-right">
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
    <!------- 设置的滑动菜单 recent.html  aside end----->


    <div class="control-sidebar-bg"></div>

</div>

<script src="/Public/js/jQuery-2.2.0.min.js"></script>
<script src="/Public/js/bootstrap.js"></script>
<script src="/Public/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="/Public/js/daterangepicker.js"></script>
<script src="/Public/js/bootstrap-datepicker.js"></script>
<script src="/Public/js/bookList.js"></script>
<script>

    if('<?php echo ($scoreIds); ?>' == 'NO_SCORE'){
        $('.work_score').html('没有评分');
    }

    if('<?php echo ($scoreIds); ?>' == ''){
        $('.work_score').html('全部评分');
    }

    if('<?php echo ($lids); ?>' == 'NO_LABEL'){
        $('.workTag').html('没有标签');
    }

    if('<?php echo ($lids); ?>' == ''){
        $('.workTag').html('全部标签');
    }

$(function(){
	$('#daterange-btn').daterangepicker(
        {
          ranges: {
            '今天': [moment(), moment()],
            '昨天': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '前七天': [moment().subtract(6, 'days'), moment()],
            '前三十天': [moment().subtract(29, 'days'), moment()],
            '这个月': [moment().startOf('month'), moment().endOf('month')],
            '上个月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
          
        },
        function (start, end) {
          $('#daterange-btn').html(start.format('yyyy/MM/dd') + ' - ' + end.format('yyyy/MM/dd'));
        }
   );
});


/**
 * 刷新作品标签
 */
function refreshBookLabel(bid,clos){

    var _url = '<?php echo (C("QS_BASE_PATH")); ?>/Book/refreshBookLabel';
    var param = {
        'bid': bid
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
                html +='<li class="tag light_blue f12 tag_hover re">';
                html += item.lname+'<div class="manager ab" style="display: none;">';
                html +='<span>';
                html +=item.username+'&nbsp;</span>';
                html +='<div class="sign ab"></div>';

                html +='</div>';
                html +='</li>  ';
                cnt++;
            });

            if(cnt==0){
                html ='<li class="f12 mb-11 c2">无标签</li>';
            }

            html +='<li class="tag a0 f12 c2 addtag">添加标签</li>';

            $("#bookLabelUL_"+bid).empty();
            $("#bookLabelUL_"+bid).append(html); 
			addtagObj.addtagDome(bid);
        }
    });

}

/**
 * 刷新作品评分
 */
function refreshBookScore(bid,clos){

    var _url = '<?php echo (C("QS_BASE_PATH")); ?>/Book/refreshBookScore';
    var param = {
        'bid': bid
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
                html +='<div class="progress-bar purple" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '+par+'%;">';
                html +='</div>';
                html +='</div>';
                html +='<span class="f18 pull-left ml-20">'+item.score+'</span>';
                html +='</li>';
                cnt++;
            });

            if(cnt==0){
                html ='<li class="f12 mb-11 c2">尚未评分</li>';
            }

            html +=' <li><a href="javaScript:void(0);" class="a0 details c-l add_score ml-230">评分</a></li>';

            $("#bookScoreUL_"+bid).empty();
            $("#bookScoreUL_"+bid).append(html);
            addtagObj.addScoreDom(bid);
        }
    });

}


    /**
 *
 * 显示作品被打标签和所有标签
 * @param id 作品ID
 **/    
    
 function getBookLabel(id) {

    getBookType(id);

	var _url = '<?php echo (C("QS_BASE_PATH")); ?>/Book/getBookLabel';
	var param = {
		'id': id
	};
	$.ajax({
		method: "POST",
		url: _url,
		data: param,
		dataType: 'json',
        async: false,
		success: function(data) {
			var html = "";
			$.each(data.bookLabel, function(i, item) {
				html += '<li style="display:inline">';
				html += '<label class="tag light_blue f12 mb-11 mr-10">' + i + '</label>';
				$.each(item, function(k, item2) {
					html += '<span class="mr-20">' + item2 + '</span>';
				});
				html += '</li>';
			});
			html += '<div class="clear"></div>';
			html += '<span class="span_title">选择标签</span>';
			html += '<div class="clear"></div>';
			
			$.each(data.allLabel, function(i, item) {

                if(item.selected == 1){
                    html += ' <button type="btn" class="tag light_blue f12 mr-10 mb-11" onclick="cancelLabel(' + item.id + ',' + id + ')">' + item.name + '</button>';
                }else{
                    html += '<button type="btn" class="btn_style tag_btn tag_btn1 mb-10" onclick="labelBook(' + item.id + ',' + id + ')">' + item.name + '</button>';
                }

			});

			$("#bookLabel_"+id).empty();
			$("#bookLabel_"+id).append(html);
			$("#labelUL_"+id).empty();
			$("#labelUL_"+id).append(html);
		}
	});
}


    /**
     *
     * 显示作品被打标签和所有标签
     * @param id 作品ID
     **/

    function getBookType(id) {

        var bookTypeId = 0;
        var _url = '<?php echo (C("QS_BASE_PATH")); ?>/Book/getBookById';
        var param = {
            'id': id
        };

        $.ajax({
            method: "POST",
            url: _url,
            data: param,
            async: false,
            dataType: 'json',
            success: function(data) {
                bookTypeId = data.type;
            }
        });



        var _url = '<?php echo (C("QS_BASE_PATH")); ?>/Book/getBookType';
        var param = {
            'id': id
        };


        $.ajax({
            method: "POST",
            url: _url,
            data: param,
            async: false,
            dataType: 'json',
            success: function(data) {

                var html = "";

                html += '<div class="clear"></div>';
                html += '<span class="span_title">选择类别</span>';
                html += '<div class="clear"></div>';
                var html2= "";
                $.each(data, function(i, item) {

                    if(item.id == bookTypeId){
                        html += ' <button type="btn" class="tag light_blue f12 mr-10 mb-11" onclick="setBookType(' + item.id + ',' + id + ')">' + item.name + '</button>';
                    }else{
                        html += '<button type="btn" class="btn_style tag_btn tag_btn1 mb-10" onclick="setBookType(' + item.id + ',' + id + ')">' + item.name + '</button>';
                    }

                });


                $("#bookTypeLi_"+id).empty();
                $("#bookTypeLi_"+id).append(html );
                $("#bookTypeLi_"+id).append("<hr>");
            }
        });
    }

    function setBookType(typeId,bid){
        var _url = '<?php echo (C("QS_BASE_PATH")); ?>/Book/setBookType';
        var param = {
            'id': bid,
            'type': typeId
        };


        $.ajax({
            method: "POST",
            url: _url,
            data: param,
            async: false,
            dataType: 'json',
            success: function(data) {
                if(data == true){
                    alert("选择作品分类成功！");
                    getBookType(bid);
                }

            }
        });
    }

    /**
 * 给作品取消打标签
 * @param uid 用户ID
 * @param lid 标签ID
 */
function cancelLabel(lid, bid) {
    var _url = '<?php echo (C("QS_BASE_PATH")); ?>/Book/cancelLabel';
    var param = {
        'bid': bid,
        'lid': lid
    };

//    if(window.confirm("你确定要取消吗？")){
        $.ajax({
            method: "POST",
            url: _url,
            data: param,
            dataType: 'json',
            success: function(data) {
                if(data > 0) {
                    alert("取消成功");
                    getBookLabel(bid);
                } else {
                    alert("取消失败！");
                }
            }
        });
//    }
}
/**
 * 给作品打标签
 * @param bid 作品ID
 * @param lid 标签ID
 */
function labelBook(lid, bid) {
	var _url = '<?php echo (C("QS_BASE_PATH")); ?>/Book/labelBook';
	var param = {
		'lid': lid,
		'bid': bid
	};

//    if(window.confirm("你确定要打该标签吗？")) {
        $.ajax({
            method: "POST",
            url: _url,
            data: param,
            dataType: 'json',
            success: function (data) {
                if (data == -1) {
                    alert("您已经对该作品打过该标签！");
                } else {
                    alert("打标签成功");
                    getBookLabel(bid);
                    refreshBookLabel(bid);
                }
            }
        });
//    }
}


/**
 * 修改作品名称
 */
function editBookName(com) {
    var _url = '<?php echo (C("QS_BASE_PATH")); ?>/Book/editBookName';

    var bid=$(com).attr("bid");
    var bookName = $("#bookName_"+bid).val();

    var param = {
        'bid': bid,
        'bookName': bookName
    };

    var flag=0;
    if(window.confirm("你确定要修改吗？")){

        $.ajax({
            method: "POST",
            sync:false,
            url: _url,
            data: param,
            dataType: 'json',
            success: function(data) {
                flag=data;
                if(flag==1){
                    alert("修改成功！");
                    var vl=$(".author_name").children("input").val();
                    $(com).text("修改书名").siblings(".author_name").html(vl);
                }else{
                    alert("修改失败！");
                }
            }
        });

    }
}



/**
 *
 * 显示作品评分
 * @param uid 用户ID
 * @param id  作品ID
 **/
function getBookScore(id) {
	var _url = '<?php echo (C("QS_BASE_PATH")); ?>/Book/getBookScore';
	var param = {
		'id': id
	};
	$.ajax({
		method: "POST",
		url: _url,
		data: param,
		dataType: 'json',
		success: function(data) {
			var html = "";
			$.each(data, function(userName, item) {

				if('<?php echo ($_SESSION["LOGIN_USER"]["Profile"]["name"]); ?>' != userName && $.trim(userName)!="") {

					html += '<div class="score">';
					html += '<p class="f14 c2">' + userName + '的评分</p>';
					html += '<ul class="progress_score">';

					$.each(item, function(key, item2) {
						html += '<li>';
						html += '<span class="pull-left w60 f12">' + item2.labelname + '</span>';
						html += '<div class="progress progress_style">';
                        var width = (item2.score/5)*100;
						html += '<div class="progress-bar purple" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: ' + width + '%;"></div>';
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
                        var width = (item2.score/5)*100;
						html += '<div class="progress-bar purple" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: ' + width + '%;"></div>';
						html += '</div>';
						html += '<div class="score1">';
						html += '<input id="s_' + id + '_' + item2.lid + '"   type="number"  min="1" max="5"   class="f18 pull-right myscore" value="' + item2.score + '" onblur="scoreBook(this)" />';
						html += '</div>';
						html += '</li>';
					});
					html += '</ul>';
					html += '</div>';
					html +='<div class="clear"></div>';
				}
			});

			$("#getBookScore_"+id).empty();
			$("#getBookScore_"+id).append(html);
		}
	});
}

/**
 * 给作品打分
 * @param item
 */
function scoreBook(item) {

	var id = item.id;
	var ary = item.id.split("_");
	var bid = ary[1];
	var lid = ary[2];
	var score = item.value;

	if(score > 5) {
		alert("请输入不大于5的数字");
		item.focus();
		return;
	}

	var _url = '<?php echo (C("QS_BASE_PATH")); ?>/Book/scoreBook';
	var param = {
		'bid': bid,
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
				getBookScore(bid);
				refreshBookScore(bid);
			} else {
				alert("打分失败");
			}
		}
	});
}
/**
 * 获取购买记录
 * @param id
 */
function getBookBuy(id) {
	var _url = '<?php echo (C("QS_BASE_PATH")); ?>/Book/getBookBuy';
	var param = {
		'id': id,
	};
	$.ajax({
		method: "POST",
		url: _url,
		data: param,
		dataType: 'json',
		success: function(data) {
			var html = "";
			 
			html += '<div class="clear"></div>';
			html += '<div class="f14 c2">作品收益 <b>'+data.amt+'</b></div>';
			 
			html += '<div class="box-body">'
			html += '<table id="example" class="table table-bordered">';
		    html += '<thead>';            
		    html += '<tr>';            
		    html += ' <th class="col-md-2">时间</th>';             
		    html += ' <th>购买者</th>';             
		    html += ' <th>金额</th>';             
		    html += '</tr>';            
		    html += ' </thead>';           
		    html += '<tbody>';
            var flag = true;
			$.each(data.buyHistory, function(i, item) {
				      
			    html += ' <tr>';           
			    html += ' <td>'+item.pay_time+'</td>';
			    html += '<td class="c3"><a target="_blank" href="<?php echo (C("QS_BASE_PATH")); ?>/User/listUser/uid/'+item.uid+'">'+item.name+'</a></td>';
			    html += ' <td>'+item.money+'</td>';             
			    html += '</tr>';
                flag = false;
			});

            if(flag){
                html += ' <tr>';
                html += '<td colspan="3" >未查询到相关记录</td>';
                html += '</tr>';
            }

			html += '</tbody>';            
		    html += '</table>'; 
		    html += '</div>';
			$("#bookBuy_"+id).empty();
			$("#bookBuy_"+id).append(html);	
		}
	});
}

$("#aGoPage").change(function(){
    var pageNum = $("#aGoPage option:selected").text();
    $('#gotoPage').val(pageNum);
    doSearch();
});
/**
 * 搜索
 */
function doSearch(){
    $("#bookForm").submit();
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

/**
 * 选择标签页
 * @param lid
 */
function setLabel(lid){
    $('#lids').val(lid);
    doSearch();
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
 * @param lid
 * @param score
 */
function setScore(lid,score){
    $('#gotoPage').val(1);
    $('#scoreIds').val(lid+"_"+score);
    doSearch();
}


/**
 * 选择有评分
 */
function allScore(){
    $('#gotoPage').val(1);
    $('#scoreIds').val("");
    doSearch();
}
/**
 * 没评分
 */
function noScore(){
    $('#gotoPage').val(1);
    $('#scoreIds').val("NO_SCORE");
    doSearch();
}

/**
 * 跳转页
 */
function gotoPage(pageNum){
    $('#gotoPage').val(pageNum);
    doSearch();
}
    
</script>
<script>
//	$(function(){
//		//作者昵称筛选事件
//		$('.inputTag').keyup(function(){
//            $('#tagNsd').empty();
//
//			var _url = "<?php echo (C("QS_BASE_PATH")); ?>/Book/getUserByName";
//			var nick_name = $('.inputTag').val();
//			$.ajax({
//				type:"post",
//				url:_url,
//				data:{
//					nick_name:nick_name
//				},
//				dataType:"JSON",
//				success:function(data){
//					console.log(data)
//                    $.each(data, function(i, item) {
//						var html="";
//						html+="<span class='tag_btn m10 nickName'  id='"+item.id+"' nickName='"+item.nick_name+"'>"+item.nick_name+"</span>";
//						$('#tagNsd').append(html);
//						$('.nickName').click(function(){
//							var nik = $(this).text();
//							var id = $(this).attr('id');
//							$('input.inputTag').val(nik);
//							$('#uid').val(id);
//							doSearch();
//						})
//					});
//				}
//			});
//		})
//
//
//	})
</script>
</body>
</html>