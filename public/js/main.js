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

if(action == 'AppHttpControllersAuthLoginController@showLoginForm'){

    $('.customer_login').click(function () {

        var fields = {
            options: {selector: '.show_error', single: false, form_id: '#check_login'},
            order_number: {errorname: 'Order Number', required: true},
            email: {errorname: 'Email', required: true, email_valid:true},
        };

        var validation = new validation_lib(fields);

        if (!validation.validate_field()) {
            return false;
        }

        var data = $('#check_login').serializeArray();
        var url = base_url + "/ax_check_login";
        send_ajax(url, 'post', data, {handler:'check_login_handler'});
    });

    function check_login_handler(data) {

        $('.show_error').html('');

        var obj = JSON.parse(data);

        if(obj['errors'].length>0){
            $('.show_error').html(obj['errors']);
        }else{
            location.replace(base_url+'/dashboard')
        }
    }
}

if(action == 'AppHttpControllersHomeController@pop_background'){

    $(document).ready(function () {

        $('.zoom_img').zoom({ on:'click',magnify:0.5 });

        $('.slider-nav').slick({
            centerMode: true,
            focusOnSelect: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: false,
            prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
            nextArrow: '<div class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>',
        });
    });

    var cloned_div = '';

    $('#backgroundsCategory').change(function () {

       if(cloned_div == ''){
           cloned_div = $('.slick-slide');
       }

        var type_id = $(this).val();

        if($(this).val() == ''){

            $.each(cloned_div, function( index, value ) {

                $('.slider-nav').slick('slickAdd',value);
            });

            return false;
        }

        $.each(cloned_div, function( index, value ) {

            $('.slider-nav').slick('slickRemove',0);
        });

        $.each(cloned_div, function( index, value ) {

            if($(value).hasClass('slick-cloned')){
                return;
            }

            if($(value).find('.single_image').hasClass('type_'+type_id+'')){

                $('.slider-nav').slick('slickAdd',value);

            }
        });
    });

    $(document).on('click','.single_image',function () {

        $('.backg_main').css('background-image','url(' + $(this).find('img').attr('src') + ')');
        $('.backg_main').attr('data-id',$(this).attr('data-id'));
    });

    $('.approve_prof').click(function () {

        if(typeof $('.backg_main').attr('data-id') == 'undefined' || $('.backg_main').attr('data-id') == ''){
            bootbox.alert('Please set background');
            return false;
        }

        var url = base_url + "/ax_save_background";
        send_ajax(url, 'post', {order_id:$('.backg_main').attr('data-order'), background_id:$('.backg_main').attr('data-id')}, {handler:"save_background_handler"});
    });

    function save_background_handler(data) {

        var obj = JSON.parse(data);

        if(obj['errors'].length > 0){
            bootbox.alert(obj['errors'][0])
        }else{
            location.replace(base_url+'/dashboard')
        }
    }
}

if(action == 'AppHttpControllersCustomerController@customer_dashboard'){
    
    $('.order_notes').click(function () {

        $('#fix_request').modal('show');
    });
    
    $('.send_fix_request').click(function () {

        var url = base_url + "/ax_fix_request";
        send_ajax(url, 'post', {order_id:$('#order_id').val(), msg:$('#order_notes_msg').val()}, {handler:'fix_request_handler'});
    });

    function fix_request_handler(data) {

        var obj = JSON.parse(data);

        if(obj['errors'].length >0){

            $('.answer').html(obj['errors'][0]);
        }else{
            $('.answer').html('Your request has been sended..');
            setTimeout(function () {
                location.reload();
            },3000);
        }
    }

    $('#fix_request').on('hidden.bs.modal', function (e) {
       $('.answer').html('');
        $('#order_notes_msg').val('');
    });

    $('.apply_order').click(function () {
        var url = base_url + "/apply_order";
        send_ajax(url, 'post', {order_id:$('#order_id').val()}, {handler:'apply_order_handler'});
    });

    function apply_order_handler(data) {

        var obj = JSON.parse(data);

        if(obj['errors'].length >0){

          bootbox.alert(obj['errors'][0])
        }else{

            location.reload();
        }
    }

    $(document).ready(function () {
        $('.imageProduct_home,.imageViews').zoom({ on:'click',magnify:0.5 });
    });
}
