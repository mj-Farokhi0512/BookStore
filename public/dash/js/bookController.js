const _token = $("meta[name=csrf_token]").attr('content');

const specialReg = /^(?:(?![`@$%^&*+\=\\|<>\/~]).)*$/;

$(document).ready(function () {
    const booksTable = $('#books_table').DataTable({
        paging: false,
        ordering: false,
        info: false,
        bFilter: false,
    });

    $('#book_search').on('change', function (event) {
        const input = $(this);

        $.ajax({
            method: "POST",
            url: "/books/search",
            data: {
                _token,
                name: input.val()
            },
            success: function (response) {
                const books = response.books;
                const editLink = response.editLink;
                booksTable.clear().draw();

                books.forEach(book => {
                    const date = new Date(book.created_at).toLocaleDateString('fa');
                    const tr = booksTable.row.add([
                        `<img
                                src="${book.image ? `storage/${book.image}` : 'images/book-placeholder.jpg'}"
                                alt="Profile" class="profile-img"/>`,
                        book.name,
                        book.author,
                        book.price,
                        book.pages,
                        date,
                        `<select class="status_select">
                                <option value="1" ${book.status == 1 ? 'selected' : ''}>فعال</option>
                                <option value="0" ${book.status == 0 ? 'selected' : ''}>غیرفعال</option>
                            </select>`,
                        `<a href="${editLink + '/' + book.id}"
                               class="btn btn-primary edit-btn text-white">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <button class="btn btn-danger delete-btn">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>`,
                    ]).draw().node();
                    $(tr).data('id', book.id);
                });
            },
            error: function () {
                $('#alert_box').append(error_alert('خطایی رخ داده'));
            }
        })
    });
});

$(document).on('click', '#books_table .delete-btn', function () {
    const row = $(this).closest('tr');
    const id = row.data('id');

    Swal.fire({
        text: 'از حذف این کتاب مطمئنید؟',
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
                url: `books/delete/${id}`,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', _token);
                },
                success: function (response) {
                    console.log(response);
                    row.remove();
                    Swal.fire({
                        text: 'کتاب باموفقیت حذف شد',
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


let bookStatus = null;
$(document).on('focus', '#books_table .status_select', function (event) {
    bookStatus = event.target.value;
}).on('change', '#books_table .status_select', function (event) {
    const row = $(this).closest('tr');
    const id = row.data('id');
    const select = $(this);

    $.ajax({
        method: "GET",
        url: `/books/updateStatus/${id}`,
        success: function (response) {
            Swal.fire({
                title: 'وضعیت کتاب با موفقیت تغییریافت',
                icon: 'success',
                confirmButtonColor: '#685dd8',
                confirmButtonText: 'باشه'
            });
        },
        error: function (error) {
            Swal.fire({
                title: 'وضعیت کتاب تغییر نیافت',
                icon: 'error',
                confirmButtonColor: '#685dd8',
                confirmButtonText: 'باشه'
            });
            select.val(bookStatus);
        }
    })
});
