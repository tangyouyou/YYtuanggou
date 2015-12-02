$(function(){
	$('#addCart').click(function(){
		var url = $(this).attr('url');
		$.ajax({
			url:url,
			dataType:'html',
			success:function(result){
                                var result = eval('(' + result + ')'); 
                         	if(result.status === true){
					alert('添加到购物车成功！')
				}else{
					alert('添加购物车失败！')
				}
			}
		})
	
	})
	
	$('#addCollect').click(function(){
		if(userIsLogin === false){
			alert('请先登录！');
			return false;
		}
		var url = $(this).attr('url');
		$.ajax({
			url:url,
			dataType:'html',
			success:function(result){
                                   var result = eval('(' + result + ')'); 
				if(result.status === true){
					alert('收藏成功！')
				}else{
					alert('添加收藏失败！')
				}
			}
		})
	
	})


})


