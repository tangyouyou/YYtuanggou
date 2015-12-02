$(function(){
	sidebarControl();
})

function sidebarControl(){
	var oSidebar = $('#sidebar');
	var aMenu = oSidebar.find('.menu');
	var aTitle = aMenu.find('.title'),oMenuList;

	aTitle.toggle(function(){
		oMenuList =  $(this).parent().find('.menuList');
		$(this).addClass('active');
		oMenuList.hide();
	},function(){
		$(this).removeClass('active');
		oMenuList.show();
	})

	var aNavList = $('#header .nav a');
	var aMenuItem =  $('#sidebar .menuItem');
	aNavList.each(function(index){
		$(this).click(function(){
			aNavList.removeClass('active');
			$(this).addClass('active');
			aMenuItem.hide();
			aMenuItem.eq(index).show();
		})
	})
}