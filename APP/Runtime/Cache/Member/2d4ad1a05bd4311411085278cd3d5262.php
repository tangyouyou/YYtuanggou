<?php if (!defined('THINK_PATH')) exit();?>    ﻿
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
	<link href="__PUBLIC__/Css/cart.css" type="text/css" rel="stylesheet" >
	<script type="text/javascript" src="__PUBLIC__/Js/cart.js"></script>	
	<div id="main">
		<div class='step'>
			<div class='cart-title'>
				<i></i>
				<div>
					<h3>
						我的购物车
					</h3>
					<p>
						<span class='cart-bar-bg'>
							<span></span>
						</span>
						<b><?php echo ($count); ?>/20</b>
					</p>
				</div>
			</div>
			<ul>
				<li class='current'>1.查看购物车 </li>
				<li>2.选择支付方式 </li>
				<li>3.购买成功 </li>
			</ul>	
		</div>
		<!-- 购物车列表 -->
		<form method="post" action="<?php echo U(GROUP_NAME .'/Buy/payMent');?>">
			<table class='cart-table' border=0>
				<thead>
					<tr>
						<th width='35%'>商品</th>
						<th width='15%'>状态</th>
						<th width='15%'>类型/数量</th>
						<th width='10%'>单价</th>
						<th width='10%'>小计</th>
						<th width='10%'>操作</th>
					</tr>
				</thead>
				<tbody>
				    <?php if(is_array($cart)): foreach($cart as $key=>$v): ?><input type="hidden" name="gid[]" value="<?php echo ($v["gid"]); ?>">
			            <input type="hidden" name="price[]" value="<?php echo ($v["price"]); ?>">
						<tr>
							<td class='goods-show'>
								<img src="<?php echo ($v["goods_img"]); ?>">
								<a href=""><?php echo ($v["main_title"]); ?></a>
							</td>
							<td><?php echo ($v["status"]); ?></td>
							<td class='goods-num'>
								<a href="javascript:void(0);" class='reduce' ></a>
								<input class="goodsNum" name="goods_num[]" gid="<?php echo ($v["gid"]); ?>" url="<?php echo U(GROUP_NAME .'/Cart/updataGoodsNum');?>" type="text" value=<?php echo ($v["goods_num"]); ?>> 
								<a href="javascript:void(0);" class='add' ></a>
							</td>
							<td><?php echo ($v["price"]); ?></td>
							<td><?php echo ($v["xiaoji"]); ?></td>
							<td><a href="<?php echo U(GROUP_NAME .'/Member/Cart/del');?>/gid/<?php echo ($v["gid"]); ?>">删除</a></td>
						</tr><?php endforeach; endif; ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td colspan=3 class='total'>
							应付总额： <strong>¥<span><?php echo ($total); ?></span></strong> 
						</td>
					</tr>
				</tbody>
			</table>

			<div class='address-list'>
			<table>
				<thead>
					<tr>
						<th>选择</th>
						<th width="20%">收货人</th>
						<th>地址/邮编</th>
						<th width="20%">电话/手机</th>
						<th width="20%">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($address)): foreach($address as $key=>$v): ?><tr>
						<td>
							<input type="radio" checked=true name="addressid" value="<?php echo ($v["addressid"]); ?>">
						</td>
						<td>
							<?php echo ($v["username"]); ?>
						</td>
						<td>
						<?php echo ($v["s_province"]); ?>-<?php echo ($v["s_city"]); ?>-<?php echo ($v["s_county"]); ?>-<?php echo ($v["street"]); ?>
						</td>
						<td>
							<?php echo ($v["phone"]); ?>
						</td>
						<td>
							<a href="<?php echo U('Member/Account/delAddress');?>/addressid/<?php echo ($v["addressid"]); ?>">删除</a>
						</td>
					</tr><?php endforeach; endif; ?>
				</tbody>
			</table>	
			</div>


			<!-- 订单提交 -->
			<div class='bottom'>
				<input type="submit" class='submit' value="提交订单">
			</div>
		</form>
	</div>
</body>
</html>