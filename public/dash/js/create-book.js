const _token = $("meta[name=csrf_token]").attr('content');

const specialReg = /^(?:(?![`@$%^&*+\=\\|<>\/~]).)*$/;

$(document).ready(function () {


    const tagEl = $('#tag_input');
    const tagInput = tagEl.tagify({
        maxTags: 15,
        pattern: specialReg,
        dropdown: {
            maxItems: 20,
            classname: "tags-look",
            enabled: 0,
            closeOnSelect: false
        },
    }).data('tagify');

    tagEl.on('add', function (e, tagData) {
        console.log(e, tagData);

        $.ajax({
            method: 'POST',
            url: "/tags/create",
            data: {
                _token,
                name: tagData.data.value,
            },
            success: function () {
                tagInput.settings.whitelist.push(tagData.data.value);
            },
            error: function (error) {
                tagEl.removeTags(tagData.tag);
            }
        })
    });

    const cateInput = $('#cat_input').tagify({
        enforceWhitelist: true,
        pattern: specialReg,
        maxTags: 5,
        dropdown: {
            maxItems: 20,
            classname: "tags-look",
            enabled: 0,
            closeOnSelect: false
        }
    }).data('tagify');

    $.ajax({
        method: 'GET',
        url: '/tags/getTags',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', _token);
        },
        success: function (response) {
            response.forEach(tag => tagInput.settings.whitelist.push(tag));
        }
    });

    $.ajax({
        method: "GET",
        url: "/categories/getCates",
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', _token);
        },
        success: function (response) {
            response.forEach(cate => cateInput.settings.whitelist.push(cate));
        }
    });

    $('#book_form').on('submit', function (event) {

        bookValidation(this);
        const submitFlag = $(this).find('.errors').text().trim().length > 0;
        if (submitFlag) {
            event.preventDefault();
        }
    });
});


function bookValidation(form) {
    const textInputs = $(form).find('input[type=text]:not(input[name=tags] , input[name=cats]) , textarea');
    const numberInputs = $(form).find('input[type=number]');
    const image = $(form).find('input[name=image]');

    textInputs.each((index, item) => {
        if ($(item).val() == "") {
            $(item).siblings('.errors').text('این فیلد نمیتواند خالی باشد');
        } else if (!specialReg.test($(item).val())) {
            $(item).siblings('.errors').text('مقدار وارد شده معتبر نیست');
        } else {
            $(item).siblings('.errors').text('');
        }
    });

    numberInputs.each((index, item) => {
        if ($(item).val() == "") {
            $(item).siblings('.errors').text('این فیلد نمیتواند خالی باشد');
        } else if ($(item).val() < 0) {
            $(item).siblings('.errors').text('مقدار این فیلد نمیتواند منفی باشد');
        } else {
            $(item).siblings('.errors').text('');
        }
    });

    if (image[0].files[0]) {
        if (!image[0].files[0].type.includes('image')) {
            image.closest('.dropzone').siblings('.errors').text('فایل انتخاب شده باید عکس باشد');
        } else if (image[0].files[0].size > (1024 ** 2) * 2) {
            image.closest('.dropzone').siblings('.errors').text('حجم فایل انتخاب شده باید کمتر از ۲ مگابایت باشد');
        } else {
            image.closest('.dropzone').siblings('.errors').text('');
        }
    }
}
