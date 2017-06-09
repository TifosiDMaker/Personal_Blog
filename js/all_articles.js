jQuery.validator.addMethod('notEqual', function(value, element, param) {
    return this.optional(element) || value != param;
}, "Please specify a different (non-default) value");

$(document).ready(function() {
	$('tr').on({
		mouseenter: function() {
			$(this).find('.hover_display').show();
		},
		mouseleave: function() {
			$(this).find('.hover_display').hide();
		}
	});
    $('.hide1, .except1').on({
        mouseenter: function() {
            $('.hide1').show();
        },
        mouseleave: function() {
            $('.hide1').hide();
        }
    });
    $('.hide2, .except2').on({
        mouseenter: function() {
            $('.hide2').show();
        },
        mouseleave: function() {
            $('.hide2').hide();
        }
    });
    $('#roleManage').on({
        click: function() {
            $('#needHide').slideToggle("fast");
            if ($('.glyphicon').hasClass('glyphicon-triangle-left')) {
                $('.glyphicon').removeClass('glyphicon-triangle-left');
                $('.glyphicon').addClass('glyphicon-triangle-bottom');
            } else {
                $('.glyphicon').removeClass('glyphicon-triangle-bottom');
                $('.glyphicon').addClass('glyphicon-triangle-left');
            }
        }
    });
    $('#changePassword').validate({
        debug: true,

        rules: {
            currentPassword: {
                required: true,
                remote: {
                    url: 'index.php?/admin/check',
                    type: 'post',
                }
            },
            newPassword: {
                required: true,
                rangelength: [6, 20],
                notEqual: '#currentPassword'
            },
            confirmPassword: {
                required: true,
                equalTo: '#newPassword'
            },
        },
        messages: {
            currentPassword: {
                required: '请填写此栏。',
                remote:'输入的密码不正确。',
            },
            newPassword: {
                required: '请填写此栏。',
                rangelength: '新密码长度必须为6-20位。',
                notEqual: '此密码与原密码相同。',
            },
            confirmPassword: {
                required : '请填写此栏。',
                equalTo: '两次填写的密码不一致。',
            },
        },
    });
    $('#viewRoles').input(function() {
        delay(function() {
            $.ajax({
                url: 'http://tifosili.top/Tifosi/index.php?/admin/roleAjax',
                data: $('#viewRoles').val(),
                success: function(response) {
                    if (response) {
                        $.each(response, function(name, value) {
                            $('input[name='+name+']').val([value]);
                    });
                    } else {

                    };
                };
            });
        });
    });
});
