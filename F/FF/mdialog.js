/**
* @author moufer<moufer@163.com>
* @copyright www.modoer.com
*/
var DLOGID = "MODOER_DIALOG";
var SRCEENID = 'MODOER_SCREENOVER';
var MSGID = "MODOER_MESSAGE";
var SRARTMOVE = 0;
var MOVEX = 0;
var MOVEY = 0;
var MSGTIME = 0;

function dlgOpen(title, body, width, height) {
	if($("#"+DLOGID)[0] != null) {
		return;
	}
	srceenOpen();
	var dlg = $("<div></div>").attr("id",DLOGID);
	var p = winAxis(width, height);
	dlg.css({ 
		top:p.y, left:p.x, display:"block", margin:"0px", padding:"0px",
		width:width, height:height, position:"absolute", zIndex:"1100"
	});
	dlg.addClass("mdialog");
	dlg.append($("<div></div>").html("<em></em><span></span>"));
	dlg.find("div").addClass("mheader");
	dlg.find("div").mousedown(dlgDown).mousemove(dlgMove).mouseup(dlgUp).mouseout(dlgOut);
	dlg.find("div > span").text(title);
	dlg.find("div > em").click(dlgClose);
	dlg.append($("<div></div>").addClass("mbody").append(body));
	if($.browser.msie && $.browser.version.substr(0,1)=='6' ) {
		$("select").each(function(i) { 
			this.style.visibility="hidden";
		});
	}
	if($.browser.msie) {
		$("embed").each(function(i) {
			this.style.visibility="hidden";
		});
	}
	//dlg.css('display','none');
	$(document.body).append(dlg);
	//dlg.fadeIn('fast');
}

function dlgClose() {
	if(arguments[0]!='1') srceenClose();
	if($("#"+DLOGID)[0]!=null) {
		var ifme = $("#"+DLOGID).find('iframe');
		if(ifme[0]!=null) ifme.remove();
		$("#"+DLOGID).remove();
	}
	if($.browser.msie && $.browser.version.substr(0,1)=='6' ) {
		$("select").each(function(i) { 
			this.style.visibility = "";
		});
	}
	if($.browser.msie) {
		$("embed").each(function(i) {
			this.style.visibility = "";
		});
	}
}

function dlgSize(width, height) {
	if($("#"+DLOGID)[0]!=null) {
		$("#"+DLOGID).css({ 
			width:width, height:height
		});
	}
}

function winAxis(width, height) {
	var dde = document.documentElement;
	if (window.innerWidth) {
		var ww = window.innerWidth;
		var wh = window.innerHeight;
		var bgX = window.pageXOffset;
		var bgY = window.pageYOffset;
	} else {
		var ww = dde.offsetWidth;
		var wh = dde.offsetHeight;
		var bgX = dde.scrollLeft;
		var bgY = dde.scrollTop;
	}
	x = bgX + ((ww - width)/2);
	y = bgY + ((wh - height)/2);
	return {x:x, y:y};
}

function dlgDown() {
	SRARTMOVE = true;
}

function dlgMove(e) {
	if(!SRARTMOVE) return;
	var dlg = $("#"+DLOGID);
	var bar = $("#"+DLOGID).find("div > span");
	var left = parseInt(dlg.css("left").replace('px','')); // x
	var top = parseInt(dlg.css("top").replace('px',''));   // y
	var mX = MOVEX == 0 ? 0 : MOVEX - e.pageX;
	var mY = MOVEX == 0 ? 0 : MOVEY - e.pageY;
	var newleft = left - mX;
	var newtop = top - mY;
	
	//bar.text(e.pageX+','+e.pageY+'|'+top+','+left+'|'+newleft+','+newtop);

	MOVEX = e.pageX;
	MOVEY = e.pageY;

	dlg.css({"top":newtop+"px", "left":newleft+"px"});
	
}

function dlgUp() {
	//settimeout
	SRARTMOVE = false;
	MOVEX = MOVEY = 0;
	//setTimeout('endDrag()',5);
}

function dlgOut() {
	dlgUp();
}

function endDrag() {
	var dlg = $("#"+DLOGID);
	var left = parseInt(dlg.css("left").replace('px','')); // x
	var top = parseInt(dlg.css("top").replace('px',''));   // y
	var right = left + parseInt(dlg.css("width").replace('px','')); // x
	var bottom = top + parseInt(dlg.css("height").replace('px',''));   // y
}

function getPosition(e) {
	var left = 0;
	var top  = 0;
	while (e.offsetParent){
		left += e.offsetLeft + (e.currentStyle?(parseInt(e.currentStyle.borderLeftWidth)).NaN0():0);
		top  += e.offsetTop  + (e.currentStyle?(parseInt(e.currentStyle.borderTopWidth)).NaN0():0);
		e     = e.offsetParent;
	}
	left += e.offsetLeft + (e.currentStyle?(parseInt(e.currentStyle.borderLeftWidth)).NaN0():0);
	top  += e.offsetTop  + (e.currentStyle?(parseInt(e.currentStyle.borderTopWidth)).NaN0():0);
	return {x:left, y:top};
}

function msgOpen() {
	
	if(arguments.length == 0) return;

	var body = arguments[0];
	var width = typeof(arguments[1]) == 'undefined' ? 250 : arguments[1];
	var height = typeof(arguments[2]) == 'undefined' ? 50 : arguments[2];

	if($("#"+MSGID)[0] != null) {
		return;
	}
	var msg = $("<div></div>").attr("id",MSGID);
	var p = winAxis(width, height);
	msg.css({ 
		top:p.y, left:p.x, display:"block", margin:"0px", padding:"0px",
		width:width+'px', height:height+'px', position:"absolute", zIndex:"1105",
		"line-height":height+'px'
	});
	msg.addClass("mmessage");
	msg.append($("<div></div>").addClass("mbody").append(body)).click(msgClose);

	if($.browser.msie && $.browser.version.substr(0,1)=='6' ) {
		$("select").each(function(i) {
			this.style.visibility="hidden";
		});
	}

	$(document.body).append(msg);
	MSGTIME = window.setTimeout("msgClose();", 3000);
}

function msgClose() {
	if($("#"+MSGID)[0]!=null) {
		$("#"+MSGID).remove();
	}
	if($.browser.msie && $.browser.version.substr(0,1)=='6' ) {
		$("select").each(function(i) { 
			this.style.visibility = "";
		});
	}
	window.clearTimeout(MSGTIME);
}

function srceenOpen() {
	if($('#'+SRCEENID)[0]!=null) return;
	var wh = "100%";
	if (document.documentElement.clientHeight && document.body.clientHeight) {
		if (document.documentElement.clientHeight > document.body.clientHeight) {
			wh = document.documentElement.clientHeight + "px";
		} else {
			wh = document.body.clientHeight + "px";
		}
	} else if (document.body.clientHeight) {
		wh = document.body.clientHeight + "px";
	} else if (window.innerHeight) {
		wh = window.innerHeight + "px";
	}
	var o = 40/100;
	var scr = $('<div></div>').attr("id", SRCEENID).css({
			display:"block", top:"0px", left:"0px", margin:"0px", padding:"0px",
			width:"100%", height:wh, position:"absolute", zIndex:1099, background:"#8A8A8A",
			filter:"alpha(opacity=25)", opacity:o, MozOpacity:o, display:"none"
	});
	$(document.body).append(scr);
	$('#'+SRCEENID).fadeIn("fast");
}

function srceenClose() {
	$('#'+SRCEENID).fadeOut("fast", function() {
		$('#'+SRCEENID).remove();
	});
}

jQuery.mytip = {
	show:function() {   
		var ld = $('#ajax_loading');
		if(!ld[0]) {
			ld = $('<div>loading...</div>')
				.attr('id','ajax_loading');
		}
		ld.css({"display":"none","background":"red","color":"#FFF","padding":"2px 5px","z-index":"1000"});
		$(document.body).append(ld);
		if(typeof(arguments[0]) == 'string') ld.html(arguments[0]);
		ld.css("position", "absolute")
			.css("top", document.documentElement.scrollTop + 5)
			.css("left", window.document.documentElement.clientWidth - ld.width()-15)
			.show();  
	},
	close:function() {
		var ld = $('#ajax_loading');
		if(typeof(arguments[0]) == 'string') {
			ld.html(arguments[0])
				.css("top", document.documentElement.scrollTop + 5)
				.css("left", window.document.documentElement.clientWidth - ld.width()-15)
			window.setTimeout(function() {
				ld.fadeOut('normal',function(){ld.remove()});
			},800);
		} else {
			ld.fadeOut('normal',function(){ld.remove()});
		}
		  
	}
};

(function($) {
	$.fn.mchecklist = function(options) {
		$.fn.mchecklist.defaults = {
			css_class:'mchecklist',
			line_num:3,
			height:75,
			width:500,
			perch:null,
			linkage:null
		}
		var opts = $.extend({}, $.fn.mchecklist.defaults, options);
		var my = $(this);
		var myid = $(this).attr('id');
		var mcl = $('#'+myid + '_mcl');
		var nums = 0;
		if(mcl[0]) mcl.remove();
		mcl = $('<div></div>').attr('id', myid + '_mcl').addClass(opts.css_class);
		var info = $('<div class="mchecklist-info"></div>');
		var checks = $('<ul class="mchecklist-box"></ul>').css({"max-height":opts.height+50,"width":opts.width});
		my.hide();
		if(opts.linkage) {
			$('#'+opts.linkage.id).bind(opts.linkage.bind, function() {
				init_box();
			});
		}

		init_box();

		function init_box() {
			checks.empty();
			my.find('option').each(function (i) {
				nums++;
				var opt = $(this);
				var id = myid + '_check_' + i;
				var check = $("<input type=\"checkbox\">").attr({
						'id':id,
						'value':opt.val(),
						'checked':$(this).attr('selected'),
						'text':$(this).text()
					}).click(function () {
						opt.attr("selected",$(this).attr('checked'));
						set_info();
					});
				var lbl = $("<label></label>").text($(this).text()).attr('for',id);
				var num = round(100 / opts.line_num) - 3;
				var foo = $("<li></li>").css("float","left").css("width",num+"%").css("height","20px");
				checks.append(foo.append(check).append(lbl));
			});
			my.parent().append(mcl.append(checks).append('<div style="clear:both"></div>').append(info));
			if($.browser.msie) checks.css({"height":opts.height});
			set_info();
			if(!nums) mcl.remove();
		}

		function set_info () {
			var txt=split='';
			checks.find('input').each(function (i) {
				if($(this).attr('checked')) {
					txt += split+ $(this).attr('text');
					split='<span class="mchecklist-split">,</span>';
				}
			});
			if(txt=='') {
				txt = '没有选择任何信息.';
			} else {
				txt = '已选择<span class="mchecklist-split">:</span>' + txt;
			}
			info.html(txt);
		}
	}
})(jQuery);

/*
 * jquery.powerFloat.js
 * http://www.zhangxinxu.com/wordpress/?p=1328
 */
/**/

(function($){$.fn.powerFloat=function(options){return $(this).each(function(){var s=$.extend({},defaults,options||{});var init=function(pms,trigger){if(o.target&&o.target.css("display")!=="none"){o.targetClear();}o.s=pms;o.trigger=trigger;};switch(s.eventType){case"hover":{$(this).hover(function(){init(s,$(this));var numShowDelay=parseInt(s.showDelay,10),hoverTimer;if(numShowDelay){if(hoverTimer){clearTimeout(hoverTimer);}hoverTimer=setTimeout(function(){o.targetGet();},numShowDelay);}else{o.targetGet();}},function(){o.flagDisplay=false;o.targetHold();if(s.hoverHold){setTimeout(function(){o.displayDetect();},200);}else{o.displayDetect();}});if(s.hoverFollow){$(this).mousemove(function(e){o.cacheData.left=e.pageX;o.cacheData.top=e.pageY;o.targetGet();return false;});}break;}case"click":{$(this).click(function(e){if(o.flagDisplay&&e.target===o.trigger.get(0)){o.flagDisplay=false;o.displayDetect();}else{init(s,$(this));o.targetGet();if(!$(document).data("mouseupBind")){$(document).bind("mouseup",function(e){var flag=false;$(e.target).parents().each(function(){if(o.target&&$(this).attr("id")==o.target.attr("id")){flag=true;}});if(s.eventType==="click"&&o.flagDisplay&&e.target!=o.trigger.get(0)&&!flag){o.flagDisplay=false;o.displayDetect();}return false;}).data("mouseupBind",true);}}});break;}case"focus":{$(this).focus(function(){var self=$(this);setTimeout(function(){init(s,self);o.targetGet();},200);}).blur(function(){o.flagDisplay=false;setTimeout(function(){o.displayDetect();},190);});break;}default:{init(s,$(this));o.targetGet();$(document).unbind("mouseup");}}});};var o={targetGet:function(){if(!this.trigger){return this;}var attr=this.trigger.attr(this.s.targetAttr),target=this.s.target;switch(this.s.targetMode){case"common":{if(target){var type=typeof(target);if(type==="object"){if(target.size()){o.target=target.eq(0);}}else if(type==="string"){if($(target).size()){o.target=$(target).eq(0);}}}else{if(attr&&$("#"+attr).size()){o.target=$("#"+attr);}}if(o.target){o.targetShow();}else{return this;}break;}case"ajax":{var url=target||attr;this.targetProtect=false;if(/(\.jpg|\.png|\.gif|\.bmp|\.jpeg)$/i.test(url)){if(o.cacheData[url]){o.target=$(o.cacheData[url]);o.targetShow();}else{var tempImage=new Image();o.loading();tempImage.onload=function(){var w=tempImage.width,h=tempImage.height;var winw=$(window).width(),winh=$(window).height();var imgScale=w/h,winScale=winw/winh;if(imgScale>winScale){if(w>winw/2){w=winw/2;h=w/imgScale;}}else{if(h>winh/2){h=winh/2;w=h*imgScale;}}var imgHtml='<img class="float_ajax_image" src="'+url+'" width="'+w+'" height = "'+h+'" />';o.cacheData[url]=imgHtml;o.target=$(imgHtml);o.targetShow();};tempImage.onerror=function(){o.target=$('<div class="float_ajax_error">图片加载失败。</div>');o.targetShow();};tempImage.src=url;}}else{if(url){if(o.cacheData[url]){o.target=$('<div class="float_ajax_data">'+o.cacheData[url]+'</div>');o.targetShow();}else{o.loading();$.ajax({url:url,success:function(data){if(typeof(data)==="string"){o.target=$('<div class="float_ajax_data">'+data+'</div>');o.targetShow();o.cacheData[url]=data;}},error:function(){o.target=$('<div class="float_ajax_error">数据没有加载成功。</div>');o.targetShow();}});}}}break;}case"list":{var targetHtml='<ul class="float_list_ul">',arrLength;if($.isArray(target)&&(arrLength=target.length)){$.each(target,function(i,obj){var list="",strClass="",text,href;if(i===0){strClass=' class="float_list_li_first"';}if(i===arrLength-1){strClass=' class="float_list_li_last"';}if(typeof(obj)==="object"&&(text=obj.text.toString())){if(href=(obj.href||"javascript:")){list='<a href="'+href+'" class="float_list_a">'+text+'</a>';}else{list=text;}}else if(typeof(obj)==="string"&&obj){list=obj;}if(list){targetHtml+='<li'+strClass+'>'+list+'</li>';}});}else{targetHtml+='<li class="float_list_null">列表无数据。</li>';}targetHtml+='</ul>';o.target=$(targetHtml);this.targetProtect=false;o.targetShow();break;}case"remind":{var strRemind=target||attr;this.targetProtect=false;if(typeof(strRemind)==="string"){o.target=$('<span>'+strRemind+'</span>');o.targetShow();}break;}default:{var objOther=target||attr,type=typeof(objOther);if(objOther){if(type==="string"){if(/<.*>/.test(objOther)){o.target=$('<div>'+objOther+'</div>');this.targetProtect=false;}else if($(objOther).size()){o.target=$(objOther).eq(0);this.targetProtect=true;}else if($("#"+objOther).size()){o.target=$("#"+objOther).eq(0);this.targetProtect=true;}else{o.target=$('<div>'+objOther+'</div>');this.targetProtect=false;}o.targetShow();}else if(type==="object"){if(!$.isArray(objOther)&&objOther.size()){o.target=objOther.eq(0);this.targetProtect=true;o.targetShow();}}}}}return this;},container:function(){var cont=this.s.container,mode=this.s.targetMode||"mode";if(mode==="ajax"||mode==="remind"){this.s.sharpAngle=true;}else{this.s.sharpAngle=false;}if(this.s.reverseSharp){this.s.sharpAngle=!this.s.sharpAngle;}if(mode!=="common"){if(cont===null){cont="plugin";}if(cont==="plugin"){if(!$("#floatBox_"+mode).size()){$('<div id="floatBox_'+mode+'" class="float_'+mode+'_box"></div>').appendTo($("body")).hide();}cont=$("#floatBox_"+mode);}if(cont&&typeof(cont)!=="string"&&cont.size()){if(this.targetProtect){o.target.show().css("position","static");}o.target=cont.empty().append(o.target);}}return this;},setWidth:function(){var w=this.s.width;if(w==="auto"){if(this.target.get(0).style.width){this.target.css("width","auto");}}else if(w==="inherit"){this.target.width(this.trigger.width());}else{this.target.css("width",w);}return this;},position:function(){var pos,tri_h=0,tri_w=0,cor_w=0,cor_h=0,tri_l,tri_t,tar_l,tar_t,cor_l,cor_t,tar_h=this.target.data("height"),tar_w=this.target.data("width"),st=$(window).scrollTop(),off_x=parseInt(this.s.offsets.x,10)||0,off_y=parseInt(this.s.offsets.y,10)||0,mousePos=this.cacheData;if(!tar_h){tar_h=this.target.outerHeight();if(this.s.hoverFollow){this.target.data("height",tar_h);}}if(!tar_w){tar_w=this.target.outerWidth();if(this.s.hoverFollow){this.target.data("width",tar_w);}}pos=this.trigger.offset();tri_h=this.trigger.outerHeight();tri_w=this.trigger.outerWidth();tri_l=pos.left;tri_t=pos.top;var funMouseL=function(){if(tri_l<0){tri_l=0;}else if(tri_l+tri_h>$(window).width()){tri_l=$(window).width()=tri_h;}},funMouseT=function(){if(tri_t<0){tri_t=0;}else if(tri_t+tri_h>$(document).height()){tri_t=$(document).height()-tri_h;}};if(this.s.hoverFollow&&mousePos.left&&mousePos.top){if(this.s.hoverFollow==="x"){tri_l=mousePos.left
funMouseL();}else if(this.s.hoverFollow==="y"){tri_t=mousePos.top;funMouseT();}else{tri_l=mousePos.left;tri_t=mousePos.top;funMouseL();funMouseT();}}var arrLegalPos=["4-1","1-4","5-7","2-3","2-1","6-8","3-4","4-3","8-6","1-2","7-5","3-2"],align=this.s.position,alignMatch=false,strDirect;$.each(arrLegalPos,function(i,n){if(n===align){alignMatch=true;return;}});if(!alignMatch){align="4-1";}var funDirect=function(a){var dir="bottom";switch(a){case"1-4":case"5-7":case"2-3":{dir="top";break;}case"2-1":case"6-8":case"3-4":{dir="right";break;}case"1-2":case"8-6":case"4-3":{dir="left";break;}case"4-1":case"7-5":case"3-2":{dir="bottom";break;}}return dir;};var funCenterJudge=function(a){if(a==="5-7"||a==="6-8"||a==="8-6"||a==="7-5"){return true;}return false;};var funJudge=function(dir){var totalHeight=0,totalWidth=0,flagCorner=(o.s.sharpAngle&&o.corner)?true:false;if(dir==="right"){totalWidth=tri_l+tri_w+tar_w+off_x;if(flagCorner){totalWidth+=o.corner.width();}if(totalWidth>$(window).width()){return false;}}else if(dir==="bottom"){totalHeight=tri_t+tri_h+tar_h+off_y;if(flagCorner){totalHeight+=o.corner.height();}if(totalHeight>st+$(window).height()){return false;}}else if(dir==="top"){totalHeight=tar_h+off_y;if(flagCorner){totalHeight+=o.corner.height();}if(totalHeight>tri_t-st){return false;}}else if(dir==="left"){totalWidth=tar_w+off_x;if(flagCorner){totalWidth+=o.corner.width();}if(totalWidth>tri_l){return false;}}return true;};strDirect=funDirect(align);if(this.s.sharpAngle){this.createSharp(strDirect);}if(this.s.edgeAdjust){if(funJudge(strDirect)){(function(){if(funCenterJudge(align)){return;}var obj={top:{right:"2-3",left:"1-4"},right:{top:"2-1",bottom:"3-4"},bottom:{right:"3-2",left:"4-1"},left:{top:"1-2",bottom:"4-3"}};var o=obj[strDirect],name;if(o){for(name in o){if(!funJudge(name)){align=o[name];}}}})();}else{(function(){if(funCenterJudge(align)){var center={"5-7":"7-5","7-5":"5-7","6-8":"8-6","8-6":"6-8"};align=center[align];}else{var obj={top:{left:"3-2",right:"4-1"},right:{bottom:"1-2",top:"4-3"},bottom:{left:"2-3",right:"1-4"},left:{bottom:"2-1",top:"3-4"}};var o=obj[strDirect],arr=[];for(name in o){arr.push(name);}if(funJudge(arr[0])||!funJudge(arr[1])){align=o[arr[0]];}else{align=o[arr[1]];}}})();}}var strNewDirect=funDirect(align),strFirst=align.split("-")[0];if(this.s.sharpAngle){this.createSharp(strNewDirect);cor_w=this.corner.width(),cor_h=this.corner.height();}if(this.s.hoverFollow){if(this.s.hoverFollow==="x"){tar_l=tri_l+off_x;if(strFirst==="1"||strFirst==="8"||strFirst==="4"){tar_l=tri_l-(tar_w-tri_w)/2+off_x;}else{tar_l=tri_l-(tar_w-tri_w)+off_x;}if(strFirst==="1"||strFirst==="5"||strFirst==="2"){tar_t=tri_t-off_y-tar_h-cor_h;cor_t=tri_t-cor_h-off_y-1;}else{tar_t=tri_t+tri_h+off_y+cor_h;cor_t=tri_t+tri_h+off_y+1;}cor_l=pos.left-(cor_w-tri_w)/2;}else if(this.s.hoverFollow==="y"){if(strFirst==="1"||strFirst==="5"||strFirst==="2"){tar_t=tri_t-(tar_h-tri_h)/2+off_y;}else{tar_t=tri_t-(tar_h-tri_h)+off_y;}if(strFirst==="1"||strFirst==="8"||strFirst==="4"){tar_l=tri_l-tar_w-off_x-cor_w;cor_l=tri_l-cor_w-off_x-1;}else{tar_l=tri_l+tri_w-off_x+cor_w;cor_l=tri_l+tri_w+off_x+1;}cor_t=pos.top-(cor_h-tri_h)/2;}else{tar_l=tri_l+off_x;tar_t=tri_t+off_y;}}else{switch(strNewDirect){case"top":{tar_t=tri_t-off_y-tar_h-cor_h;if(strFirst=="1"){tar_l=tri_l-off_x;}else if(strFirst==="5"){tar_l=tri_l-(tar_w-tri_w)/2-off_x;}else{tar_l=tri_l-(tar_w-tri_w)-off_x;}cor_t=tri_t-cor_h-off_y-1;cor_l=tri_l-(cor_w-tri_w)/2;break;}case"right":{tar_l=tri_l+tri_w+off_x+cor_w;if(strFirst=="2"){tar_t=tri_t+off_y;}else if(strFirst==="6"){tar_t=tri_t-(tar_h-tri_h)/2+off_y;}else{tar_t=tri_t-(tar_h-tri_h)+off_y;}cor_l=tri_l+tri_w+off_x+1;cor_t=tri_t-(cor_h-tri_h)/2;break;}case"bottom":{tar_t=tri_t+tri_h+off_y+cor_h;if(strFirst=="4"){tar_l=tri_l+off_x;}else if(strFirst==="7"){tar_l=tri_l-(tar_w-tri_w)/2+off_x;}else{tar_l=tri_l-(tar_w-tri_w)+off_x;}cor_t=tri_t+tri_h+off_y+1;cor_l=tri_l-(cor_w-tri_w)/2;break;}case"left":{tar_l=tri_l-tar_w-off_x-cor_w;if(strFirst=="1"){tar_t=tri_t-off_y;}else if(strFirst=="8"){tar_t=tri_t-(tar_h-tri_h)/2-off_y;}else{tar_t=tri_t-(tar_h-tri_h)-off_y;}cor_l=tar_l+tar_w-1;cor_t=tri_t+(tri_h-cor_h)/2;break;}}}if(cor_h&&cor_w&&this.corner){this.corner.css({left:cor_l,top:cor_t,zIndex:this.s.zIndex+1});}this.target.css({position:"absolute",left:tar_l,top:tar_t,zIndex:this.s.zIndex});return this;},createSharp:function(dir){var bgColor,bdColor,color1="",color2="";var objReverse={left:"right",right:"left",bottom:"top",top:"bottom"},dirReverse=objReverse[dir]||"top";if(this.target){bgColor=this.target.css("background-color");if(parseInt(this.target.css("border-"+dirReverse+"-width"))>0){bdColor=this.target.css("border-"+dirReverse+"-color");}if(bdColor&&bdColor!=="transparent"){color1='style="color:'+bdColor+';"';}else{color1='style="display:none;"';}if(bgColor&&bgColor!=="transparent"){color2='style="color:'+bgColor+';"';}else{color2='style="display:none;"';}}var html='<div id="floatCorner_'+dir+'" class="float_corner float_corner_'+dir+'">'+'<span class="corner corner_1" '+color1+'>◆</span>'+'<span class="corner corner_2" '+color2+'>◆</span>'+'</div>';if(!$("#floatCorner_"+dir).size()){$("body").append($(html));}this.corner=$("#floatCorner_"+dir);return this;},targetHold:function(){if(this.s.hoverHold){var delay=parseInt(this.s.hideDelay,10)||200;this.target.hover(function(){o.flagDisplay=true;},function(){o.flagDisplay=false;setTimeout(function(){o.displayDetect();},delay);});}return this;},loading:function(){this.target=$('<div class="float_loading"></div>');this.targetShow();this.target.removeData("width").removeData("height");return this;},displayDetect:function(){if(!this.flagDisplay){this.targetHide();}return this;},targetShow:function(){o.cornerClear();this.flagDisplay=true;this.container().setWidth().position();this.target.show();if($.isFunction(this.s.showCall)){this.s.showCall.call(this.trigger,this.target);}return this;},targetHide:function(){this.flagDisplay=false;this.targetClear();this.cornerClear();if($.isFunction(this.s.hideCall)){this.s.hideCall.call(this.trigger);}this.target=null;this.trigger=null;this.s={};this.targetProtect=false;return this;},targetClear:function(){if(this.target){if(this.target.data("width")){this.target.removeData("width").removeData("height");}if(this.targetProtect){this.target.children().hide().appendTo($("body"));}this.target.unbind().hide();}},cornerClear:function(){if(this.corner){this.corner.remove();}},target:null,trigger:null,s:{},cacheData:{},targetProtect:false};$.powerFloat={};$.powerFloat.hide=function(){o.targetHide();};var defaults={width:"auto",offsets:{x:0,y:0},zIndex:999,eventType:"hover",showDelay:0,hideDelay:0,hoverHold:true,hoverFollow:false,targetMode:"common",target:null,targetAttr:"rel",container:null,reverseSharp:false,position:"4-1",edgeAdjust:true,showCall:$.noop,hideCall:$.noop};})(jQuery);
