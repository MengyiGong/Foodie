loadscript("mdialog");

function check_username(obj) {
	if(!obj.value) {
		$('#msg_username').html('<span class="font_1">请输入会员名称.</span>').show();
		return;
	}
	$.post(Url('member/reg/op/check_username'), {'username':obj.value,'in_ajax':1}, function(data) {
		$('#msg_username').html(data).show();
	});
}

function check_email(obj) {
	if(!obj.value) {
		$('#msg_email').html('<span class="font_1">请输入E-mail地址.</span>').show();
		return;
	}
	$.post(Url('member/reg/op/check_email'), {'email':obj.value,'in_ajax':1}, function(data) {
		$('#msg_email').html(data).show();
	});
}

function send_message(recvuid, subject) {
	if(!subject) subject = '';
	$.post(Url('member/index/ac/pm/op/write'), { recvuid:recvuid, subject:subject, in_ajax:1 }, 
	function(result) {
		if(result.match(/\{\s+caption:".*",message:".*".*\s*\}/)) {
			myAlert(result);
		} else {
			dlgOpen('发送短信', result, 500, 285);
		}
	});
}

function checkpm() {
	var form = document.getElementById('pmform');
	
	if(form.recv_users.value == ''){
		msgOpen('未添加发送对象。');
		return false;
	} else if(form.subject.value == '') {
		msgOpen('未填写短信主题。');
		return false;
	} else if(form.subject.value.length > 60) {
		msgOpen('短信主题不能超过60个字符。');
		return false;
	} else if(form.content.value == '') {
		msgOpen('未填写短信内容。');
		return false;
	} else if(form.content.value.length > 500) {
		msgOpen('短信内容不能超过500个字符。');
		return false;
	}
	return true;
}

function add_friend(friend_uid) {
	if(!is_numeric(friend_uid)) { alert('无效的UID'); return; }
	$.post(Url('member/index/ac/friend/op/add'), { friend_uid:friend_uid, in_ajax:1}, 
	function(result) {
		if(result.match(/\{\s+caption:".*",message:".*".*\s*\}/)) {
			myAlert(result);
		} else {
			dlgOpen('添加好友', result, 500, 220);
		}
	});
}

function post_addfriend() {
	var form = document.addfriendfrm;
	if(!is_numeric(form.friendid.value)){
		alert('会员不存在，无法添加。');
		return false;
	} else if(form.content.value.length > 300) {
		alert('对好友的留言不能超过300个字，请精简一下留言。');
		return false;
	}

	return true;
}