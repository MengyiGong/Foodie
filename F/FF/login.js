/**
* @author moufer<moufer@163.com>
* @copyright www.modoer.com
*/

function login_read() {
	var activationauth = get_cookie('activationauth');
	var hash = get_cookie('hash');
	var myauth = get_cookie('myauth');

	if(!activationauth && !hash && !myauth) {
		$('#login_0').show();
		$('#login_1').hide();
		$('#login_2').hide();
		return;
	}

	$.post(Url('member/login/op/check'), { in_ajax:1 }, 
	function(result) {
		if(result.match(/\{\s+caption:".*",message:".*".*\s*\}/)) {
			myAlert(result);
		} else if(result) {
			var login = eval('('+result+')'); //JSON转换
			if(login.type == 'activationauth') {
				$('#login_activation').html(login.username);
				var href = $('#login_activation_a').attr('href');
				href = href.replace('_activationauth_', get_cookie('activationauth'));
				$('#login_activation_a').attr('href', href);
				$('#login_0').hide();
				$('#login_btn_0').hide();
				$('#login_1').hide();
				$('#login_2').show();
			} else {
				$('#login_name').html(login.username);
				$('#login_0').hide();
				$('#login_btn_0').hide();
				$('#login_1').show();
				$('#login_2').hide();
				if(login.newmsg > 0) $('#login_newmsg').html('('+login.newmsg+')').css('display','').toggleClass('font_1');
			}
		}
	});
}


   login_read();
