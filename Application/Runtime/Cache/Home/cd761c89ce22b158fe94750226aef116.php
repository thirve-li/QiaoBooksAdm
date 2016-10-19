<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>巧书后台提现申请</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/Public/css/bootstrap.css">
    <link rel="stylesheet" href="/Public/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/css/ionicons.min.css">
    <link rel="stylesheet" href="/Public/css/AdminLTE.css">
    <link rel="stylesheet" href="/Public/css/_all-skins.css">
    <link rel="stylesheet" href="/Public/css/base.css">
</head>
<script>
    function setPrice(v){
        $("#optType").val(v);
        $("#applyForm").submit();
    }
</script>
<body class="hold-transition skin-blue sidebar-mini" >
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

        <!-- 内容顶部模板 topSection.html 开始-->
        <!-- 内容顶部 begin-->
<section class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo (C("QS_BASE_PATH")); ?>/Index/index"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active"><a href="<?php echo (C("QS_BASE_PATH")); ?>/Index/index">后台首页</a></li>
    </ol>
</section>
<!-- 内容顶部 end -->
        <!-- 内容顶部模板 topSection.html 结束-->

        <!-- 主要内容 -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box pl-20 pt-20">
                        <form id="applyForm" class="form-horizontal" role="form" action="<?php echo (C("QS_BASE_PATH")); ?>/UserPay/save" method="post">

                            <input type="hidden" name="id" value="<?php echo ($payHistory['id']); ?>" />
                            <input type="hidden" name="optType" id="optType" value="<?php echo ($payHistory['status']); ?>" />

                            <div class="form-group">
                                <label class="col-sm-1 control-label text-left">巧书用户名</label>
                                <div class="col-sm-4">
                                    <?php echo ($payHistory['name']); ?>
                                    <!--<input type="text" name="receive_account" id="receive_account" required="required" value="<?php echo ($payHistory['receive_account']); ?>" >-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label text-left">提现金额</label>
                                <div class="col-sm-4">
                                    <!--<input type="text" name="money" id="money" required="required" value="<?php echo ($payHistory['money']); ?>" >-->
                                    <?php echo ($payHistory['money']); ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-1 control-label text-left">支付宝账号</label>
                                <div class="col-sm-4">
                                    <?php echo ($payHistory['receive_account']); ?>
                                    <!--<input type="text" name="receive_account" id="receive_account" required="required" value="<?php echo ($payHistory['receive_account']); ?>" >-->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label text-left">收款人姓名</label>
                                <div class="col-sm-4">
                                    <?php echo ($payHistory['name']); ?>
                                    <!--<input type="text" name="name" id="name" required="required" value="<?php echo ($payHistory['name']); ?>" >-->
                                </div>
                            </div>


                            <!--<div class="form-group">-->
                                <!--<label class="col-sm-1 control-label text-left">账户说明</label>-->
                                <!--<div class="col-sm-4">-->
                                    <!--<?php echo ($payHistory['account_desc']); ?>-->
                                    <!--&lt;!&ndash;<input type="text" name="account_desc" id="account_desc" required="required" value="<?php echo ($payHistory['account_desc']); ?>" >&ndash;&gt;-->
                                <!--</div>-->
                            <!--</div>-->

                            <div class="form-group">
                                <label class="col-sm-1 control-label text-left">申请时间</label>
                                <div class="col-sm-4">
                                    <?php echo ($payHistory['apply_date']); ?>
                                    <!--<input type="text" name="apply_reason" id="apply_reason" required="required" value="<?php echo ($payHistory['apply_reason']); ?>" >-->
                                </div>
                            </div>


                            <?php if(!empty($payHistory['id'])): ?><div class="form-group">
                                    <label class="col-sm-1 control-label text-left">付款账号</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="pay_account" id="pay_account" required="required" value="<?php echo ($payHistory['pay_account']); ?>" >
                                    </div>
                                </div>

                                <!--<div class="form-group">-->
                                    <!--<label class="col-sm-1 control-label text-left">支付方式</label>-->
                                    <!--<div class="col-sm-4">-->
                                        <!--<select name="pay_type"  >-->
                                            <!--<option value="" <?php if($payHistory['pay_type'] == '' ): ?>selected<?php endif; ?>>未知</option>-->
                                            <!--<option value="0" <?php if($payHistory['pay_type'] == 0): ?>selected<?php endif; ?>>支付宝</option>-->
                                            <!--<option value="1" <?php if($$payHistory['pay_type'] == 1): ?>selected<?php endif; ?>>微信</option>-->
                                        <!--</select>-->
                                    <!--</div>-->
                                <!--</div>-->

                                <div class="form-group">
                                    <label class="col-sm-1 control-label text-left">交易流水号</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="transaction_no" id="transaction_no" required="required" value="<?php echo ($payHistory['transaction_no']); ?>" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label text-left">付款人</label>
                                    <div class="col-sm-4"><?php echo ($payHistory['approver_name']); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label text-left">付款时间</label>
                                    <div class="col-sm-4"><?php echo ($payHistory['pay_time']); ?></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label text-left">原因</label>
                                    <div class="col-sm-4">
                                        <textarea rows="3" cols="40" name="opt_reason"><?php echo ($payHistory['opt_reason']); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label text-left">状态</label>
                                    <div class="col-sm-4">
                                        <?php if($payHistory['status'] == 0): ?>已申请<?php endif; ?></option>
                                        <?php if($payHistory['status'] == 1): ?>已付款<?php endif; ?></option>
                                        <?php if($payHistory['status'] == 2): ?>已拒绝<?php endif; ?></option>
                                    </div>
                                </div><?php endif; ?>

                            <div class="form-group">
                                <div class="col-sm-5 text-right">
                                    <div class="btn-group m20 mb-20">
                                        <?php if($payHistory['status']==0): ?><button id="btnApprove" type="button" onclick="setPrice(1)"  class="btn_style btn1">同 意</button>
                                            <button id="btnReject" type="button" onclick="setPrice(2)" class="btn_style btn1">拒 绝</button><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
        
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
<script src="/Public/js/jquery.slimscroll.js"></script>

</body>
</html>