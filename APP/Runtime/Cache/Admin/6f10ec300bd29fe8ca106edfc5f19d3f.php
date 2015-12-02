<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<script type='text/javascript' src="__ROOT__/Public/jQuery/jquery-1.11.3.js"></script>
<script	type="text/javascript" src="__ROOT__/Public/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="__ROOT__/Public/Js/common.js"> </script>
<script type="text/javascript" src="__PUBLIC__/Js/common.js"> </script>
<link href="__ROOT__/Public/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="__ROOT__/Public/Css/common.css" type="text/css" rel="stylesheet">
</head>
<style>
	#map {
		margin-top:20px;
		margin-left: 20px;
		height: 50px;
		width:200px;

	}
	.title{
		font-size: 28px;
	}
	#content{
		margin-left: 50px;
		margin-top: 10px;
	    margin-right: 50px;
	}

</style>

<div id="map">
	<span class='title'>商品列表</span>
</div>
<div id="content">
	<table id="table" class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th width="5%"></th>
				<th width="10%">商铺名称</th>
				<th width="15%">商品标题</th>	
				<th width="10%">商品价格</th>
				<th width="10%">商品销量</th>
				<th width="10%">所在地区</th>
				<th width="10%">所属分类</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($data)): foreach($data as $k=>$v): ?><tr>
					<td><?php echo ($k+1); ?></td>
					<td><?php echo ($v["shopname"]); ?></td>
					<td><?php echo ($v["main_title"]); ?></td>
					<td><?php echo ($v["price"]); ?></td>
					<td><?php echo ($v["buy"]); ?></td>
					<td><?php echo ($v["aname"]); ?></td>
					<td><?php echo ($v["cname"]); ?></td>
					<td>
						<a class='btn btn-small btn-success' href="<?php echo U(GROUP_NAME . '/Goods/edit');?>/gid/<?php echo ($v["gid"]); ?>">编辑</a>
						<a class='btn btn-small btn-success delAffirm' href="<?php echo U(GROUP_NAME . '/Goods/del');?>/gid/<?php echo ($v["gid"]); ?>">删除</a>
					</td>
				</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	<div id="page">
		<?php echo ($page); ?>
	</div>
</div>

</body>
</html>