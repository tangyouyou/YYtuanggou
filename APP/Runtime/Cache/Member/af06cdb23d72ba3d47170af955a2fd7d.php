<?php if (!defined('THINK_PATH')) exit();?>﻿﻿
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="__ROOT__/Public/Css/reset.css" type="text/css" rel="stylesheet" >
<link href="__ROOT__/Public/Css/common.css" type="text/css" rel="stylesheet" >
<script type='text/javascript' src="__ROOT__/Public/jQuery/jquery-1.11.3.js"></script>
<script type="text/javascript" src="__ROOT__/Public/Js/common.js"></script>
<meta name="keywords" content="" />
<meta name="description" content="" />
<title>悠悠团购网</title>

</head>
<body>
	<!-- 顶部开始 -->
	<div id="top">
		<div class='position'>
			<div class='left'>
				逢剧必死唐悠悠出品！
			</div>
			<div class='right'>
				<a href="javascript:addFavorite2();">收藏</a>
			</div>
		</div>
	</div>
	<!-- 顶部结束 -->
	<!-- 头部开始 -->
	<div id="header">
		<div class='position'>
			<div class='logo'>
				<a style="line-height:60px;" href="<?php echo U(Index .'/Index/index');?>">悠悠团购网</a>
				<a style="font-size:16px;" href="<?php echo U(Index .'/Index/index');?>">www.yytuangou.com</a>
			</div>
			<div class='search'>
					<div class='item'>
						<a href="<?php echo U('Index/Index/index');?>/keywords/标间">标间</a>
						<a href="<?php echo U('Index/Index/index');?>/keywords/KTV">KTV</a>
						<a href="<?php echo U('Index/Index/index');?>/keywords/电影">电影</a>
						<a href="<?php echo U('Index/Index/index');?>/keywords/WIFI">WIFI</a>
					</div>
					<div class='search-bar'>
					   <form action="<?php echo U('Index/Index/index');?>" method="get">				  
							<input class='s-text' id="abc" type="text" name="keywords" value="请输入商品名称，地址等">
							<input class='s-submit' type="submit" value='搜索'>
						</form>
					</div>			
			</div>
			<div class='commitment'>
				
			</div>
		</div>
	</div>
	<!-- 头部结束 -->
	<!-- 导航开始-->
	<div id="nav">
		<div class='position'>
			<!-- 分类相关 -->
			<div class='category'>
			       <a  category="0" href="<?php echo U('Index/Index/index');?>">首页</a>
				<?php if(is_array($nav)): foreach($nav as $k=>$v): ?><a category="<?php echo ($k+1); ?>" href="<?php echo U('Index/Index/index');?>/cid/<?php echo ($v["cid"]); ?>"><?php echo ($v["cname"]); ?></a><?php endforeach; endif; ?>
			</div>
		
			<!-- 用户相关 -->
			<div id="user-relevance" class='user-relevance'>
				    <?php if($userIsLogin): ?><div class='user-nav login-reg'>
							<a class='title' href="<?php echo U(Member. '/Login/logout');?>">退出</a>
						  </div>
						  <!--我的团购 -->	
						  <div class='user-nav my-hdtg '>
							<a class='title' href="<?php echo U('Member/Order/index');?>">我的团购</a>
							<ul class="menu">
								<li class='active'>
				                    <a href="<?php echo U('Member/Order/index');?>">团购订单</a>
								</li>
								<li>
									<a href="<?php echo U('Member/Index/collect');?>">我的收藏</a>
								</li>
								<li>
									<a href="<?php echo U('Member/Account/index');?>">美团余额</a>
								</li>
								<li>
									<a href="<?php echo U('Member/Account/setting');?>">账户设置</a>
								</li>
							</ul>
						 </div>
				    <?php else: ?>
						  <!--登录注册-->
						 <div class='user-nav login-reg'>
								<a class='title' target="_blank" href="<?php echo U(Member .'/Reg/index');?>">注册</a>
						 </div>
						 <div class='user-nav login-reg'>	
								<a class='title' target="_blank" href="<?php echo U(Member.'/Login/index');?>">登录</a>
						 </div><?php endif; ?>

				<!-- 最近浏览 -->	
					<div  class='user-nav recent-view ' url="<?php echo U('Member/Index/getRecentView');?>" goodUrl="<?php echo U('Index/Detail/index');?>" clearView="<?php echo U('Member/Index/clearRecentView');?>"}>
						<a class='title' href="">最近浏览</a>
						<ul class="menu">					
							
						</ul>
					</div>
					<!-- 购物车 -->
					<div  class='user-nav my-cart ' id="my-cart" url="<?php echo U(Member .'/Cart/index');?>" goodUrl ="<?php echo U(Index.'/Index/index');?>" delCartUrl ="<?php echo U(Member .'/Cart/del');?>">
						<a class='title' href="<?php echo U(Member.'/Cart/index');?>" target="_blank"><i>&nbsp;</i>购物车</a>
						<ul class="menu">
							<p>正在加载..</p>
						</ul>
					</div>
			</div>
		</div>
	</div> 
	<!-- 导航结束 -->
	<!-- 载入公共头部文件-->
<link href="__PUBLIC__/Css/userhome.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" src="__PUBLIC__/Js/userhome.js"></script>	
<div id="main">
	<div class='left'>
		<ul class='userhome-nav'>
			<li class='active'>
				<a href="<?php echo U('Member/Order/index');?>">团购订单</a>
			</li>
			<li>
				<a href="<?php echo U('Member/Index/collect');?>">我的收藏</a>
			</li>
			<li>
				<a href="<?php echo U('Member/Account/index');?>">美团余额</a>
			</li>
			<li>
				<a href="<?php echo U('Member/Account/setting');?>">账户设置</a>
			</li>
		</ul>
		<div id="content">
		<link href="__PUBLIC__/Css/account.css" type="text/css" rel="stylesheet" >
		<div class='setting-nav'>
			<a  href="<?php echo U('Member/Account/setting');?>">基本信息</a>
			<a class='active'href="<?php echo U('Member/Account/setAddress');?>">收货地址</a>
		</div>
		<div class='address-list'>
			<table>
				<thead>
					<tr>
						<th width="20%">收货人</th>
						<th>地址/邮编</th>
						<th width="20%">电话/手机</th>
						<th width="20%">操作</th>
					</tr>
				</thead>
				<tbody>
				    <?php if(is_array($address)): foreach($address as $key=>$v): ?><tr>
							<td>
								<?php echo ($v["username"]); ?>
							</td>
							<td>
								<?php echo ($v["province"]); ?>-<?php echo ($v["city"]); ?>-<?php echo ($v["county"]); ?>-<?php echo ($v["street"]); ?>
							</td>
							<td>
								<?php echo ($v["phone"]); ?>
							</td>
							<td>
								<a href="<?php echo U('Member/Account/delAddredss');?>/addressid/<?php echo ($v["addressid"]); ?>">删除</a>
							</td>
						</tr><?php endforeach; endif; ?>				
				</tbody>
			</table>	
		</div>
		<!-- 收货地址 -->
		<div id="addressForm" class="address">
		   <form action="<?php echo U('Member/Account/addAddress');?>" method="post">
				<div class='address-base'>
					<dl>
						<dt>*省市区：</dt>
						<dd style="width:400px;">
							<select id="s_province" name="s_province"></select>
							<select id="s_city" name="s_city" ></select>
							<select id="s_county" name="s_county"></select>
							<script type="text/javascript" src="__ROOT__/Public/Js/area.js"></script>
							<script type="text/javascript">_init_area();</script>
						</dd>
					</dl>
					<dl>
						<dt>*街道地址：</dt>
						<dd style="width:450px;">
							<input name="street" type="text" value="">
						</dd>
					</dl>
					<dl>
						<dt>*邮政编码：</dt>
						<dd>
							<input name="zipcode" type="text" value="">
						</dd>
					</dl>
					<dl>
						<dt>*收货人姓名：</dt>
						<dd>
							<input name="username" type="text" value="">
						</dd>
					</dl>
					<dl>
						<dt>*电话号码：</dt>
						<dd>
							<input name="phone" type="text" value=""> 
						</dd>
					</dl>
					<dl>
						<dt></dt>
						<dd>
							<input type="submit" value="提交">
						</dd>
					</dl>
				</div>
			</form>
		</div>	
			</div>
		</div>
		<div class='user-status'>
			<h6><span>Hi~</span>_qqcd71349674843</h6>
			<p><span>等级：<span><i></i></p>
			<p><span>积分：<span><strong>0</strong></p>
		</div>
	</div>
</body>
</html>