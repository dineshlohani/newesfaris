$(document).ready(function () {
    // helps to stop double clicking of submit button
    var myButton = $('#submit-btn');  // your button ID here
    myButton.on('click', function () {
        myButton.prop('disabled', true);
    });

    $("#formset").formset({
        animateForms: true,
        reorderMode: 'dom',
    });

    // for formset as well as deleting file in formset_tags
    //     jQuery(function ($) {
    //         $("#formset").formset({
    //             reorderMode: 'dom',
    //         });
    //
    //         $('#formset').on('formAdded', function (event) {
    //             alert("yes");
    //         });
    //
    //
    //     });

    $('body').on('click', '.photo-delete', function () {
        deleteButton = $(this);

        fileID = deleteButton.attr('id');

        $.ajax({
            url: "/" + window.location.pathname.split("/")[1] + '/delete-file-api/' + fileID + '/',
            cache: false,
            error: function () {
                console.log("error");
            },
            success: function (data) {
                deleteButton.closest('div').remove();
            },
            type: 'GET'
        });
    });


    // for deleting image form
    $('body').on('click', '.delete-form', function () {
        btn = $(this);
        prefix = btn.attr('id');
        var total = parseInt($('#id_' + prefix + '-TOTAL_FORMS').val());
        if (total > 0) {
            btn.closest('div').remove();
            var forms = $('.delete-form');
            $('#id_' + prefix + '-TOTAL_FORMS').val(forms.length);
            for (var i = 0, formCount = forms.length; i < formCount; i++) {
                $(forms.get(i)).find(':input').each(function () {
                    updateElementIndex(this, prefix, i);
                });
            }
        }
        return false;
        form.remove();
    });
});

// for making category active in menu
$(document).ready(function () {
    var pathname = window.location.pathname.split("/")[1];
    if (pathname) {
        $("li").each(function () {
            var id = $(this).attr('id');
            if (pathname == id) {
                $(this).attr("class", "active");
                $(this).find("a").attr("class", "toggled");
                var parent = $(this).closest("#id_parent");
                parent.attr("class", "active");
                parent.find('a.menu-toggle').attr("class", "menu-toggle toggled");
                parent.find('ul.ml-menu').css('display', 'block');
            }
        })
    } else {
        $('#id_home').attr("class", "active")
    }

    $('#id_nep_date').val(todayNepaliDate());
    $('#id_eng_date').val(todayEnglishDate());

});

// preventing textbox from generating extra datepicker
function changePresentDateFormat(date) {
    var splitDate = date.split("-");
    return splitDate[1] + "/" + splitDate[2] + "/" + splitDate[0];
}

$('body').on('keydown', '#id_nep_date', function () {
    return false;
});

$('body').on('click', '.calender-btn', function () {
    $('#id_nep_date').nepaliDatePicker({
        npdMonth: true,
        npdYear: true,
        ndpEnglishInput: 'id_eng_date',
        disableBefore: changePresentDateFormat(todayDate()),
        disableAfter: changePresentDateFormat(todayDate()),
        onChange: function () {
            $('#ndp-nepali-box').remove();
        }
    });
    showNdpCalendarBox("id_nep_date");
});

function todayEnglishDate() {
    var d = new Date();
    var day = d.getUTCDate();
    var month = parseInt(d.getUTCMonth()) + 1;
    var year = d.getUTCFullYear();
    return year + "-" + month + "-" + day;
}

function todayNepaliDate() {
    return AD2BS(todayEnglishDate());
}

function changeFormat(date) {
    var splitDate = date.split("-");
    return splitDate[1] + "/" + (parseInt(splitDate[2]) + 1) + "/" + splitDate[0];
}

function todayDate() {
    var date = $('#id_nep_date').val();
    if (date) {
        return date
    } else {
        return AD2BS(todayEnglishDate());
    }
}

// $('body').on('click', '#search_false', function () {
//     var url = "/" + window.location.pathname.split("/")[1] + "?utf8=âœ“&is_approved=False";
//     window.location.href = url;
// });

// $('body').on('click', '#search_true', function () {
//     alert($(this).val());
//     var url = "/" + window.location.pathname.split("/")[1] + "?utf8=âœ“&is_approved=True"
//     window.location.href = url;
// });

$('body').on('click', '#search_all', function () {
    var url = "/" + window.location.pathname.split("/")[1] + "?utf8=âœ“"
    window.location.href = url;
});

// $(document).ready(function () {
//     $.getJSON("/static/json/app.json", function (data) {
//        console.log(data);
//     });
// });


//code for multi level dropdown used in filter section
$(document).ready(function () {
    $('.dropdown-submenu div.submenu-head').on("mouseover", function (e) {
        var each_list = $('.dropdown-submenu div.submenu-head');
        each_list.each(function () {
            $(this).next('ul').hide();
        });
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
    });
    $('body').on('click', function () {
        $('.dropdown-submenu div').each(function () {
            $(this).next('ul').hide();
        });
    });
});
