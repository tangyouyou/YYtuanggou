/*
    通用表单验证方法
    Validform version 4.0
	For more information, you can visit validform.rjboy.cn
	By sean during April 7, 2010 - March 12, 2012
	
	Demo:
	$(".demoform").Validform({//$(".demoform")指明是哪一表单需要验证,名称需加在form表单上;
		btnSubmit:"#btn_sub", //#btn_sub是该表单下要绑定点击提交表单事件的按钮;如果form内含有submit按钮该参数可省略;
		tiptype:1, //可选项 1=>pop box,2=>side tip，默认为1，也可以传入一个function函数，自定义提示信息的显示方式（可以实现你想要的任何效果，具体参见demo页）;
		tipSweep:true,//可选项 true | false 默认为false，当true时提示信息将只会在表单提交时触发显示，各表单元素blur时不会被触发显示;
		showAllError:false,//可选项 true | false，true：提交表单时所有错误提示信息都会显示，false：一碰到验证不通过的就停止检测后面的元素，只显示该元素的错误信息;
		postonce:true, //可选项 是否开启网速慢时的二次提交防御，true开启，不填则默认关闭;
		ajaxPost:true, //使用ajax方式提交表单数据，默认false，提交地址就是action指定地址;
		datatype:{//传入自定义datatype类型，可以是正则，也可以是函数（函数内会传入一个参数）;
			"*6-20": /^[^\s]{6,20}$/,
			"z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/,
			"username":function(gets,obj){
				//参数gets是获取到的表单元素值，obj为当前表单对象;
				var reg1=/^[\w\.]{4,16}$/,
					reg2=/^[\u4E00-\u9FA5\uf900-\ufa2d]{2,8}$/;
				
				if(reg1.test(gets)){return true;}
				if(reg2.test(gets)){return true;}
				return false;
			},
			"option_phone":function(){
				//要实现二选一的验证效果，datatype 的名称需要以 "option_" 开头;	
			}
		},
		usePlugin:{
			swfupload:{},
			datepicker:{},
			passwordstrength:{}
		}，
		callback:function(data){
			//返回数据data是json格式，{"info":"demo info","status":"y"}
			//info: 输出提示信息;
			//status: 返回提交数据的状态,是否提交成功。如可以用"y"表示提交成功，"n"表示提交失败，在ajax_post.php文件返回数据里自定字符，主要用在callback函数里根据该值执行相应的回调操作;
			//你也可以在ajax_post.php文件返回更多信息在这里获取，进行相应操作；
			
			//这里执行回调操作;
			//注意：如果不是ajax方式提交表单，传入callback表单将不会提交。在验证全部通过后会执行这个回调函数，这时data参数是当前表单对象。
		}
	});
*/
(function($){
	var errorobj=null,//指示当前验证失败的表单元素;
		msgobj,//pop box object 
		msghidden=true, //msgbox hidden?
		tipmsg={//默认提示文字;
			tit:"提示信息",
			w:"请输入正确信息！",
			r:"通过信息验证！",
			c:"正在检测信息…",
			s:"请填入信息！",
			v:"所填信息没有经过验证，请稍后…",
			p:"正在提交数据…",
			err:"出错了！请检查提交地址或返回数据格式是否正确！",
			security:"安全错误，您不能提交表单！"
		},
		creatMsgbox=function(){
			if($("#Validform_msg").length!==0){return false;}
			msgobj=$('<div id="Validform_msg"><div class="Validform_title">'+tipmsg.tit+'<a class="Validform_close" href="javascript:void(0);">&chi;</a></div><div class="Validform_info"></div><div class="iframe"><iframe frameborder="0" scrolling="no" height="100%" width="100%"></iframe></div></div>').appendTo("body");//提示信息框;
			msgobj.find("a.Validform_close").click(function(){
				msgobj.hide();
				msghidden=true;
				if(errorobj){
					errorobj.focus().addClass("Validform_error");
				}
				return false;
			}).focus(function(){this.blur();});

			$(window).bind("scroll resize",function(){
				if(!msghidden){				  
					var left=($(window).width()-msgobj.outerWidth())/2,
						top=($(window).height()-msgobj.outerHeight())/2,
						topTo=(document.documentElement.scrollTop?document.documentElement.scrollTop:document.body.scrollTop)+(top>0?top:0);

					msgobj.animate({
						left : left,
						top : topTo
					},{ duration:400 , queue:false });
				}
			});
		};
		
	$.Tipmsg=tipmsg;

	$.fn.Validform=function(settings){
		var defaults={};
		settings=$.extend({},$.fn.Validform.sn.defaults,settings);
		settings.datatype && $.extend($.Datatype,settings.datatype);

		this.each(function(index){
			var $this=$(this),
				numchecked=$this.find("[datatype]").length,
				posting=false; //防止表单按钮双击提交两次;
			$this.find("[tip]").each(function(){//tip是表单元素的默认提示信息,这是点击清空效果;
				var defaultvalue=$(this).attr("tip");
				var altercss=$(this).attr("altercss");
				$(this).focus(function(){
					if($(this).val()==defaultvalue){
						$(this).val('');
						if(altercss){$(this).removeClass(altercss);}
					}
				}).blur(function(){
					if($.trim($(this).val())===''){
						$(this).val(defaultvalue);
						if(altercss){$(this).addClass(altercss);}
					}
				});
			});
			
			$this.find("input[recheck]").each(function(){//表单元素值比较时的信息提示增强;
				var _this=$(this);
				var recheckinput=$this.find("input[name='"+$(this).attr("recheck")+"']");
				recheckinput.bind("keyup",function(){
					if(recheckinput.val()==_this.val() && recheckinput.val() != ""){
						if(recheckinput.attr("tip")){
							if(recheckinput.attr("tip") == recheckinput.val()){return false;}
						}
						_this.trigger("blur");
					}
				}).bind("blur",function(){
					if(recheckinput.val()!=_this.val() && _this.val()!=""){
						if(_this.attr("tip")){
							if(_this.attr("tip") == _this.val()){return false;}	
						}
						_this.trigger("blur");
					}
				});
			});
			
			//plugins here to start;
			if(settings.usePlugin){
				//swfupload;
				if(settings.usePlugin.swfupload){
					var swfuploadinput=$this.find("input[plugin='swfupload']").val(""),
						custom={
							custom_settings:{
								form:$this,
								showmsg:function(msg,type){
									$.fn.Validform.sn.showmsg(msg,settings.tiptype,{obj:swfuploadinput,type:type});	
								}	
							}	
						};

					custom=$.extend(true,{},settings.usePlugin.swfupload,custom);
					if(typeof(swfuploadhandler) != "undefined"){swfuploadhandler.init(custom,index);}
					
				}
				//datepicker;
				if(settings.usePlugin.datepicker){
					if(settings.usePlugin.datepicker.format){
						Date.format=settings.usePlugin.datepicker.format; 
						delete settings.usePlugin.datepicker.format;
					}
					if(settings.usePlugin.datepicker.firstDayOfWeek){
						Date.firstDayOfWeek=settings.usePlugin.datepicker.firstDayOfWeek; 
						delete settings.usePlugin.datepicker.firstDayOfWeek;
					}
					
					var datepickerinput=$this.find("input[plugin='datepicker']");
					settings.usePlugin.datepicker.callback && datepickerinput.bind("dateSelected",function(){
						var d=new Date( $.event._dpCache[this._dpId].getSelected()[0] ).asString(Date.format);
						settings.usePlugin.datepicker.callback(d,this);
					});
					
					datepickerinput.datePicker(settings.usePlugin.datepicker);
				}
				//passwordstrength;
				if(settings.usePlugin.passwordstrength){
					settings.usePlugin.passwordstrength.showmsg=function(obj,msg,type){
						$.fn.Validform.sn.showmsg(msg,settings.tiptype,{obj:obj,type:type,sweep:settings.tipSweep},"hide");
					};
					$this.find("input[plugin*='passwordStrength']").passwordStrength(settings.usePlugin.passwordstrength);
				}
			
			}

			//bind the blur event;
			$this.find("[datatype]").blur(function(){
				var flag=true;
				flag=$.fn.Validform.sn.checkform($(this),$this,{type:settings.tiptype,sweep:settings.tipSweep},"hide");

				if(!flag){return false;}
				if(typeof(flag)!="boolean"){//如果是radio, checkbox, select则不需再执行下面的代码;
					$(this).removeClass("Validform_error");
					return false;
				}

				flag=$.fn.Validform.sn.regcheck($(this).attr("datatype"),$(this).val(),$(this));
				if(!flag){
					if($(this).attr("ignore")==="ignore" && ( $(this).val()==="" || $(this).val()===$(this).attr("tip") )){
						if(settings.tiptype==2){
							var tempobj=$(this).parent().next().find(".Validform_checktip");
							if(tempobj.is(".Validform_right")){
								tempobj.text($(this).attr("errormsg"));
							}
							tempobj.removeClass().addClass("Validform_checktip");
						}else if(typeof settings.tiptype == "function"){
							(settings.tiptype)("",{obj:$(this),type:4},$.fn.Validform.sn.cssctl);
						}
						flag=true;
						errorobj=null;
						return true;
					}
					$.fn.Validform.sn.showmsg($(this).attr("errormsg")||tipmsg.w,settings.tiptype,{obj:$(this),type:3,sweep:settings.tipSweep},"hide"); //当tiptype=1的情况下，传入"hide"则让提示框不弹出,tiptype=2的情况下附加参数"hide"不起作用;
				}else{
					if($(this).attr("ajaxurl")){
						var inputobj=$(this);
						var subpost=arguments[1];
						if(inputobj.attr("valid")=="posting"){return false;}
						
						inputobj.attr("valid","posting");
						$.fn.Validform.sn.showmsg(tipmsg.c,settings.tiptype,{obj:inputobj,type:1,sweep:settings.tipSweep},"hide");
						$.ajax({
							type: "POST",
							url: inputobj.attr("ajaxurl"),
							data: "param="+$(this).val()+"&name="+$(this).attr("name"),
							dataType: "text",
							success: function(s){
								if($.trim(s)=="y"){
									inputobj.attr("valid","true");
									$.fn.Validform.sn.showmsg(tipmsg.r,settings.tiptype,{obj:inputobj,type:2,sweep:settings.tipSweep},"hide");
									if(subpost==="postform"){
										$this.trigger("submit");
									}
								}else{
									inputobj.attr("valid",s);
									$.fn.Validform.sn.showmsg(s,settings.tiptype,{obj:inputobj,type:3,sweep:settings.tipSweep});
								}
							},
							error: function(){
								inputobj.attr("valid",tipmsg.err);
								$.fn.Validform.sn.showmsg(tipmsg.err,settings.tiptype,{obj:inputobj,type:3,sweep:settings.tipSweep});	
							}
						});
					}else{
						$.fn.Validform.sn.showmsg(tipmsg.r,settings.tiptype,{obj:$(this),type:2,sweep:settings.tipSweep},"hide");
					}
				}

			});

			$this.find(":checkbox[datatype],:radio[datatype]").each(function(){
				var _this=$(this);
				var name=_this.attr("name");
				$this.find("[name='"+name+"']").filter(":checkbox,:radio").bind("click",function(){
					_this.trigger("blur");
				});
			});

			//subform
			var subform=function(){
				if(numchecked!=$this.find("[datatype]").length){
					$.Showmsg(tipmsg.security);
					return false;
				}
				
				var flag=true,
					inflag=true;
				if(posting){return false;}

				$this.find("[datatype]").each(function(){
					inflag=$.fn.Validform.sn.checkform($(this),$this,{type:settings.tiptype,sweep:settings.tipSweep});

					if(!inflag){
						if(!settings.showAllError){
							errorobj.focus();
							flag=false;
							return false;	
						}
						flag && (flag=false);
						return true;
					}

					if(typeof(inflag)!="boolean"){
						return true;
					}

					inflag=$.fn.Validform.sn.regcheck($(this).attr("datatype"),$(this).val(),$(this));
					
					if(inflag && $(this).is("[datatype*='option_']")){
						$(this).trigger("blur");	
					}

					if(!inflag){
						if($(this).attr("ignore")==="ignore" && ( $(this).val()==="" || $(this).val()===$(this).attr("tip") )){
							errorobj=null;
							return true;
						}
						$.fn.Validform.sn.showmsg($(this).attr("errormsg")||tipmsg.w,settings.tiptype,{obj:$(this),type:3,sweep:settings.tipSweep});
						
						if(!settings.showAllError){
							errorobj.focus();
							flag=false;
							return false;
						}
						
						flag && (flag=false);
						return true;
					}

					if($(this).attr("ajaxurl")){
						if($(this).attr("valid")!="true"){
							var thisobj=$(this);
							$.fn.Validform.sn.showmsg(tipmsg.v,settings.tiptype,{obj:thisobj,type:3,sweep:settings.tipSweep});
							if(!msghidden || settings.tiptype!=1){
								setTimeout(function(){
									thisobj.trigger("blur",["postform"]);//continue the form post;
								},1500);
							}
							
							if(!settings.showAllError){
								flag=false;
								return false;
							}
							
							flag && (flag=false);
							return true;
						}else{
							$.fn.Validform.sn.showmsg(tipmsg.r,settings.tiptype,{obj:$(this),type:2,sweep:settings.tipSweep},"hide");
						}
					}
				});
				
				if(settings.showAllError){
					$this.find(".Validform_error:first").focus();	
				}

				if(flag && !posting){
					errorobj=null;
					if(settings.postonce){posting=true;}
					if(settings.ajaxPost){
						$.fn.Validform.sn.showmsg(tipmsg.p,settings.tiptype,{obj:$this,type:1,sweep:settings.tipSweep},"alwaysshow");//传入"alwaysshow"则让提示框不管当前tiptye为1还是2都弹出;
						$.ajax({
							type: "POST",
							dataType:"json",
							url: $this.attr("action"),
							data: decodeURIComponent($this.serialize(),true),
							success: function(data){
								if(data.status==="y"){
									$.fn.Validform.sn.showmsg(data.info,settings.tiptype,{obj:$this,type:2,sweep:settings.tipSweep},"alwaysshow");
								}else{
									posting=false;
									$.fn.Validform.sn.showmsg(data.info,settings.tiptype,{obj:$this,type:3,sweep:settings.tipSweep},"alwaysshow");
								}
								
								settings.callback && settings.callback(data);
							},
							error: function(){
								posting=false;
								$.fn.Validform.sn.showmsg(tipmsg.err,settings.tiptype,{obj:$this,type:3,sweep:settings.tipSweep},"alwaysshow");
							}
						});
						return false;
					}else{
						settings.callback ? settings.callback($this) : $this.get(0).submit();
					}
				}

			};

			settings.btnSubmit && $this.find(settings.btnSubmit).bind("click",subform);
			$this.submit(function(){
				subform();
				return false;
			});
			$this.find("input[type='reset']").click(function(){
				$this.find(".Validform_right").text("");
				$this.find(".Validform_checktip").removeClass("Validform_wrong Validform_right Validform_loading");
				$this.find(".Validform_error").removeClass("Validform_error");
				$this.find("input:first").focus();
			});
		});

		//预创建pop box;
		if( settings.tiptype==1 || (settings.tiptype==2 && settings.ajaxPost) ){		
			creatMsgbox();
		}

	};

	$.fn.Validform.sn={
		defaults:{
			tiptype:1,
			tipSweep:false,
			showAllError:false,
			postonce:false,
            ajaxPost:false
		},

		toString:Object.prototype.toString,

		regcheck:function(type,gets,obj){
			if(this.toString.call($.Datatype[type])=="[object Function]"){
				return ($.Datatype[type])(gets,obj);
			}
			
			if(!(type in $.Datatype)){
				var mac=type.match($.Datatype["match"]),
					temp;
				reg:for(var name in $.Datatype){
					temp=name.match($.Datatype["match"]);
					if(!temp){continue reg;}
					if(mac[1]===temp[1]){
						var str=$.Datatype[name].toString();
						var regxp=new RegExp("\\{"+temp[2]+","+temp[3]+"\\}");
    			        str=str.replace(regxp,"{"+mac[2]+","+mac[3]+"}").replace(/^\//,"").replace(/\/$/,"");
				        $.Datatype[type]=new RegExp(str);
						break reg;
					}	
				}
			}

			if(this.toString.call($.Datatype[type])=="[object RegExp]"){
				return $.Datatype[type].test(gets);
			}

			return false;
		},

		showmsg:function(msg,type,o,show){//o:{obj:当前对象, type:1=>正在检测 | 2=>通过}, show用来判断tiptype=1的情况下是否弹出信息框;
			if(o.type==3){
				errorobj=o.obj;
			}else{
				errorobj && errorobj.removeClass("Validform_error");
				errorobj=null;	
			}
			errorobj && errorobj.addClass("Validform_error");
			if(typeof type == "function"){
				if(!(o.sweep && show=="hide")){
					(type)(msg,o,this.cssctl);
				}
				return false;
			}
			if(type==1 || show=="alwaysshow"){
				msgobj.find(".Validform_info").text(msg);
			}

			if(type==1 && show!="hide" || show=="alwaysshow"){
				msghidden=false;
				msgobj.find(".iframe").css("height",msgobj.outerHeight());
				var left=($(window).width()-msgobj.outerWidth())/2;
				var top=($(window).height()-msgobj.outerHeight())/2;
				top=(document.documentElement.scrollTop?document.documentElement.scrollTop:document.body.scrollTop)+(top>0?top:0);
				msgobj.css({
					"left":left
				}).show().animate({
					top:top
				},100);
			}

			if(type==2 && o.obj){
				o.obj.parent().next().find(".Validform_checktip").text(msg);
				this.cssctl(o.obj.parent().next().find(".Validform_checktip"),o.type);
			}

		},

		checkform:function(obj,parentobj,tiptype,show){//show用来判断是表达提交还是blur事件引发的检测;
			var errormsg=obj.attr("errormsg") || tipmsg.w,
                inputname;

			if(obj.is("[datatype='radio']")){  //判断radio表单元素;
				inputname=obj.attr("name");
				var radiovalue=parentobj.find(":radio[name='"+inputname+"']:checked").val();
				if(!radiovalue){
					this.showmsg(errormsg,tiptype.type,{obj:obj,type:3,sweep:tiptype.sweep},show);
					return false;
				}
				this.showmsg(tipmsg.r,tiptype.type,{obj:obj,type:2,sweep:tiptype.sweep},"hide");
				return "radio";
			}

			if(obj.is("[datatype='checkbox']")){  //判断checkbox表单元素;
				inputname=obj.attr("name");
				var checkboxvalue=parentobj.find(":checkbox[name='"+inputname+"']:checked").val();
				if(!checkboxvalue){
					this.showmsg(errormsg,tiptype.type,{obj:obj,type:3,sweep:tiptype.sweep},show);
					return false;
				}
				this.showmsg(tipmsg.r,tiptype.type,{obj:obj,type:2,sweep:tiptype.sweep},"hide");
				return "checkbox";
			}

			if(obj.is("[datatype='select']")){  //判断select表单元素;
				if(!obj.val()){
				  this.showmsg(errormsg,tiptype.type,{obj:obj,type:3,sweep:tiptype.sweep},show);
				  return false;
				}
				this.showmsg(tipmsg.r,tiptype.type,{obj:obj,type:2,sweep:tiptype.sweep},"hide");
				return "select";
			}
			
			if(obj.is("[datatype*='option_']")){
				obj.removeClass("Validform_error");
				errorobj=null;
				return true;
			}

			var defaultvalue=obj.attr("tip");
			if(($.trim(obj.val())==="" || obj.val()===defaultvalue) && obj.attr("ignore")!="ignore"){
				this.showmsg(obj.attr("nullmsg") || tipmsg.s,tiptype.type,{obj:obj,type:3,sweep:tiptype.sweep},show);
				return false;
			}

			if(obj.attr("recheck")){
				var theother=parentobj.find("input[name='"+obj.attr("recheck")+"']:first");
				if(obj.val()!=theother.val()){
					this.showmsg(errormsg,tiptype.type,{obj:obj,type:3,sweep:tiptype.sweep},show);
					return false;
				}
				this.showmsg(tipmsg.r,tiptype.type,{obj:obj,type:2,sweep:tiptype.sweep},"hide");
			}

			obj.removeClass("Validform_error");
			errorobj=null;
			return true;
		},
		cssctl:function(obj,status){
			switch(status){
				case 1:
					obj.removeClass("Validform_right Validform_wrong").addClass("Validform_checktip Validform_loading");//checking;
					break;
				case 2:
					obj.removeClass("Validform_wrong Validform_loading").addClass("Validform_checktip Validform_right");//passed;
					break;
				case 4:
					obj.removeClass("Validform_right Validform_wrong Validform_loading").addClass("Validform_checktip");//for ignore;
					break;
				default:
					obj.removeClass("Validform_right Validform_loading").addClass("Validform_checktip Validform_wrong");//wrong;
			}	
		}

	};

	//公用方法显示&关闭信息提示框;
	$.Showmsg=function(msg){
		creatMsgbox();
		$.fn.Validform.sn.showmsg(msg,1,{});
	};
	$.Hidemsg=function(){
		msgobj.hide();
		msghidden=true;
	};
	$.Datatype={
		"match":/^(.+)(\d+)-(\d+)$/,
		"*":/.+/,
		"*6-16":/^.{6,16}$/,
		"n":/^\d+$/,
		"n6-16":/^\d{6,16}$/,
		"s":/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]+$/m,
		"s6-18":/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{6,18}$/,
		"p":/^[0-9]{6}$/,
		"m":/^13[0-9]{9}$|15[0-9]{9}$|18[0-9]{9}$/,
		"e":/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
		"url":/^(\w+:\/\/)?\w+(\.\w+)+$/
	};
})(jQuery);