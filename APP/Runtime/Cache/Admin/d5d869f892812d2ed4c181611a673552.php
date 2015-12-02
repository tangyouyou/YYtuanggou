<?php if (!defined('THINK_PATH')) exit();?>﻿
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="__ROOT__/Public/Css/base.css" type="text/css" rel="stylesheet">
<link href="__ROOT__/Public/Css/index.css" type="text/css" rel="stylesheet">
<link href="__ROOT__/Public/Css/reset.css" type="text/css" rel="stylesheet">
<script type='text/javascript' src="__ROOT__/Public/jQuery/jquery.js"></script>
<script	type="text/javascript" src="__ROOT__/Public/Js/index.js"></script>
<script	type="text/javascript" src="__ROOT__/Public/bootstrap/js/bootstrap.js"></script>
<link href="__ROOT__/Public/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">

<base target="showContent" />
<title>悠悠团购后台</title>

</head>
<body >

<div id="header">
	<div class='hd-box'>
		<div class='hd-top'>
			<div class="logo">
				<a href="<?php echo U('Index/Index/index');?>" target="_blank"></a>
			</div>
			<div class='logout'>
				<a style='color:#FFF;' href="<?php echo U('Index/Index/index');?>" target="_blank">站点主页</a>
				<a href="<?php echo U('Admin/Index/logout');?>" target="_blank">退出登录</a>
			</div>
		</div>
		<div class='bar'>
			<div class='home'>
				<a href="<?php echo U('Index/Index/index');?>" target="_blank"></a>
			</div>
			<div class="nav">
				
				<a href="javascript:void(0);">会员管理</a>
				
				<a href="javascript:void(0);">地区管理</a>
				
				<a href="javascript:void(0);">分类管理</a>
			
				<a href="javascript:void(0);">商铺管理</a>
				
				<a href="javascript:void(0);">商品管理</a>
				
				<a href="javascript:void(0);">订单管理</a>
				
				<a class='active' href="javascript:void(0);">站点概要</a>
			</div>
		</div>
	</div>
</div>
<div id="box">
	<div id="sidebar">
		<!-- 会员管理 -->
		<div class='menuItem'>
			<div class='menu'>
				<a class='title' href="javascript:void(0);">会员管理</a>
				<ul class='menuList' >
					<li><a href="<?php echo U(GROUP_NAME . '/User/index');?>">用户列表</a></li>
				</ul>
			</div>
		</div>
		<!-- 地区管理 -->
		<div class='menuItem'>
			<div class='menu'>
				<a class='title' href="javascript:void(0);">地区管理</a>
				<ul class='menuList' >
					<li><a href="<?php echo U(GROUP_NAME . '/Area/addArea');?>">添加地区</a></li>
					<li><a href="<?php echo U(GROUP_NAME . '/Area/index');?>">地区列表</a></li>
				</ul>
			</div>
		</div>
		<!-- 分类管理 -->
		<div class='menuItem'>
			<div class='menu'>
				<a class='title' href="javascript:void(0);">分类管理</a>
				<ul class='menuList' >
					<li><a href="<?php echo U(GROUP_NAME . '/Category/addCate');?>">添加分类</a></li>
					<li><a href="<?php echo U(GROUP_NAME . '/Category/index');?>">分类列表</a></li>
				</ul>
			</div>
		</div>
		<!-- 商铺管理 -->
		<div class='menuItem'>
			<div class='menu'>
				<a class='title' href="javascript:void(0);">商铺管理</a>
				<ul class='menuList' >
					<li><a href="<?php echo U(GROUP_NAME . '/Shops/addShop');?>">添加商铺</a></li>
					<li><a href="<?php echo U(GROUP_NAME . '/Shops/index');?>">商铺列表</a></li>
				</ul>
			</div>	
		</div>	
		<!-- 商品管理 -->
		<div class='menuItem'>
			<div class='menu'>
				<a class='title' href="javascript:void(0);">商品管理</a>
				<ul class='menuList' >
					<li><a href="<?php echo U(GROUP_NAME . '/Goods/addGoods');?>">添加商品</a></li>
					<li><a href="<?php echo U(GROUP_NAME . '/Goods/index');?>">商品列表</a></li>
				</ul>
			</div>	
		</div>
		<!-- 订单管理 -->
		<div class='menuItem'>
			<div class='menu'>	
				<a class='title' href="javascript:void(0);">订单管理</a>
				<ul class='menuList' >
					<li><a href="<?php echo U(GROUP_NAME . '/Order/index');?>">全部订单</a></li>
					<li><a href="<?php echo U(GROUP_NAME . '/Order/index');?>/status/1">未付款</a></li>
					<li><a href="<?php echo U(GROUP_NAME . '/Order/index');?>/status/2">已付款</a></li>
				</ul>
			</div>
		</div>
		<!-- 站点概要 -->
		<div class='menuItem' style="display:block;">
			<div class='menu'>	
				<a class='title' href="javascript:void(0);">站点概要</a>
				<ul class='menuList' >
					<li><a href=""></a></li>
					<li><a href="">站点概况</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="content">
		 <iframe id="iContent" name='showContent' scrolling="auto" height="100%" width="100%" frameborder="0" src="" >		
	 	</iframe>
	</div>
</div>
</body>
</html>