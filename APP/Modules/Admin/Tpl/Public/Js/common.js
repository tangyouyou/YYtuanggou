$(function(){
	/******  删除确认  *******/
	$('.delAffirm').click(function(){
		if(!confirm('你确定要删除吗?')){
			return false;
		}
	})
	//分页按钮样式
	$('#page a').addClass('btn');
	$('#page strong').addClass('btn btn-info').css({marginRight:'5px'});
	
	 
})
