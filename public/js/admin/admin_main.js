console.log(action);

$(document).on('keypress', '.not_string', function (key) {
    if (key.charCode > 65 || key.charCode > 90) {

        return false;
    }

});

$(document).on('change', '.not_string', function (key) {

    if (!$.isNumeric($(this).val())) {

        $(this).val('');
    }

});

if (action == 'AppHttpControllersadminOrderController@upload_image') {


    myDropzone = new Dropzone("div#drop", {

        url: base_url + "/admin/upload_file",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        renameFile: true,
        init: function () {
            thisDropzone = this;
            this.on("maxfilesexceeded", function (file) {
                this.removeAllFiles();
                this.addFile(file);
            });
            this.on("success", function (file, response) {

                var obj = JSON.parse(response);

                if(obj['inf'].length == 0){
                    bootbox.alert('File not uploaded. Please try again');
                }else{
                    location.replace(base_url+'/admin/orders');
                }
            });
        },
        addRemoveLinks: true,
        removedfile: function (file) {
            var _ref;

            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
    });

    myDropzone.on('sending', function(file, xhr, formData){
        formData.append('id', $('#order_id').val());
        formData.append('_token', $("input[name='_token']").val());
    });
}

if (action == 'AppHttpControllersadminBackgroundController@add_background_type') {

    $(document).on('click','.add_background_category',function () {

        var url = base_url + "/admin/add_background_cat";
        send_ajax(url, 'post', {name:$('#cat_name').val()}, {handler:'add_category_handler'});
    });

    function add_category_handler(data) {

        var obj = JSON.parse(data);

        if(obj['errors'].length>0){
            bootbox.alert('Please set category name');
        }else{
            location.replace(base_url+'/admin/dashboard');
        }
    }
}

if (action == 'AppHttpControllersadminBackgroundController@add_background'){

    myDropzone = new Dropzone("div#drop", {

        url: base_url + "/admin/upload_background",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        renameFile: true,
        init: function () {
            thisDropzone = this;
            this.on("maxfilesexceeded", function (file) {
                this.removeAllFiles();
                this.addFile(file);
            });
            this.on("success", function (file, response) {
                console.log(file);
                var obj = JSON.parse(response);

                if(obj['errors'].length > 0){
                    bootbox.alert(obj['errors'][0]);
                    myDropzone.removeAllFiles( true );
                }else{
                    location.replace(base_url+'/admin/orders');
                }
            });
        },
        addRemoveLinks: true,
        removedfile: function (file) {
            var _ref;

            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
    });

    myDropzone.on('sending', function(file, xhr, formData){
        formData.append('background_cat', $('#category_type').val());
        formData.append('_token', $("input[name='_token']").val());
    });
    function add_category_handler(data) {

        var obj = JSON.parse(data);

        if(obj['errors'].length>0){
            bootbox.alert('Please set category name');
        }else{
            location.replace(base_url+'/admin/dashboard');
        }
    }
}

if(action == 'AppHttpControllersadminBackgroundController@change_background'){

    var cloned_div = $('.background').find('div');

    $('#background_type').change(function () {

        var type_id = $(this).val();

        if($(this).val() == ''){

            $.each(cloned_div, function( index, value ) {

                $('.background').append($(value));
            });

            return false;
        }

        $('.background').html('');

        $.each(cloned_div, function( index, value ) {

            if($(value).hasClass('type_'+type_id+'')){

                $('.background').append($(value));
            }
        });
    });

    $(document).on('click','.single_image',function () {

        $('.backg_main').css('background-image','url(' + $(this).find('img').attr('src') + ')');
        $('.backg_main').attr('data-id',$(this).attr('data-id'));
    });

     $('.approve_prof').click(function () {

        var node = document.querySelector('.backg_main');

        domtoimage.toPng(node).then(function (dataUrl) {
            var img = new Image();
            img.src = dataUrl;

            if( !$('.backg_main').attr('data-id')){
                bootbox.alert('Please set background');approve_prof
                return false;
            }

            var url = base_url + "/admin/ax_save_background";
            send_ajax(url, 'post', {customer_id:$('.backg_main').attr('data-customer'), background_id:$('.backg_main').attr('data-id'), image:dataUrl}, {handler:"save_background_handler"});
        }).catch(function (error) {
            console.error('oops, something went wrong!', error);
        });
    });

     function save_background_handler(data) {

         var obj = JSON.parse(data);

         if(obj['errors'].length > 0){
             bootbox.alert(obj['errors'][0])
         }else{
             location.replace(base_url+'/admin/all_customer')
         }
     }
}

if(action == 'AppHttpControllersadminOrderController@all_order'){

    
    $('.view_detail').click(function () {
        var id = $(this).attr('data-id');
        var tr_element = $('.detail_'+id);
        if(tr_element.length > 0){

            if(tr_element.hasClass('dis')){
                tr_element.hide();
                tr_element.removeClass('dis');
            }else{
                tr_element.show();
                tr_element.addClass('dis');
            }
        }
    });

}

function ax_upload_file_ajax(file_data, url, handler) {

    var widget = this;
    widget.queuePos++;
    $.ajax({
        url: url,
        type: 'post',
        data: file_data,
        cache: false,
        contentType: false,
        processData: false,
        forceSync: false,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend:function(){
            $('.lds-dual-ring').removeClass('dis_none');
        },
        xhr: function () {
            var xhrobj = $.ajaxSettings.xhr();
            if (xhrobj.upload) {
                xhrobj.upload.addEventListener('progress', function (event) {
                    var percent = 0;
                    var position = event.loaded || event.position;

                    var total = event.total || e.totalSize;
                    if (event.lengthComputable) {
                        percent = Math.ceil(position / total * 100);

                    }

                    processing(percent);

                }, false);
            }

            return xhrobj;
        },

        success: function (data) {

            var obj_upload = data;

            if (handler != '') {
                eval(handler(data))
            }

            $('#mass_upload_file_name').val(obj_upload['file_name']);

            $('.progressbar .proc_span').html('');
            $('.progressbar .procent').css('width', '0');
            $('#mass_upload_inp').val('');
        }
    }).catch((err)=>{
        $('.lds-dual-ring').addClass('dis_none');
        $('.progressbar .procent').css('width', '0');
        $('.proc_span').html('');
        alert(err.statusText+'Please repeat upload file');
        return false;
    });
}

function processing(procent) {

    $('#upload_progressbar .proc_span').html(procent + '%');
    $('#upload_progressbar .procent').css('width', procent + '%');

}