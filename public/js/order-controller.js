const _token = $('meta[name="csrf_token"]').attr("content");

$(document)
    .on("click", ".book-order", function () {
        const id = $(this).parent().data("id");

        $.ajax({
            method: "POST",
            url: `/cart/create`,
            data: {
                _token,
                id,
            },
            success: function (response) {
                $("#cart_count").text(response.cartItems);
            },
            error: function (error) {
                if (error.status == 401) {
                    location = "/login";
                }
            },
        });
    })
    .on("click", ".bookmark-btn", function () {
        const like = $(this);
        const id = $(this).parent().data("id");

        $.ajax({
            type: "POST",
            url: "/faverites/create",
            data: {
                _token,
                id,
            },
            success: function (response) {
                if (response.like) {
                    like.removeClass("fa-regular");
                    like.addClass("fa-solid");
                } else {
                    like.addClass("fa-regular");
                    like.removeClass("fa-solid");
                }
            },
            error: function (error) {
                if (error.status == 401) {
                    location = "/login";
                }
            },
        });
    });
