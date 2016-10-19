<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>巧书后台登陆</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/Public/css/bootstrap.css">
  <link rel="stylesheet" href="/Publiccss/font-awesome.min.css">
  <link rel="stylesheet" href="/Public/css/ionicons.min.css">
  <link rel="stylesheet" href="/Public/css/AdminLTE.css">
  <link rel="stylesheet" href="/Public/css/login.css">
  <link rel="stylesheet" href="/Public/css/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
   	<img src="/Public/img/qiaobooks_logo.png" class="logo_img"/>
   	<img src="/Public/img/logo_text.png" class="logo_text"/>
  </div>
  
  <!-- /.login-logo -->
  <div class="login-box-body login_border">
  	<p class="login-box-msg wel-color">“欢迎使用<b>巧书管理后台”</b></p>
      <form method="post" action="<?php echo (C("QS_BASE_PATH")); ?>/Login/loginAction">
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="输入手机号码" name="mobile" value="<?php echo ($mobile); ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="输入登录密码" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <!--<label>-->
              <!--<input type="checkbox" class="checks">&nbsp;&nbsp;&nbsp;&nbsp;记住我-->
            <!--</label>-->
              <label><?php echo ($_SESSION["err_msg"]); ?></label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="login-btn" value="">登录</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
</div>
<script src="/Public/js/jQuery-2.2.0.min.js"></script>
<script src="/Public/js/bootstrap.js"></script>
<script src="/Public/js/icheck.js"></script>
<script>
$(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
	    radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
});
</script>
</body>
</html>