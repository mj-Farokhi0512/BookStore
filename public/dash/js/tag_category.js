const _token = $('meta[name="csrf_token"]').attr('content');
const specialReg = /^(?:(?![`@$%^&*+\=\\|<>\/~]).)*$/;

$(document).ready(function () {
    const catTable = $('#cates_table').DataTable({
        paging: false,
        ordering: false,
        info: false,
        bFilter: false,
    });

    const tagTable = $('#tags_table').DataTable({
        paging: false,
        ordering: false,
        info: false,
        bFilter: false,
    });


    $('#input_cate button').on('click', function () {
        const input = $('#input_cate');
        const catInput = input.find('input.cate-input');
        const status = input.find('.status_select');

        const id = input.data('id');

        if (id) {
            $.ajax({
                method: "POST",
                url: "/categories/update",
                data: {
                    _token,
                    id,
                    name: catInput.val()
                },
                success: function (response) {
                    $(`#cates_table tr[data-id="${id}"] td:nth-of-type(2)`).text(response.cate.name);
                    $('#input_cate .cancel-btn').click();
                },
                error: function (error) {
                    $('#alert_box').append(error_alert('خطایی رخ داده'));
                }
            });
        } else {
            $.ajax({
                method: "POST",
                url: "/categories/create",
                data: {
                    _token,
                    name: catInput.val(),
                    status: status.val()
                },
                success: function (response) {
                    input.removeClass('error');
                    console.log(response);
                    console.log(catTable.rows().count())
                    const tr = catTable.row.add([
                        catTable.rows().count(),
                        response.cate.name,
                        response.cate.date,
                        `<select class="status_select">
                                <option value="1" ${response.cate.status == 1 ? 'selected' : ''}>فعال</option>
                                <option value="0" ${response.cate.status == 0 ? 'selected' : ''}>غیرفعال</option>
                            </select>`,
                        `<button class="btn btn-primary edit-btn">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="btn btn-danger delete-btn">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>`
                    ]).draw().node();
                    console.log(tr);
                    $(tr).data('id', response.cate.id);
                    catInput.val('');
                },
                error: function (error) {
                    input.addClass('error');
                    catInput.val('');
                }
            });
        }
    });

    $('#input_tag button').on('click', function () {
        const input = $('#input_tag');
        const tagInput = input.find('input.tag-input');
        const status = input.find('.status_select');

        const id = input.data('id');

        if (id) {
            $.ajax({
                method: "POST",
                url: "/tags/update",
                data: {
                    _token,
                    id,
                    name: tagInput.val()
                },
                success: function (response) {
                    $(`#tags_table tr[data-id="${id}"] td:nth-of-type(2)`).text(response.tag.name);
                    $('#input_tag .cancel-btn').click();
                },
                error: function (error) {
                    $('#alert_box').append(error_alert('خطایی رخ داده'));
                }
            });
        } else {
            $.ajax({
                method: "POST",
                url: "/tags/create",
                data: {
                    _token,
                    name: tagInput.val(),
                    status: status.val()
                },
                success: function (response) {
                    input.removeClass('error');
                    const tr = tagTable.row.add([
                        tagTable.rows().count(),
                        response.tag.name,
                        response.tag.date,
                        `<select class="status_select">
                                <option value="1" ${response.tag.status == 1 ? 'selected' : ''}>فعال</option>
                                <option value="0" ${response.tag.status == 0 ? 'selected' : ''}>غیرفعال</option>
                            </select>`,
                        `<button class="btn btn-primary edit-btn">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="btn btn-danger delete-btn">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>`
                    ]).draw().node();
                    console.log(tr);
                    $(tr).data('id', response.tag.id);
                    tagInput.val('');

                },
                error: function (error) {
                    input.addClass('error');
                    tagInput.val('');
                }
            });
        }
    });


    $('#cat_search').on('change', function () {
        const input = $(this);

        $.ajax({
            method: 'POST',
            url: '/categories/search',
            data: {
                _token,
                name: input.val()
            },
            success: function (response) {
                const cats = response.cats;
                const firstTr = catTable.row(0).node();
                catTable.clear().draw();
                catTable.row.add(firstTr);
                cats.forEach((cat, index) => {
                    const date = new Date(cat.created_at).toLocaleDateString('fa');
                    const tr = catTable.row.add([
                        index + 1,
                        cat.name,
                        date,
                        `<select class="status_select">
                                <option value="1" ${cat.status == 1 ? 'selected' : ''}>فعال</option>
                                <option value="0" ${cat.status == 0 ? 'selected' : ''}>غیرفعال</option>
                            </select>`,
                        ` <button class="btn btn-primary edit-btn">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="btn btn-danger delete-btn">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>`
                    ]).draw().node();
                    $(tr).attr('data-id', cat.id);
                });
            },
            error: function (error) {
                $('#alert_box').append(error_alert('خطایی رخ داده'));
            }
        });
    });

    $('#tag_search').on('change', function () {
        const input = $(this);

        $.ajax({
            method: 'POST',
            url: '/tags/search',
            data: {
                _token,
                name: input.val()
            },
            success: function (response) {
                const tags = response.tags;
                const firstTr = tagTable.row(0).node();
                tagTable.clear().draw();
                tagTable.row.add(firstTr);
                tags.forEach((tag, index) => {
                    const date = new Date(tag.created_at).toLocaleDateString('fa');
                    const tr = tagTable.row.add([
                        index + 1,
                        tag.name,
                        date,
                        `<select class="status_select">
                                <option value="1" ${tag.status == 1 ? 'selected' : ''}>فعال</option>
                                <option value="0" ${tag.status == 0 ? 'selected' : ''}>غیرفعال</option>
                            </select>`,
                        ` <button class="btn btn-primary edit-btn">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="btn btn-danger delete-btn">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>`
                    ]).draw().node();
                    $(tr).attr('data-id', tag.id);
                });
            },
            error: function (error) {
                $('#alert_box').append(error_alert('خطایی رخ داده'));
            }
        });
    });
});

let catStatus = null;

$(document).on('focus', '#cates_table .status_select', function (event) {
    catStatus = event.target.value;
}).on('change', '#cates_table .status_select', function (event) {
    const row = $(this).closest('tr');
    const id = row.data('id');
    const select = $(this);

    $.ajax({
        method: "GET",
        url: `/categories/updateStatus/${id}`,
        success: function (response) {
            Swal.fire({
                title: 'وضعیت دسته‌بندی با موفقیت تغییریافت',
                icon: 'success',
                confirmButtonColor: '#685dd8',
                confirmButtonText: 'باشه'
            });
        },
        error: function (error) {
            Swal.fire({
                title: 'وضعیت دسته‌بندی تغییر نیافت',
                icon: 'error',
                confirmButtonColor: '#685dd8',
                confirmButtonText: 'باشه'
            });
            select.val(catStatus);
        }
    })
});

let tagStatus = null;
$(document).on('focus', '#tags_table .status_select', function (event) {
    tagStatus = event.target.value;
}).on('change', '#tags_table .status_select', function (event) {
    const row = $(this).closest('tr');
    const id = row.data('id');
    const select = $(this);

    $.ajax({
        method: "GET",
        url: `/tags/updateStatus/${id}`,
        success: function (response) {
            Swal.fire({
                title: 'وضعیت برچسب با موفقیت تغییریافت',
                icon: 'success',
                confirmButtonColor: '#685dd8',
                confirmButtonText: 'باشه'
            });
        },
        error: function (error) {
            Swal.fire({
                title: 'وضعیت برچسب تغییر نیافت',
                icon: 'error',
                confirmButtonColor: '#685dd8',
                confirmButtonText: 'باشه'
            });
            select.val(tagStatus);
        }
    })
});

$(document).on('click', '#cates_table .edit-btn', function () {
    const id = $(this).closest('tr').data('id');

    const catInput = $('#input_cate');
    const input = catInput.find('.cate-input');
    const select = catInput.find('.status_select');
    const actionTd = catInput.find('td:last-of-type');

    $.ajax({
        method: "GET",
        url: `/categories/getInfo/${id}`,
        success: function (response) {
            catInput.data('id', response.cate.id);
            input.val(response.cate.name);
            select.prop('disabled', true);
            if (actionTd.find('.cancel-btn').length == 0) {
                actionTd.prepend(`
                    <button class="btn btn-danger cancel-btn">لغو</button>
                `);
            }
        },
        error: function (error) {
            $('#alert_box').append(error_alert('خطایی رخ داده'));
        }
    })

});

$(document).on('click', '#tags_table .edit-btn', function () {
    const id = $(this).closest('tr').data('id');

    const tagInput = $('#input_tag');
    const input = tagInput.find('.tag-input');
    const select = tagInput.find('.status_select');
    const actionTd = tagInput.find('td:last-of-type');

    $.ajax({
        method: "GET",
        url: `/tags/getInfo/${id}`,
        success: function (response) {
            tagInput.data('id', response.tag.id);
            input.val(response.tag.name);
            select.prop('disabled', true);
            if (actionTd.find('.cancel-btn').length == 0) {
                actionTd.prepend(`
                    <button class="btn btn-danger cancel-btn">لغو</button>
                `);
            }
        },
        error: function (error) {
            $('#alert_box').append(error_alert('خطایی رخ داده'));
        }
    })

});

$(document).on('click', '#input_cate .cancel-btn', function () {
    const tr = $(this).closest('tr');
    tr.data('id', null);
    tr.find('.cate-input').val('');
    tr.find('.status_select').prop('disabled', false);
    $(this).remove();
}).on('click', '#input_tag .cancel-btn', function () {
    const tr = $(this).closest('tr');
    tr.data('id', null);
    tr.find('.tag-input').val('');
    tr.find('.status_select').prop('disabled', false);
    $(this).remove();
});

$(document).on('click', '#cates_table .delete-btn', function () {
    const row = $(this).closest('tr');
    const id = row.data('id');

    Swal.fire({
        text: 'از حذف این دسته‌بندی مطمئنید؟',
        icon: 'question',
        showCancelButton: true,
        cancelButtonColor: '#d34c4d',
        cancelButtonText: 'لغو',
        confirmButtonText: 'حذف',
        confirmButtonColor: '#685dd8'
    }).then(res => {
        if (res.isConfirmed) {
            $.ajax({
                method: "DELETE",
                url: `categories/delete/${id}`,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', _token);
                },
                success: function (response) {
                    console.log(response);
                    row.remove();
                    Swal.fire({
                        text: 'دسته‌بندی باموفقیت حذف شد',
                        icon: 'success',
                        confirmButtonText: 'تایید',
                        confirmButtonColor: '#685dd8'
                    });
                },
                error: function (error) {
                    $('#alert_box').append(error_alert('خطایی رخ داده'));
                }
            });
        }
    });
}).on('click', '#tags_table .delete-btn', function () {
    const row = $(this).closest('tr');
    const id = row.data('id');

    Swal.fire({
        text: 'از حذف این برچسب مطمئنید؟',
        icon: 'question',
        showCancelButton: true,
        cancelButtonColor: '#d34c4d',
        cancelButtonText: 'لغو',
        confirmButtonText: 'حذف',
        confirmButtonColor: '#685dd8'
    }).then(res => {
        if (res.isConfirmed) {
            $.ajax({
                method: "DELETE",
                url: `tags/delete/${id}`,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', _token);
                },
                success: function (response) {
                    console.log(response);
                    row.remove();
                    Swal.fire({
                        text: 'برچسب باموفقیت حذف شد',
                        icon: 'success',
                        confirmButtonText: 'تایید',
                        confirmButtonColor: '#685dd8'
                    });
                },
                error: function (error) {
                    $('#alert_box').append(error_alert('خطایی رخ داده'));
                }
            });
        }
    });
});
