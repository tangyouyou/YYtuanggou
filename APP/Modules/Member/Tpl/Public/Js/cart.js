$(function(){
	$('.reduce').click(function(){
        var oGoodsNum = $(this).parent().find('.goodsNum');
        var goodsNum = Number(oGoodsNum.val())-1;
		ajaxUpdateGoodsNum(goodsNum,oGoodsNum)
	})
	$('.add').click(function(){
		var oGoodsNum  = $(this).parent().find('.goodsNum');
		var goodsNum =  Number(oGoodsNum.val())+1;
		ajaxUpdateGoodsNum(goodsNum,oGoodsNum);
	})

	/*
	 异步更新购物车数量
	*/
	function ajaxUpdateGoodsNum(goodsNum,oGoodsNum){
		if(goodsNum <=0){
			return false;
		}
		var url = oGoodsNum.attr('url');
        var gid = oGoodsNum.attr('gid');
        $.ajax({
           url:url,
           type:'POST',
           data:'gid='+gid+'&num='+goodsNum,
           dataType:'json',
           success:function(result){
               if(result.status === true){
					oGoodsNum.val(result.num);
				}
           }
        })
	}
})