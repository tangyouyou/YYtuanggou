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
	
<!-- 载入公共头部文件结束 -->
	<link href="__PUBLIC__/css/detail.css" type="text/css" rel="stylesheet" >
	<div id="map" class='position'>
		<a href="<?php echo U(GROUP_NAME .'/Index/index');?>/aid/<?php echo ($detail["aid"]); ?>"><?php echo ($detail["aname"]); ?></a><span>»</span><a href="<?php echo U(GROUP_NAME .'/Index/index');?>/cid/<?php echo ($detail["cid"]); ?>"><?php echo ($detail["cname"]); ?></a><span>»</span><span><?php echo ($detail["shopname"]); ?></span>
	<div id="content" class='position' style="height:3000px;">
		<div class='content-left'>
			<div class="goods-intro">
				<div class='goods-title'>
					<h1><?php echo ($detail["main_title"]); ?></h1>
					<h3><?php echo ($detail["sub_title"]); ?></h3>
				</div>
				<div class='deal-intro'>
					<div class='buy-intro'>
						<div class='price'>
							<div class='discount-price'>
								<span>¥</span><?php echo ($detail["price"]); ?>
							</div>
							<div class='cost-price'>
								<span class='discount'><?php echo ($detail["discount"]); ?>折</span>
								门店价<b>¥<?php echo ($detail["old_price"]); ?></b>
							</div>
						</div>
						<div class='deal-buy-cart'>
							<a href="<?php echo U(Member.'/Buy/index');?>/gid/<?php echo ($detail["gid"]); ?>" class='buy'></a>
							<a href="javascript:void(0);" url="<?php echo U(Member.'/Cart/addCart');?>/gid/<?php echo ($detail["gid"]); ?>" id="addCart" class='cart'></a>
						</div>
						<div class='purchased'>
							<p class='people'>
								<span><?php echo ($detail["buy"]); ?></span>人已团购
							</p>
							<p class='time'>
								<?php echo ($detail['end_time']); ?>
							</p>
						</div>
						<ul class='refund-intro'>
							<li>
								<span class='ico'></span>
								<span class='text'>假一陪十</span>
							</li>
							<li>
								<span class='ico'></span>
								<span class='text'>假一陪十</span>
							</li>
						</ul>
					</div>
					<div class='image-intro'>
						<img src="<?php echo ($detail["goods_img"]); ?>"/>
					</div>
				</div>
				<div class='collect'>
					<a class='collect-link' id="addCollect" url="<?php echo U('Member/Index/addCollect');?>/gid/<?php echo ($detail["gid"]); ?>" href='javascript:void(0)'><i></i>收藏本单</a>
					
					<div class='share'>
						
					</div>
					
				</div>
			</div>
			<div class='detail'>
				<ul class='plot-points'>
					<li class='active'><a href="#shop-site">商家位置</a></li>
					<li><a href="#details">本单详情</a></li>
					<li><a href="#comment">消费评价</a></li>
				</ul>
				<div id="shop-site" class='shop-site'>
					<p class='site-title'>商家位置</p>
					<div class='box'>
						<div id="bMap" class='map'>
							
						</div>
						<div class='info'>
							<h3><?php echo ($detail["shopname"]); ?></h3>
							<dl>
								<dt>地址:</dt>
								<dd><?php echo ($detail["shopaddress"]); ?></dd>
							</dl>
							<dl>
								<dt>地铁:</dt>
								<dd><?php echo ($detail["metroaddress"]); ?></dd>
							</dl>
							<dl>
								<dt>电话:</dt>
								<dd><?php echo ($detail["shoptel"]); ?></dd>
							</dl>
						</div>
					</div>
				</div>
				<div id="details"  class='details'>
					<?php echo ($detail["detail"]); ?>
				</div>
				<div id="comment" class='comment'>
					<div class='comment-list-title'>
						<span>全部评价</span>
						<a class='order-time' href="">按时间<i></i></a>
					</div>
					<div class='comment-list'>
						<div class='list-con'>
							<div class='con-top'>
								<span class='username'>sdas</span>
								<span class='time'>评价于:<em>2013-08-04</em></span>
							</div>
							<p>
								说是香草拿铁不是很苦，结果根本不是想象中的味道！像速溶冲调！还要另加五元？有此一说吗？银座店环境一般！
							</p>
						</div>
						
					</div>
					<div class='comment-page'>
						<a href="">1</a>
						<a href="">1</a>
						<a href="">1</a>
						<a href="">1</a>
						<a href="">1</a>
						<a href="">1</a>
					</div>
				</div>
			</div>
		
		</div>
		<div class='content-right'>
			<div class='recommend'>
				<h3 class='recommend-title'>
					看过本团购的用户还看了
				</h3>
				<?php if(is_array($relateGoods)): foreach($relateGoods as $key=>$v): ?><div class='recommend-goods'>
						<a class='goods-image' href="">
							<img alt="图像加载失败.." src="<?php echo ($v["goods_img"]); ?>">
						</a>
						<h4>
							<a href="<?php echo U('Index/Detail/index');?>/gid/<?php echo ($v["gid"]); ?>" target="_blank"><?php echo ($v["main_title"]); ?></a>
						</h4>
						<p>
							<strong>¥<?php echo ($v["price"]); ?></strong>
							<span class='cost-price'>门店价<del><?php echo ($v["old_price"]); ?></del></span>
							<span class='num'>
								<span><?php echo ($v["buy"]); ?></span>
								 人已团购
							</span>
						</p>
					</div><?php endforeach; endif; ?>

				</div>
			</div>
		</div>
		
		
	</div>		

<!-- 载入公共头部文件开始 --> 
    <div class="c"></div>
	<div id="footer">
		<p>逢剧必死唐悠悠出品-必属精品</p>
	</div>
	<div id="cover"></div>
	<div id="infoWindow">
		
	</div>
	<script src="__PUBLIC__/Js/detail.js"> </script>
	<script>
		var userIsLogin = false;
		<?php if($userIsLogin): ?>var userIsLogin = true;<?php endif; ?>
	</script>
	</body>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=PVshwY7ESTb7Rzz1Sdj7StV2"></script>
	<script>
		var shopcoord = <?php echo ($detail["shopcoord"]); ?>;
		// 百度地图API功能
		var map = new BMap.Map("bMap");            // 创建Map实例
		var point = new BMap.Point(shopcoord.lng, shopcoord.lat);    // 创建点坐标
		map.centerAndZoom(point,15);                     	// 初始化地图,设置中心点坐标和地图级别。
		map.enableScrollWheelZoom();                        //启用滚轮放大缩小
		var marker1 = new BMap.Marker(point);  // 创建标注
		map.addOverlay(marker1);              // 将标注添加到地图中
		map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}));  //右上角，仅包含平移和缩放按钮
	</script>

</html>