const _token = $('meta[name="csrf_token"]').attr("content");

$(document).on("click", "#fave_table .delete-btn", function () {
    const row = $(this).closest("tr");
    const id = row.data("id");

    Swal.fire({
        text: "از حذف این مورد مطمئنید؟",
        icon: "question",
        showCancelButton: true,
        cancelButtonColor: "#d34c4d",
        cancelButtonText: "لغو",
        confirmButtonText: "حذف",
        confirmButtonColor: "#685dd8",
    }).then((rep) => {
        if (rep.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "/faverites/create",
                data: {
                    _token,
                    id,
                },
                success: function (response) {
                    row.remove();
                },
                error: function (error) {
                    $("#alert_box").append(error_alert("خطایی رخ داده"));
                },
            });
        }
    });
});
