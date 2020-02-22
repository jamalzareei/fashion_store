$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('submit', '.ajaxForm', function(e) {
        e.preventDefault();
        let url = $(this).attr('action');
        let type = $(this).attr('method');
        let data = $(this).serialize();
        let this_ = $(this);

        $.ajax({
            url: url,
            type: type,
            url: url,
            data: data,
            beforeSend: function() {
                $('.help-block').text('');
                this_.find('button[type="submit"]').html('منتظر بمانید <i class="fas fa-compact-disc fa-spin"></i>');
            },
            success: function(response) {
                console.info(response);

                if (response.status == 'success')
                    this_.find('button[type="submit"]').html('موفق');


                Swal.fire({
                    title: response.title,
                    text: response.message,
                    type: response.status,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ادامه و افزودن اطلاعات',
                    cancelButtonText: 'نمایش لیست'
                }).then((result) => {
                    if (result.value) {
                        if (data.redirectEdit && typeof data.redirectEdit !== 'undefined') {
                            location.href = data.redirectEdit;
                        } else {
                            $('.wizard-next[data-wizard="next"]').click();
                        }
                    } else {
                        if (data.redirectList && typeof data.redirectList !== 'undefined') {
                            location.href = data.redirectList;
                        } else {

                        }
                    }
                });

            },
            error: function(request, status, error) {
                this_.find('button[type="submit"]').html(' <i class="panel-control-icon glyphicon glyphicon-remove"></i> تلاش دوباره');
                json = $.parseJSON(request.responseText);

                $.each(json.errors, function(key, value) {
                    $('.error-' + key).text(value);
                });
                Swal.fire({
                    type: "error",
                    title: "نا موفق",
                    text: "لطفا پس از بررسی خطاهای پیش آمده را رفع نمایید.",
                });

            }

        })
    });

    $(document).on('submit', '.ajaxUpload', function(e) {
        e.preventDefault();


        // var cover = $('#input-cover-file').prop('files')[0];
        var imageUrl = $('.file-upload').prop('files')[0];
        // var slug = $('.ajaxUpload ').val();
        //file-upload


        var form_data = new FormData(this); //new FormData();
        if (document.getElementsByClassName("file-upload").value != "") {
            // you have a file
            form_data.append('imageUrl', imageUrl);
        }


        let url = $(this).attr('action');
        let type = $(this).attr('method');
        let data = $(this).serialize();
        let this_ = $(this);

        $.ajax({
            type: type,
            url: url,
            data: form_data, //$(this).serialize(),
            processData: false,
            async: false,
            contentType: false,
            beforeSend: function() {
                $('.help-block').text('');
                this_.find('button[type="submit"]').html('منتظر بمانید <i class="fas fa-compact-disc fa-spin"></i>');
            },
            success: function(data) {

                this_.find('button[type="submit"]').html('ادامه');

                console.log(data.redirectEdit);
                // swal(data.title, data.message, data.status);
                Swal.fire({
                    title: data.title,
                    text: data.message,
                    type: data.status,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ادامه و افزودن اطلاعات',
                    cancelButtonText: 'نمایش لیست'
                }).then((result) => {
                    if (result.value) {
                        if (data.redirectEdit && typeof data.redirectEdit !== 'undefined') {
                            location.href = data.redirectEdit;
                        } else {
                            $('.wizard-next[data-wizard="next"]').click();
                        }
                    } else {
                        if (data.redirectList && typeof data.redirectList !== 'undefined') {
                            location.href = data.redirectList;
                        } else {

                        }
                    }
                });
                if (data.redirectAuto) {
                    window.location.href = data.redirectAuto;
                }

            },
            error: function(request, status, error) {
                this_.find('button[type="submit"]').html('تلاش دوباره ');
                console.log(request);
                json = $.parseJSON(request.responseText);

                $.each(json.errors, function(key, value) {
                    console.log(key + ": " + value);
                    $('.error-' + key).text(value);
                });
                Swal.fire({
                    type: "error",
                    title: "نا موفق",
                    text: "لطفا پس از بررسی خطاهای پیش آمده را رفع نمایید.",
                });

            }
        });

    });

    $(document).on('change', '#addPropertyField', function() {
        let field = $('option:selected', this).attr('field');
        let fieldid = $('option:selected', this).attr('fieldid');
        var element = `
        <div class="form-group col-md-6 mb-5 float-left" id="element-extra_filed-` + fieldid + `">
            <label for="extra_filed-` + fieldid + `">` + field + `</label>
            <div class="input-group">
                <input type="text" class="form-control" id="extra_filed-` + fieldid + `" aria-describedby="basic-addon-` + field + `" required="" name="extra_filed[` + fieldid + `]">
                <span class="input-group-addon cursor" id="basic-addon-` + field + `" onclick="removeProperetyList('#element-extra_filed-','` + fieldid + `','` + field + `')"><i class="text-danger fa fa-times"></i></span>    
            </div>
            <span class="help-block text-danger small error-extra_filed"></span>
        </div>
        `;

        $('#list-properties').append(element);
        $('option:selected', this).remove();
    });
});


function Func() {
    var city = document.getElementById('city');
    var state = document.getElementById('state');
    var val = state.options[state.selectedIndex].getAttribute('data_city');
    var arr = val.split(',');
    city.options.length = 0;
    for (i = 0; i < arr.length; i++) {
        if (arr[i] != "") {
            city.options[city.options.length] = new Option(arr[i], arr[i]);
        }
    }
}

function delete_row(url, element, value_select) {
    Swal.fire({
        title: '',
        text: 'آیا از حذف اطمینان دارید',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'حذف',
        cancelButtonText: 'انصراف'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: 'DELETE',
                data: { ajax: 'true', _method: 'delete' },
                success: function(response) {
                    var data = response;
                    $('#' + element).remove();
                    Swal.fire({
                        type: data.status,
                        title: data.title,
                        html: data.message,
                    });
                    // $( '.addProperty select option[value="'+value_select+'"]' ).prop('disabled', 'false');
                    $('.addProperty select option[value="' + value_select + '"]').prop("disabled", false);
                    console.log(value_select);


                },
                error: function(request, status, error) {

                    json = $.parseJSON(request.responseText);


                    var errors = '';
                    $.each(json.errors, function(key, value) {
                        errors = key + ': ' + value + '<br>';
                    });
                    console.log(errors);
                    Swal.fire({
                        type: 'error',
                        title: 'خطاهای پیش آمده را رفع نمایید',
                        html: errors,
                    });
                }
            });
        } else {

        }
    });
}

function changeCategory(url, id, element) {
    $.ajax({
        url: url,
        method: 'post',
        data: { ajax: 'true', id: id },
        success: function(response) {
            $(element).html(response);
        },
        error: function(request, status, error) {
            console.log(request);
            console.log(status);
            console.log(error);
        }
    });
}

function removeProperetyList(element, fieldid, field) {
    $(element + fieldid).remove();
    var app = `
    <option value="" fieldid="` + fieldid + `" field="` + field + `">` + field + `</option>
    `;
    $('#addPropertyField').append(app);
}

function showMessage(url) {
    $.ajax({
        url: url,
        method: 'get',
        data: { ajax: 'true' },
        success: function(response) {
            $('#show-message-modal').html(response.data);
        },
        error: function(request, status, error) {
            console.log(request);
            console.log(status);
            console.log(error);
        }
    });
}

function delete_(url, redirect) {
    Swal.fire({
        title: '',
        text: 'آیا از حذف اطمینان دارید',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'حذف',
        cancelButtonText: 'انصراف'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: 'DELETE',
                type: 'DELETE',
                data: { ajax: 'true', _method: 'delete' },
                success: function(response) {
                    window.location.href = redirect;


                },
                error: function(request, status, error) {

                    json = $.parseJSON(request.responseText);


                    var errors = '';
                    $.each(json.errors, function(key, value) {
                        errors = key + ': ' + value + '<br>';
                    });
                    console.log(errors);
                    Swal.fire({
                        type: 'error',
                        title: 'خطاهای پیش آمده را رفع نمایید',
                        html: errors,
                    });
                }
            });
        } else {

        }
    });
}

function changeStatus(url, this_){
    var active = (this_.checked == true) ? 1 : 0;
    console.log(active)
    $.ajax({
        url: url,
        method: 'post',
        data: { ajax: 'true',active:active },
        success: function(response) {
            Swal.fire({
                title: response.title,
                text: response.message,
                type: response.status,
            })
        },
        error: function(request, status, error) {
            console.log(request);
            console.log(status);
            console.log(error);
        }
    });
}