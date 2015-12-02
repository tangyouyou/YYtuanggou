<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPEhtmlPUBLIC"-//W3C//DTDXHTML1.0Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" href="__PUBLIC__/Css/login.css" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<script type="text/javascript" src="__ROOT__/Public/jQuery/jquery-1.11.3.js"></script>
		<script type="text/javascript" src="__PUBLIC__/Js/login.js"></script>
		<script type="text/javascript">
		function changeCode(){
	    	var src = '<?php echo U(GROUP_NAME . '/Login/showCode');?>/'+Math.random();
	    	$(this).attr('src',src);
        }
        var URL = '<?php echo U(GROUP_NAME. "/Login/showCode");?>/';
		</script>
	</head>
	<body>
		<div id="top">

		</div>
		<div class="login">	
			<form action="<?php echo U(GROUP_NAME . '/Login/login');?>" method="post" id="formLogin">
			<div class="title">
				悠悠团购网 | 登录后台
			</div>
				<table border="1" width="100%">
					<tr>
						<th>管理员帐号:</th>
						<td>
							<input type="username" name="username" class="len250"/>
						</td>
					</tr>
					<tr>
						<th>密码:</th>
						<td>
							<input type="password" class="len250" name="password"/>
						</td>
					</tr>				
					<tr>
						<th>验证码:</th>
						<td>
							<input type="code" class="len250" name="code"  url="<?php echo U(GROUP_NAME .'/Login/check');?>" id="inputCode" > <img onclick="changeCode.call(this);" src="<?php echo U(GROUP_NAME . '/Login/showCode');?>" id="code" /> 
						</td>
					</tr>
	                    
					<tr>
						<td colspan="2" style="padding-left:160px;"> <input type="submit" class="submit" value="登录"/></td>
					</tr>
				</table>
		</form>
	</div>
	</body>
	<script>
        $('#loginForm').submit(function(){
		var code = $('#inputCode').val();
		var url = $('#inputCode').attr('url');
		$.ajax({
			url:url,
			type:'post',
			dataType:'json',
			data:'code='+code,
			success:function(result){
				if(result.status === true){
					$('#loginForm')[0].submit();
				}else{
					alert('验证码输入有误!');
				}
			}
		})
		return false;
	})    	
	</script>
</html>