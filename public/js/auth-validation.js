const emailReg = /^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+)\.([a-zA-Z]{2,})$/;
const usernameReg = /^[a-zA-Z0-9_-]{3,16}$/;
const passwordReg = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

$(document).ready(function () {
    $("#auth_form").on("submit", function (event) {
        const name = $(this).find("input[name=name]");
        const email = $(this).find("input[name=email]");
        const password = $(this).find("input[name=password]");
        const conf_password = $(this).find("input[name=password_confirmation]");

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
            }
        }

        if (password.length > 0) {
            if (!passwordReg.test(password.val())) {
                password
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
            }
        }
    });
});
