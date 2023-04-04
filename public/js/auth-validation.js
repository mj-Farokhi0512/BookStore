const emailReg = /^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+)\.([a-zA-Z]{2,})$/;
const usernameReg = /^[a-zA-Z0-9_-]{3,16}$/;
const passwordReg = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

$(document).ready(function () {
    $("#auth_form").on("submit", function (event) {
        const name = $(this).find("input[name=name]");
        const email = $(this).find("input[name=email]");
        const password = $(this).find("input[name=password]");
        const conf_password = $(this).find("input[name=password_confirmation]");
        const new_password = $(this).find("#new_password");
        const new_password_conf = $(this).find("#new_password_conf");
        const old_password = $(this).find("#old_password");

        console.log(new_password_conf);

        if (name.length > 0) {
            if (!usernameReg.test(name.val())) {
                name.siblings(".errors").text("نام وارد شده معتبر نیست!");
                event.preventDefault();
            } else {
                name.siblings(".errors").text("");
            }
        }

        if (email.length > 0) {
            if (!emailReg.test(email.val())) {
                email.siblings(".errors").text("ایمیل وارد شده معتبر نیست!");
                event.preventDefault();
            } else {
                email.siblings(".errors").text("");
                email.parent().siblings(".errors").text("");
            }
        }

        if (password.length > 0) {
            if (!passwordReg.test(password.val())) {
                password
                    .siblings(".errors")
                    .text("رمزعبور وارد شده معتبر نیست!");
                password
                    .parent()
                    .siblings(".errors")
                    .text("رمزعبور وارد شده معتبر نیست!");
                event.preventDefault();
            } else {
                if (conf_password.length > 0) {
                    if (password.val() !== conf_password.val()) {
                        conf_password
                            .siblings(".errors")
                            .text("تکرار رمزعبور باید با رمزعبور یکی باشد!");
                        event.preventDefault();
                    } else {
                        conf_password.siblings(".errors").text("");
                    }
                }
                password.siblings(".errors").text("");
                password.parent().siblings(".errors").text("");
            }
        }

        if (old_password.length > 0) {
            if (!passwordReg.test(old_password.val())) {
                old_password
                    .parent()
                    .siblings(".errors")
                    .text("رمزعبور وارد شده معتبر نیست!");
                event.preventDefault();
            } else {
                old_password.parent().siblings(".errors").text("");
            }
        }

        if (new_password.length > 0) {
            if (!passwordReg.test(new_password.val())) {
                new_password
                    .parent()
                    .siblings(".errors")
                    .text("رمزعبور وارد شده معتبر نیست!");
                event.preventDefault();
            } else {
                if (new_password_conf.length > 0) {
                    if (password.val() !== new_password_conf.val()) {
                        new_password_conf
                            .siblings(".errors")
                            .text("تکرار رمزعبور باید با رمزعبور یکی باشد!");
                        event.preventDefault();
                    } else {
                        new_password_conf.siblings(".errors").text("");
                    }
                }
                new_password.parent().siblings(".errors").text("");
            }
        }
    });

    $("#update_pass").on("submit", function (event) {
        const new_password = $(this).find("#new_password");
        const new_password_conf = $(this).find("#new_password_conf");
        const old_password = $(this).find("#old_password");

        if (old_password.length > 0) {
            if (!passwordReg.test(old_password.val())) {
                old_password
                    .parent()
                    .siblings(".errors")
                    .text("رمزعبور وارد شده معتبر نیست!");
                event.preventDefault();
            } else {
                old_password.parent().siblings(".errors").text("");
            }
        }

        if (new_password.length > 0) {
            if (!passwordReg.test(new_password.val())) {
                new_password
                    .parent()
                    .siblings(".errors")
                    .text("رمزعبور وارد شده معتبر نیست!");
                event.preventDefault();
            } else {
                if (new_password_conf.length > 0) {
                    if (new_password.val() !== new_password_conf.val()) {
                        new_password_conf
                            .siblings(".errors")
                            .text("تکرار رمزعبور باید با رمزعبور یکی باشد!");
                        event.preventDefault();
                    } else {
                        new_password_conf.siblings(".errors").text("");
                    }
                }
                new_password.parent().siblings(".errors").text("");
            }
        }
    });
});
