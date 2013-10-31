$(function(){
    $('#login_form').ajaxForm({
        dataType:'json',
        success: function(response){
            if (response.success) {
                $S.redirect("/", 10);
            }else{
                $S.alert(response.message.join('，'),2000);
            }
        },
        error: function() {
            $S.error('发生技术问题，导致你的操作失败。请联系管理员！');
        }
    });

    $(".logout-btn").click(function(){
        $.ajax({
            url: '/logout',
            type: 'post',
            dataType:'json',
            cache: false,
            statusCode:{
                403: function() {
                    $S.alert('权限不足，操作失败', 2000);
                },
                404: function () {
                    $S.alert('请求的页面不存在或被删除', 2000);
                }
            },
            success: function(response){
                if (response.success) {
                    $S.redirect("/",10);
                }else{
                    $S.alert(response.message.join('，'),2000);
                }
            },
            error: function() {
                $S.error('发生技术问题，操作失败。请联系管理员');
            }
        });
    });
});
