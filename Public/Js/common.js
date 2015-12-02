/**
 * 添加收藏
 */
function addFavorite2() {
    var url = window.location;
    var title = document.title;
    var ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf("360se") > -1) {
        alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");
    }
    else if (ua.indexOf("msie 8") > -1) {
        window.external.AddToFavoritesBar(url, title); //IE8
    }
    else if (document.all) {
    	try{
    		window.external.addFavorite(url, title);
    	}catch(e){
    		alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    	}
    }
    else if (window.sidebar) {
        window.sidebar.addPanel(title, url, "");
    }
    else {
    	alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    }
}
/**
 * 导航字菜单
 */

$(function(){
	//导航样式切换
	$('#nav .user-nav').hover(function(){
		$(this).addClass('active');
	},function(){
		$(this).removeClass('active');
	})
	//我的团购菜单切换
	$('#nav .my-hdtg').hover(function(){
		$(this).find('.menu').show();
	},function(){
		$(this).find('.menu').hide();
	})
	
	
	
	
	//最近浏览菜单切换
	var requestRecentView = true;
	$('#nav .recent-view').hover(function(){
		$(this).find('.menu').show();
		if(requestRecentView === false){
			return false;
		}
		requestRecentView = false;
		var self = this;
		var url = $(this).attr('url');
		var oBox = $(this).find('.menu');
		var goodUrl = $(this).attr('goodUrl');
		$.ajax({
			url:url,
			dataType:'html',
			success:function(result){
                                var result = eval('(' + result + ')'); 
				if(result.status===true){
					var data = result.data;
					for(var i in data){
					var nodeStr = '<li>\
						<a class="image" href="'+goodUrl+'/gid/'+data[i].gid+'">\
					<img src="'+data[i].goods_img+'" />\
				</a>\
				<div>\
					<h4>\
						<a href="">'+data[i].main_title+'</a>\
					</h4>\
					<span><strong>¥'+data[i].price+'</strong><del>'+data[i].old_price+'</del></span>\
				</div>\
			</li>';
					oBox.append(nodeStr);
					}
					oBox.append('<p id="clearRecentView" class="clear"><a href="javascript:void(0);">清空最近浏览记录</a></p>');
					
				}else{
					oBox.html('没有浏览记录!');
				}
			}
		})
	},function(){
		setTimeout(function(){
			requestRecentView = true;
		},30000)
		$(this).find('.menu').hide();
	})
	
	
	/**
	 * 点击清空最近浏览
	 */
	$('#clearRecentView').on('click',function(){
		var url = $('#nav .recent-view').attr('clearView');
		$.ajax({
			url:url,
			dataType:'html',
			success:function(result){
                                var result = eval('(' + result + ')'); 
				$('#nav .recent-view .menu').html('没有浏览记录!');
			}
		})
	})
	
	
	//购物车菜单切换
	var requestState = true;
	$('#nav .my-cart').hover(function(){
		$(this).find('.menu').show();
		if(requestState === false){
			return false;
		}
		requestState = false;
		var url = $(this).attr('url');
		var goodUrl = $(this).attr('goodUrl');
		var delCartUrl = $(this).attr('delCartUrl');
		$.ajax({
			url:url,
			dataType:'html',
			success:function(result){
                                var result = eval('(' + result + ')'); 
				if(result.status === true){
					var data = result.data;
					$('#my-cart .menu li').remove();
					$('#my-cart .menu p').remove();
					for(var i in data){
						var nodeStr = '<li>\
							<a class="image" href="/YYtuangou/Index/Detail/index/gid/'+data[i].gid+'">\
								<img src="'+data[i].goods_img+'" />\
							</a>\
							<div>\
								<h4>\
									<a  href="/YYtuangou/Index/Detail/index/gid/'+data[i].gid+'">'+data[i].main_title+'</a>\
								</h4>\
								<span><strong>¥'+data[i].price+'</strong><a class="delCart" url="'+delCartUrl+'/gid/'+data[i].gid+'" href="javascript:void(0);">删除</a></span>\
							</div>\
						</li>';
						$('#my-cart .menu').append(nodeStr);
					}
					$('#my-cart .menu').append('<p class="clear"><a href="'+url+'">查看我的购物车</a></p>');
				}else{
					$('#my-cart .menu').html('没有添加到购物的商品!');
				}
			}
		})
		
	},function(){
		setTimeout(function(){
			requestState = true;
		},3000)
		$(this).find('.menu').hide();
	})
	
	
	/**
	 * 删除购物车异步
	 */
	$('#my-cart .delCart').on('click',function(){
		var url = $(this).attr('url');
		var self = this;
		$.ajax({
			url:url,
			dataType:'html',
			success:function(result){
                                var result = eval('(' + result + ')'); 
				if(result.status === true){
					$(self).parents('li').remove();
				}else{
					alert('删除失败!');
				}
			}
		})
	})
})

$(function(){
	$('.category a').click(function(){
		var category = $(this).attr('category');
		document.cookie = "category="+category+';path=/';
	})
	var category = getcookie("category");
	$('.category a').each(function(){
		if($(this).attr('category') == category){
			$(this).addClass('active');
		}else{
			$(this).removeClass('active');
		}
	})
})

/*
获得cookie
*/
function getcookie(name){
    var arr = document.cookie.split(';');
    for (var i=0;i<arr.length;i++)
        var arr2 = arr[i].split('=');
        return arr2[1]
	}







