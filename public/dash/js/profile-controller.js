const _token = $('meta[name="csrf_token"]').attr("content");

$(document).ready(function () {
    $("#profile_update").on("submit", function (event) {
        event.preventDefault();
        globalAuthValidation(this);

        const submitFlag = $(this).find(".errors").text().trim().length === 0;

        if (submitFlag) {
            const formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "/profile",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', _token);
                },
                success: function (response) {
                    $("#profile_img").attr(
                        "src",
                        `storage/${response.user.profile}`
                    );
                    $("#alert_box").append(success_alert(response.message));
                },
                error: function (error) {
                    $("#alert_box").append(
                        error_alert(error.responseJSON.message)
                    );
                },
            });
        }
    });

    $("#update_pass").on("submit", function (event) {
        event.preventDefault();
        globalAuthValidation(this);

        const submitFlag = $(this).find(".errors").text().trim().length === 0;

        if (submitFlag) {
            const old_password = $(this).find(`input[name="current_password"]`);
            const new_password = $(this).find(`input[name="new_password"]`);
            console.log("check");

            $.ajax({
                type: "PUT",
                url: "/password",
                data: {
                    _token,
                    current_password: old_password.val(),
                    new_password: new_password.val(),
                },
                success: function (response) {
                    console.log(response);
                    $("#alert_box").append(success_alert(response.message));
                },
                error: function (error) {
                    console.log(error);
                    $("#alert_box").append(
                        error_alert(error.responseJSON.message)
                    );
                },
            });
        }
    });
});
