"use strict";
$(function () {
    var e = $(".selectpicker"), t = $(".select2"), i = $(".select2-icons");

    function c(e) {
        return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
    }

    e.length && e.selectpicker(), t.length && t.each(function () {
        var e = $(this);
        e.wrap('<div class="position-relative"></div>').select2({
            placeholder: "Select value",
            dropdownParent: e.parent()
        })
    }), i.length && i.wrap('<div class="position-relative"></div>').select2({
        templateResult: c,
        templateSelection: c,
        escapeMarkup: function (e) {
            return e
        }
    })
});
