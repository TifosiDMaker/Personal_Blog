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
});
