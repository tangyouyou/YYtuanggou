<?php if (!defined('THINK_PATH')) exit();?>﻿    ﻿
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
	<!-- 载入商品筛选-->
	<!-- 商品过滤开始 -->
	<div id="filter">
		<div class='hots'>
			<span>热门团购：</span>
			<div class='box'>
			    <?php if(is_array($hostGroup)): foreach($hostGroup as $key=>$v): ?><a href="<?php echo U('Index/Index/index');?>/cid/<?php echo ($v["cid"]); ?>"><?php echo ($v["cname"]); ?></a><?php endforeach; endif; ?>
			</div>	
		</div>
		
		<div class='filter-box'>
			<div class='filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>分类：</span>
					<div class='box'>
					   <?php if(is_array($topCategory)): foreach($topCategory as $key=>$v): echo ($v); endforeach; endif; ?>			
				    </div>
				</div>
				<?php if(sonCategory): ?><div class='filter-label-level-2'>
				     <div class='box'>
                       <?php if(is_array($sonCategory)): foreach($sonCategory as $key=>$v): echo ($v); endforeach; endif; ?>
                     </div>
				</div><?php endif; ?>
			</div>
			<div class='locality filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>区域：</span>
					<div class='box'>
					    <?php if(is_array($topArea)): foreach($topArea as $key=>$v): echo ($v); endforeach; endif; ?>
					</div>
				</div>
				<?php if(sonArea): ?><div class='filter-label-level-2'>
					     <?php if(is_array($sonArea)): foreach($sonArea as $key=>$v): echo ($v); endforeach; endif; ?>
					</div><?php endif; ?>
			</div>
			<div class='locality filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>价格：</span>
					<div class='box'>
					    <?php if(is_array($price)): foreach($price as $key=>$v): echo ($v); endforeach; endif; ?>
					</div>
				</div>				
			</div>
						<div class='screen'>
				<div>
					<a class='active' href="<?php echo ($orderUrl['d']); ?>">默认排序</a>
					<a href="<?php echo ($orderUrl['b']); ?>">销量<b></b></a>
					<a href="<?php echo ($orderUrl['p_d']); ?>">价格<b></b></a>
					<a href="<?php echo ($orderUrl['p_a']); ?>">价格<b style="background-position:-45px -16px;"></b></a>
					<a style="border:0;" href="<?php echo ($orderUrl['t']); ?>">发布时间<b></b></a>
				</div>
			</div>
		</div>	
	</div>
	<!-- 商品过滤结束 -->
	<link href="__PUBLIC__/css/index.css" type="text/css" rel="stylesheet" >
	<!-- 页面主体开始 -->
	<div id="main">
		<div class='content'>
		    <?php if(is_array($goods)): foreach($goods as $key=>$v): ?><div class='item'>
					<div class='cover'>
						<a href="<?php echo U(GROUP_NAME .'/Detail/index');?>/gid/<?php echo ($v["gid"]); ?>"><img src="<?php echo ($v["goods_img"]); ?>"/></a>
					</div>
					<a class='link' href="">
						<h3><?php echo ($v["main_title"]); ?></h3>
						<p class='describe'>
							<?php echo ($v["sub_title"]); ?>
						</p>
					</a>
					<p class='detail'>
						<strong>¥<?php echo ($v["price"]); ?></strong>
						<span>门店价<span>-</span><del><?php echo ($v["old_price"]); ?></del></span>
						<a href="<?php echo U(GROUP_NAME .'/Detail/index');?>/gid/<?php echo ($v["gid"]); ?>" target="_blank"></a>
					</p>
					<p class='total'>
						<strong><?php echo ($v["buy"]); ?></strong>
						人已参与
					</p>
				</div><?php endforeach; endif; ?>
			<div class='c'></div>
			<div class='page'>
			      <?php echo ($page); ?>
			</div>
		</div>
		<div class='sidebar'>
			<div class='hot-products'>
				<h3>热卖商品</h3>
				<ul>
				    <?php if(is_array($hostGoods)): foreach($hostGoods as $k=>$v): ?><li>
							<h6><span><?php echo ($k+1); ?></span><a href="<?php echo U('Index/Detail/index');?>/gid/<?php echo ($v["gid"]); ?>"><?php echo ($v["main_title"]); ?></a></h6>
							<a href="<?php echo U('Index/Detail/index');?>/gid/<?php echo ($v["gid"]); ?>"><img src="<?php echo ($v["goods_img"]); ?>"/></a>
							<div class='info'>
								<em>¥<?php echo ($v["price"]); ?></em>
								<p>每天<span><?php echo ($v["buy"]); ?></span>人团购</p>
							</div>
						</li><?php endforeach; endif; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class='c'></div>
		<div id="footer">
		<p>悠悠出品——必出精品</p>
	</div>
	</body>
</html>
</body>
</html>