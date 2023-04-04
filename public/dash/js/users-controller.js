const _token = $('meta[name="csrf_token"]').attr("content");

$(document).ready(function () {
    window.userTable = $("#users_table").DataTable({
        paging: false,
        ordering: false,
        info: false,
        bFilter: false,
    });
});

$(document).on("click", "#users_table .delete-btn", function (event) {
    const user = $(this).closest("tr");
    const id = user.data("id");

    console.log(id);

    Swal.fire({
        title: "از حذف این کاربر مطمئن هستید؟",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#7367f0",
        cancelButtonColor: "#ea5455",
        confirmButtonText: "بله",
        cancelButtonText: "لفو",
    }).then((response) => {
        if (response.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: "/users",
                data: {
                    _token,
                    id,
                },
                success: function (response) {
                    user.remove();

                    Swal.fire({
                        title: "کاربر با موفقیت حذف شد",
                        icon: "success",
                        confirmButtonColor: "#7367f0",
                        confirmButtonText: "بستن",
                    });
                },
            });
        }
    });
});

$(document).on("click", "#users_table .edit-btn", function () {
    const id = $(this).closest("tr").data("id");

    const edit_form = $("#edit_user form");
    const name = edit_form.find('input[name="name"]');
    const email = edit_form.find('input[name="email"]');

    $.ajax({
        type: "POST",
        url: "/users",
        data: {
            _token,
            id,
        },
        success: function (response) {
            name.val(response.user.name);
            email.val(response.user.email);
            $("#edit_user form").data("id", id);
            $("#edit_user").modal("show");
        },
    });
});

$(document).on("submit", "#edit_user form", function (event) {
    event.preventDefault();

    const id = $(this).data("id");

    globalAuthValidation(this);

    const submitFlag = $(this).find(".errors").text().trim().length === 0;

    if (submitFlag) {
        const name = $(this).find('input[name="name"]');
        const password = $(this).find('input[name="password"]');

        $.ajax({
            type: "PUT",
            url: `/users/${id}`,
            data: {
                _token,
                name: name.val(),
                password: password.val(),
            },
            success: function (response) {
                $('#edit_user').modal('hide');
                $('#alert_box').append(success_alert(response.message));
                $(`#users_table tr[data-id="${response.user.id}"] td:nth-of-type(2)`).text(response.user.name);
            },
            error: function (error) {
                $('#edit_user').modal('hide');
                $('#alert_box').append(error_alert(response.message));
            },
        });
    }
});

let previous = null;

$(document).on('focus', '#users_table .role_select', function (event) {
    previous = event.target.value;
}).on('change', '#users_table .role_select', function (event) {
    const roleId = event.target.value;
    const userId = $(this).closest('tr').data('id');

    const thisSelect = $(this);
    $.ajax({
        method: "POST",
        url: '/users/update-role',
        data: {
            _token,
            roleId,
            userId,
            prevRole: previous
        },
        success: function (response) {
            Swal.fire({
                title: 'نقش کاربر باموفقیت تغییر یافت',
                icon: 'success',
                confirmButtonColor: '#7367f0',
                confirmButtonText: 'باشه'
            });
        },
        error: function (error) {
            thisSelect.val(previous);
            Swal.fire({
                title: 'نقش کاربر تغییر نیافت',
                icon: 'error',
                confirmButtonColor: '#7367f0',
                confirmButtonText: 'باشه'
            });
        }
    })
});


$(document).on('change', '#users_table .status_select', function (event) {
    // const statusId = event.target.value;
    const userId = $(this).closest('tr').data('id');

    const thisSelect = $(this);
    $.ajax({
        method: "GET",
        url: `/users/${userId}`,
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', _token);
        },
        success: function (response) {
            console.log(response);
            Swal.fire({
                title: 'وضعیت کاربر باموفقیت تغییر یافت',
                icon: 'success',
                confirmButtonColor: '#7367f0',
                confirmButtonText: 'باشه'
            });
        },
        error: function (error) {
            console.log(error);
            Swal.fire({
                title: 'وضعیت کاربر تغییر نیافت',
                icon: 'error',
                confirmButtonColor: '#7367f0',
                confirmButtonText: 'باشه'
            });
        }
    })
});

$(document).on('change', '#user_search', function (event) {
    const input = $(this);
    const table = $('#users_table').DataTable();

    table.clear().draw();
    $.ajax({
        method: "POST",
        url: '/users/search',
        data: {
            _token,
            search: input.val()
        },
        success: function (response) {
            const users = response.users;
            const roles = response.roles;

            users.forEach((user) => {
                const date = new Date(user.created_at).toLocaleDateString('fa');
                const tr = table.row.add([
                    ` <img src="${user.profile ? `storage/${user.profile}` : 'dash/images/profile-placeholder.png'}"
                                alt="Profile" class="profile-img"/>`,
                    user.name,
                    user.email,
                    date,
                    user.role_id != 2 ? `<select class="status_select">
                                    <option value="1" ${user.status == 1 ? 'selected' : ''}>فعال</option>
                                    <option value="0" ${user.status == 0 ? 'selected' : ''}>غیرفعال</option>
                                </select>` : `${user.status ? 'فعال' : 'غیرفعال'}`,
                    `
                            <select class="role_select" value="{{$user->role_id}}">
                                    ${roles.map(role => `<option
                                         ${role.id == user.role_id ? 'selected' : ''}>${role.name}</option>`).toString()
                    }
                             </select>
                        `,
                    user.role_id != 2 ? `<button class="btn btn-primary edit-btn">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn-danger delete-btn">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>` : '',
                ]).draw().node();

                $(tr).data('id', user.id);

                console.log(tr);
            });
        }
    });
});
