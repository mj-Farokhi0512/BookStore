$(document).ready(function () {
    $('.book-order').on('click', function () {
        const id = $(this).data('id');
        $.ajax({
            method: "GET",
            url: `/cart/create/${id}`,
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
                if (error.status == 401) {
                    location = '/login';
                }
            }
        });
    });

});
