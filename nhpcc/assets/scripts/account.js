$(function(){
	$('#login_form').ajaxForm({
		dataType:'json',
		success: function(response){
			if (response.success) {
				$S.notice(response.message.join('，'),2000);
				setTimeout(function(){
					$S.redirct('account');
				}, 2000);
			}else{
				$S.alert(response.message.join('，'),2000);
			}
		},
		error: function() {
			$S.error('发生技术问题，导致你的报名失败。请联系管理员！');
		}
	});
});