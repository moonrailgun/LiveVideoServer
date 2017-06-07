<{include file = "simple_header.tpl"}>
  <body class="simple_body">
  <!--<![endif]-->

    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">

                </ul>
                <a class="brand" href="<{$smarty.const.ADMIN_URL}>/index.php"><span class="first"></span> <span class="second"><{$smarty.const.COMPANY_NAME}></span></a>
        </div>
    </div>
<div>
<div class="container-fluid">
    <div class="row-fluid">

    <div class="dialog">
		<{$osadmin_action_alert}>
        <div class="block">
            <p class="block-heading">忘记密码</p>
            <div class="block-body">
                <form name="loginForm" method="post" action="">
                    <label>用户名</label>
                    <input type="text" class="span12" name="user_name" value="<{$_POST.user_name}>" required="true" autofocus="true">
                    <label>邮箱</label>
                    <input type="text" class="span12" name="user_email" value = "<{$_POST.user_email}>" required="true" >

                     <label>验证码</label>
					<input type="text" name="verify_code" class="span4" placeholder="输入验证码" autocomplete="off" required="required">
					<a href="#"><img title="验证码" id="verify_code" src="<{$smarty.const.ADMIN_URL}>/panel/verify_code_cn.php" style="vertical-align:top"></a>
          <div class="clearfix">
					<input type="submit" class="btn btn-primary pull-right" name="loginSubmit" value="联系管理员"/>
          <a href="<{$smarty.const.ADMIN_URL}>/panel/forget_password.php" class="btn btn-primary pull-right" style="margin:0 2px;">密码发送</a></div>
          </div>

                </form>
            </div>
        </div>
        <p class="pull-right" style=""><a href="http://osadmin.org" target="blank"></a></p>
    </div>
<script type="text/javascript">
$("#verify_code").click(function(){
	var d = new Date()
	var hour = d.getHours();
	var minute = d.getMinutes();
	var sec = d.getSeconds();
    $(this).attr("src","<{$smarty.const.ADMIN_URL}>/panel/verify_code_cn.php?"+hour+minute+sec);
});
</script>

<{include file = "footer.tpl"}>
