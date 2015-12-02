
var checkForm = {
	'email':{
		preg:/^[a-z0-9\.]+@[a-z0-9]+\.[a-z]+$/i,
		focus:'请填写你的邮箱!',
		empty:'邮箱不能为空',
		error:'邮箱格式错误'
		
	},
	'username':{
		preg:/^[a-z]\w{5,15}$/i,
		focus:'请填写你的用户名!',
		empty:'用户名不能为空',
		error:'用户名格式错误'
	},
	'password':{
		preg:/^\S{6,32}$/,
		focus:'请填写你的密码!',
		empty:'密码不能为空',
		error:'密码格式错误'	
		
	},
	'password_d':{
		focus:'确认密码!',
		empty:'密码不能为空',
		error:'密码不一致'
	},
	'code':{
		preg:/^[a-z0-9]{4}$/i,
		focus:'请输入验证码!',
		empty:'验证码不能为空',
		error:'验证码格式错误'
	}

		
		
		
		
};


$(function(){
	check();
	$('#regForm').submit(function(){
		for(var i=0;i<aEls.length;i++){
			if(aEls[i].status === false){
				//显示提示信息
				return false;
			}
		}
	})
})
//原生的元素集合
var aEls = [];
function check(){
	var aMust = $('#regForm .must');
	aMust.each(function(){
		aEls.push(this);
		this.status = false;
	})
	/**
	 * 添加表单事件
	 */
	for(var i=0;i<aEls.length;i++){
		aEls[i].onfocus=function(){
			var name = this.name;
			var msg = checkForm[name]['focus'];
			showFocus.call(this,msg);
			this.onblur=function(){
				var val = this.value;
				//为空的情况
				if(val == ''){
					var msg = checkForm[name]['empty'];
					showError.call(this,msg);
					return;
				}
				if(name == 'password_d'){
					if($('#password').val() != val){
						var msg = checkForm[name]['error'];
						showError.call(this,msg);
						return;
					}
				}else{
					//验证正则
					var preg = checkForm[name]['preg'];
					if(!preg.test(val)){
						var msg = checkForm[name]['error'];
						showError.call(this,msg);
						return;
					}
				}
				//需要ajax校验的
				if($(this).attr('ajax') == 1){
					var url = __JSCONTROL__+'/check';
					var self = this;
					$.ajax({
						url:url,
						type:'POST',
						data:name+'='+val,
						dataType:'html',
						success:function(result){
                                                          var result = eval('(' + result + ')'); 
							if(result.status === true){
								showSuccess.call(self,'');
							}else{
								showError.call(self,result.msg);
							}
						}
					})
				}else{
					showSuccess.call(this,'');
				}
			}
		}
	}
	
}

/**
 * 显示获得焦点的
 * @param msg
 */
function showFocus(msg){
	var parent = $(this).parents('dl');
	var oPrompt = parent.find('.prompt');
	parent.attr('class','focus');
	oPrompt.html(msg);
}

/**
 * 显示错误提示
 */
function showError(msg){
	var parent = $(this).parents('dl');
	var oPrompt = parent.find('.prompt');
	parent.attr('class','error');
	oPrompt.html(msg);
	this.status = false;
}
/**
 * 显示成功信息的
 */
function showSuccess(msg){
	var parent = $(this).parents('dl');
	var oPrompt = parent.find('.prompt');
	parent.attr('class','success');
	oPrompt.html(msg);
	this.status = true;
}