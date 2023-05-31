jQuery(document).ready(function ($) {
    $('.ui.form').form({
        on: 'click',
        fields: {
            username: {
                identifier: 'username',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Please enter a username'
                  },
                  {
                    type: 'email',
                    prompt : 'Please enter a valid e-mail'
                  }
                ]
            },
            password: {
                identifier: 'password',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter a password'
                    },
                    {
                        type   : 'minLength[6]',
                        prompt : 'Your password must be at least {ruleValue} characters'
                    }
                ]
            }
        }
    });
    $(".ui.form").on("keypress", function (event) {
        var keyPressed = event.keyCode || event.which;
        if (keyPressed === 13) {
            alert("You pressed the Enter key!!");
            event.preventDefault();
            return false;
        }
    });
    $('.ui.dropdown').dropdown();
    $('.sidebar-menu-toggler').on('click', function() {
        var target = $(this).data('target');
        $(target)
        .sidebar({
            dinPage: true,
            transition: 'overlay',
            mobileTransition: 'overlay'
        })
        .sidebar('toggle');
    });
}, jQuery);