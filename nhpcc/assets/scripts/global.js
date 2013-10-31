(function(window, $) {    
    var nhpcc = {};

    // 初始化全站统一元素
    nhpcc.elementInit = function() {
        $('body').prepend($('<div id="message-box"></div>')); // 信息框容器
    };

    // 全站统一信息提示框
    nhpcc._messagebox = function(message, timeout, specialClass) {
        var entity = $('<div class="message-content"></div>')
            .hide()
            .append($('<span class="message-text"></span>').append(message))
            .append($('<a href="javascript:void(0);" class="button message-close-btn">关闭</a>'))
            .addClass(specialClass);

        $('#message-box').append(entity);

        entity.fadeIn(500);

        if (timeout > 0) {
            setTimeout(function(){
                entity.fadeOut(500, function(){
                    $(this).remove();
                });
            }, timeout);
        }

        entity.children('a.message-close-btn').click(function(){
            entity.fadeOut(500, function(){
                $(this).remove();
            });
        });
    };

    nhpcc.notice = function(message, timeout) { this._messagebox(message, timeout, 'notice'); };
    nhpcc.alert  = function(message, timeout) { this._messagebox(message, timeout, 'alert');  };
    nhpcc.error  = function(message, timeout) { this._messagebox(message, timeout, 'error'); };
    nhpcc.redirect = function(path, timeout) { setTimeout(function(){location.href = path;}, timeout); };
    
    window.nhpcc = window.$S = nhpcc;
})(window, jQuery);

$(function(){
    // 初始化元素
    $S.elementInit();
});
