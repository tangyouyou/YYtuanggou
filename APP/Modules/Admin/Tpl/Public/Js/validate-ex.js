/*
 * jQuery validation 验证类型扩展
 *
 * 扩展的验证类型：用户名，邮政编码，大陆身份证号码，大陆手机号码,电话号码
 * 
 * 2010-06-17 by 刘仁飞
 */
 // 邮政编码验证    
jQuery.validator.addMethod("isZipCode", function(value, element) {    
  var zip = /^[0-9]{6}$/;    
  return this.optional(element) || (zip.test(value));    
}, "请正确填写您的邮政编码!");        
// 身份证号码验证
jQuery.validator.addMethod("isIdCardNo", function(value, element) { 
  var idCard = /^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\w)$/;   
  return this.optional(element) || (idCard.test(value));    
}, "请输入正确的身份证号码!"); 

// 手机号码验证    
jQuery.validator.addMethod("isMobile", function(value, element) {    
  var length = value.length;    
  return this.optional(element) || (length == 11 && /^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/.test(value));    
}, "请正确填写您的手机号码!");

// 电话号码验证    
jQuery.validator.addMethod("isPhone", function(value, element) {    
  var tel = /^(\d{3,4}-?)?\d{7,9}$/g;    
  return this.optional(element) || (tel.test(value));    
}, "请正确填写您的电话号码!")

// 用户名字符验证    
jQuery.validator.addMethod("userName", function(value, element) {    
  return this.optional(element) || /^[\u0391-\uFFE5\w]+$/.test(value);    
}, "用户名只能包括中文字、英文字母、数字和下划线!");   

// 联系电话(手机/电话皆可)验证   
jQuery.validator.addMethod("isTel", function(value,element) {   
    var length = value.length;   
    var mobile = /^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/;   
    var tel = /^\d{3,4}-?\d{7,9}$/;   
    return this.optional(element) || (tel.test(value) || mobile.test(value));   
}, "请正确填写您的联系电话!");  

// IP地址验证   
jQuery.validator.addMethod("ip", function(value, element) {    
  return this.optional(element) || /^(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.)(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.){2}([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))$/.test(value);    
}, "请填写正确的IP地址！");

//身份证号码的验证规则
function isIdCardNo(num){ 
　//　 if (isNaN(num)) {alert("输入的不是数字！"); return false;} 
　　 var len = num.length, re; 
　　 if (len == 15) 
　　 re = new RegExp(/^(\d{6})()?(\d{2})(\d{2})(\d{2})(\d{2})(\w)$/); 
　　 else if (len == 18) 
　　 re = new RegExp(/^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\w)$/); 
　　 else {alert("输入的数字位数不对！"); return false;} 
　　 var a = num.match(re); 
　　 if (a != null) 
　　 { 
　　 if (len==15) 
　　 { 
　　 var D = new Date("19"+a[3]+"/"+a[4]+"/"+a[5]); 
　　 var B = D.getYear()==a[3]&&(D.getMonth()+1)==a[4]&&D.getDate()==a[5]; 
　　 } 
　　 else 
　　 { 
　　 var D = new Date(a[3]+"/"+a[4]+"/"+a[5]); 
　　 var B = D.getFullYear()==a[3]&&(D.getMonth()+1)==a[4]&&D.getDate()==a[5]; 
　　 } 
　　 if (!B) {alert("输入的身份证号 "+ a[0] +" 里出生日期不对！"); return false;} 
　　 } 
　　  if(!re.test(num)){alert("身份证最后一位只能是数字和字母!");return false;}
　　  
　　 return true; 
} 

