<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>巧书后台基础数据</title>
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

        <!-- 主要内容 begin-->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <br>
                        <!-- /.box-header -->
                        <?php if($type == 8): ?><ul class="top_list" id="top_list">
                                    <li <?php if($status == 1): ?>class="tag_border"<?php endif; ?> ><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/8/status/1">正在使用</li>
                                    <li <?php if($status == 0): ?>class="tag_border"<?php endif; ?> ><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/8/status/0">已下架</a></li>
                            </ul><?php endif; ?>

                        <?php if($type == 10): ?><ul class="top_list" id="top_list">
                                <li <?php if($status == 1): ?>class="tag_border"<?php endif; ?> ><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/10/status/1/showMenu/ADMIN_BANNER">正在使用</li>
                                <li <?php if($status == 0): ?>class="tag_border"<?php endif; ?> ><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/listType/type/10/status/0/showMenu/ADMIN_BANNER">未启用</a></li>
                            </ul><?php endif; ?>

                        <div class="box-body">
                            <?php if($type == 1): ?>书籍分类<?php endif; ?>
                            <?php if($type == 2): ?>作品标签<?php endif; ?>
                            <?php if($type == 3): ?>作者评分标准<?php endif; ?>
                            <?php if($type == 4): ?>作品评分标准<?php endif; ?>
                            <?php if($type == 5): ?>国家<?php endif; ?>
                            <?php if($type == 6): ?>省份<?php endif; ?>
                            <?php if($type == 7): ?>城市<?php endif; ?>
                            <?php if($type == 8): ?>首页banner<?php endif; ?>
                            <?php if($type == 9): ?>作者标签<?php endif; ?>
                            <?php if($type == 10): ?>推荐作品<?php endif; ?>

                            <table id="example2" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>序号</th>
                                    <th><?php if($type == 1): ?>书籍分类名称<?php endif; ?>
                                        <?php if($type == 2): ?>作品标签名称<?php endif; ?>
                                        <?php if($type == 3): ?>作者评分标准名称<?php endif; ?>
                                        <?php if($type == 4): ?>作品评分标准名称<?php endif; ?>
                                        <?php if($type == 5): ?>国家<?php endif; ?>
                                        <?php if($type == 6): ?>省份<?php endif; ?>
                                        <?php if($type == 7): ?>城市<?php endif; ?>
                                        <?php if($type == 8): ?>首页banner<?php endif; ?>
                                        <?php if($type == 9): ?>作者标签<?php endif; ?>
                                        <?php if($type == 10): ?>作品ID+名称<?php endif; ?></th>
                                    <th>排序</th>
                                    <th>备注</th>
                                    <?php if($type == 8): ?><th>显示位置</th><?php endif; ?>

                                    <th>状态</th>
                                    <th width="180">操作&nbsp;<a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/entry/type/<?php echo ($type); ?>" class="a0 btn_style btn1">添加</a></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($dataList)): $i = 0; $__LIST__ = $dataList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                                        <td><?php echo ($key+1); ?></td>

                                        <?php if($type == 10): ?><td><a href="http://www.qiaobooks.com/read/<?php echo ($data["url"]); ?>" target="_blank"><?php echo ($data["url"]); ?>.<?php echo ($data["name"]); ?></a></td><?php endif; ?></th>
                                        <?php if($type != 10): ?><td><?php echo ($data["name"]); ?></td><?php endif; ?></th>

                                        <td><?php echo ($data["sort_num"]); ?></td>
                                        <td><?php echo ($data["remark"]); ?></td>

                                        <?php if($type == 8): ?><td>
                                                <?php if($data['mobile_or_pc'] == 0): ?>PC<?php endif; ?>
                                                <?php if($data['mobile_or_pc'] == 1): ?>H5<?php endif; ?>
                                                <?php if($data['mobile_or_pc'] == 2): ?>全部<?php endif; ?>
                                            </td><?php endif; ?>


                                        <td>
                                            <?php if($type == 10): if($data['status'] == 1): ?>正在使用<?php else: ?>未启用<?php endif; ?>
                                             <?php else: ?>
                                                <?php if($data['status'] == 0): ?>无效<?php else: ?>有效<?php endif; endif; ?>


                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <?php if($data['status'] == 1): ?><a href="<?php echo (C("QS_BASE_PATH")); ?>/TypeList/entry/id/<?php echo ($data["id"]); ?>" class="a0 edit">编辑</a>&nbsp;<?php endif; ?>
                                                <?php if($data['status'] == 0): ?><a href="#"  class="a0 forbid" onclick="if(window.confirm('你确定要启用吗？')){window.location.href='<?php echo (C("QS_BASE_PATH")); ?>/TypeList/del/id/<?php echo ($data["id"]); ?>/status/1' }">启用</a>
                                                    <?php else: ?>
                                                    <a href="#"  class="a0 forbid"  onclick="if(window.confirm('你确定要禁用吗？')){window.location.href='<?php echo (C("QS_BASE_PATH")); ?>/TypeList/del/id/<?php echo ($data["id"]); ?>status/0' }">禁用</a><?php endif; ?>

                                            </div>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>
        <!-- 主要内容 end -->
    </div>

    <!--底部文字-->
    <!--<footer class="main-footer">
      <div class="pull-right hidden-xs">

      </div>

    </footer>
    -->


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