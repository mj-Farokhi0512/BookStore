const _token = $('meta[name="csrf_token"]').attr("content");

let prev = null;
$(document)
    .on("change", "#cart_table .quantity-input", function () {
        const input = $(this);
        const row = input.closest("tr");
        const id = Number(row.data("id"));

        $.ajax({
            type: "POST",
            url: `/cart/update`,
            data: {
                _token,
                id,
                number: input.val(),
            },
            success: function (response) {
                input.val(response.number);
                row.find("td:nth-of-type(5)").text(
                    `${response.total_price} تومان`
                );
            },
            error: function (error) {
                $("#alert_box").append(error_alert("خطایی رخ داده"));
            },
        });
    })
    .on("click", "#cart_table .btn-count-down", function () {
        const input = $(this).siblings("input.quantity-input");

        if (Number(input.val()) > 1) {
            input.val(Number(input.val()) - 1);
            input.change();
        }
    })
    .on("click", "#cart_table .btn-count-up", function () {
        const input = $(this).siblings("input.quantity-input");
        input.val(Number(input.val()) + 1);
        input.change();
    })
    .on("click", "#cart_table button.delete-btn", function () {
        console.log(_token);
        const row = $(this).closest("tr");
        const id = row.data("id");

        $.ajax({
            type: "DELETE",
            url: `/cart/delete/${id}`,
            beforeSend: function (xhr) {
                xhr.setRequestHeader("X-CSRF-TOKEN", _token);
            },
            success: function (response) {
                console.log(response);
                row.remove();
            },
            error: function (error) {
                $("#alert_box").append(error_alert("خطایی رخ داده"));
            },
        });
    })
    .on("click", "#cart_table .paid-btn", function () {
        const row = $(this).closest("tr");
        const id = row.data("id");

        $.ajax({
            type: "PUT",
            url: `/cart/paid/${id}`,
            beforeSend: function (xhr) {
                xhr.setRequestHeader("X-CSRF-TOKEN", _token);
            },
            success: function (response) {
                console.log(response);
                $("#alert_box").append(success_alert(response.message));
                row.remove();
            },
            error: function (error) {
                $("#alert_box").append(error_alert("خطایی رخ داده"));
            },
        });
    });
