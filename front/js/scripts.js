bind_mce();   
$(document).ready(function(){    
    // Fix scroll
    var $win = $(window)
    , $nav = $('.submit-bar')
    , navTop = $('.submit-bar').length && $('.submit-bar').offset().top + 40
    , isFixed = 0

    processScroll();

    $win.on('scroll', processScroll);
    function processScroll() {
        var i, scrollTop = $win.scrollTop()
        if (scrollTop >= navTop && !isFixed) {
            isFixed = 1
            $nav.addClass('fixed')
        } else if (scrollTop <= navTop && isFixed) {
            isFixed = 0
            $nav.removeClass('fixed')
        }
    }
    //end Fix scroll
    
    init();    
    tab_active();
    model_tab();
   // toefl_test();
    show_subject();
    add_test();
    bind_user();
    bind_nt_test();
    bind_post();
    
/*var $content = $(".preview-frame iframe").contents();
     $content.find("body div.navbar").remove();
     $content.find("body div.subnav").remove();
     $content.find("body #footer").remove();*/
    
    
});


$(window).load(function() {
    var $content = $(".preview-frame iframe").contents();
    $content.find("body").css('padding-top','0px');
    $content.find("body div.navbar").remove();
    $content.find("body div.subnav").remove();
    $content.find("body #footer").remove();
//$content.find("body .event-body").html('');
//$content.find("body .ticket").html('&nbsp;');
//$content.find("body .ticket-button").remove('');
});


function bind_post(){
    $("#post .btn-reply").click(function(){
        var ele = $(this);
        $("#post .btn-reply").hide();
        $("#post .reply").fadeIn('slow');
        return false;
    });
    
    $("#post .reply .cancel").click(function(){
        var ele = $(this);
        $("#post .reply").hide();
        $("#post .btn-reply").fadeIn('slow');
        return false;
    });
    
    $(".no-comment-reply").click(function(){        
        $("#post .btn-reply").trigger('click');
        return false;
    });
    
    $("#post .vote").click(function(){
        var ele = $(this);
        if(ele.hasClass('disabled')) return false;
        var parent = ele.parents('.rate');
        ele.addClass('disabled');
        $.post(ele.attr('href'),"",function(response){
            if(response.message.success){
                ele.removeClass("disabled").addClass('hide');
                $(".unvote",parent).removeClass('hide');
                //if(parent.hasClass('comment'))
                $(".total-vote",parent).text(response.data.total_vote);
            }
        },'json');
        return false;
    });
    
    $("#post .unvote").click(function(){
        var ele = $(this);
        if(ele.hasClass('disabled')) return false;
        var parent = ele.parents('.rate');
        ele.addClass('disabled');
        $.post(ele.attr('href'),"",function(response){
            if(response.message.success){
                ele.removeClass("disabled").addClass('hide');
                $(".vote",parent).removeClass('hide');
                //if(parent.hasClass('comment'))
                $(".total-vote",parent).text(response.data.total_vote);
            }
        },'json');
        return false;
    });    
    
    $("#post .comment").hover(function(){
        var ele = $(this);
        $(".report",ele).show();
    }, function(){
        var ele = $(this);
        $(".report",ele).hide();
    });
        
    $(".report-link").click(function(){
        var ele = $(this);
        if(ele.hasClass('require-login'))
            return false;
        if(!confirm('Bạn có chắc báo cáo vi phạm cho mục này?')) return false;
        $.get(ele.attr('href'),"",function(response){
            if(response.message.success){
                $("#modal-report").trigger('click');
            }
        },'json');
        return false;
    });
    
    $(".modal .modal-close").click(function(){
        $(this).parents('.modal').modal('hide');
        return false;
    });    
}

function filter_search(oid,fid,sid,reload){
    $(".add-test .faculty").fadeOut('fast');
    $(".add-test .subject").fadeOut('fast');
    if(reload){
        fid = $(".add-test #current_faculty_id").val();
        sid = $(".add-test #current_subject_id").val();
    }
    
    var data = {
        'oid':oid,
        'fid':fid,
        'sid':sid
    };
    $.get(baseUrl+"/create_test/filter_search/",data,function(response){
        $(".add-test .faculty").fadeIn('fast');
        $(".add-test .subject").fadeIn('fast');
        $(".add-test .organization").val(oid)
        $(".add-test .list-faculty").html(response.faculty_html);
        $(".add-test .list-subject").html(response.subject_html);
    },'json');
}

function bind_nt_test(){
    var organization = $('.add-test .organization').val();
    if(!isNaN(organization)){
        filter_search($(".add-test .organization").val(), $(".add-test .list-faculty").val(), $(".add-test .list-subject").val(), true);
    }
    
    $(".add-test .organization,.add-test .faculty").change(function(){
        filter_search($(".add-test .organization").val(), $(".add-test .list-faculty").val(), $(".add-test .list-subject").val(), false);
    });
    
    
    $("#modal-buy-test form").ajaxForm({
        beforeSubmit:function(arr,ele){
            $(".modal .alert").remove();            
        },
        success:function(response, statusText, xhr, ele){    
            var msg = '';
            $.each(response.message.error,function(k,v){
                msg = msg+v+"<br/>";
            });    
            if(!response.message.success){              
                
                display_modal_error(ele, msg);
            }else{
                window.location = response.data.link;
            }
            
        },
        dataType:'json'
    });    
    
    $('.add-quest .get-number').click(function(){
              
        var ele = $('.number-question');
        var number = ele.val();
        var length = $(".list-question .questions").length;
        var id = 0;
        if(length > 0){
            id = $(".list-question .questions:last").attr('id');
            id = id.split('-');
            id = parseInt(id[1]) + 1;
        }        
        var data = {
            'number':number,
            'total':id
        };
        $.post(ele.attr('link'),data,function(response)
        {
            $(response).insertBefore($(".list-question form .form-actions"));
            $(".list-question").show();
            $(".list-question .questions.hide").fadeIn(300);
            bind_mce();
        });
        
        
        return false;
        
    });
    
    $(".delete-question").live('click',function(){
        var ele = $(this);
        if(!confirm('Bạn có chắc xóa câu hỏi này không?')) return false;
        var questions = $(".list-question .questions");
        var parent = ele.parents('.questions');
        parent.fadeOut('slow',function(){
            parent.remove();
            if(questions.length == 1){
                $(".list-question").hide();
            }
        });        
        
        
        return false;
    });
    
    $('#test-nt .next').click(function(){
        var ele = $(this);
        $('#test-nt .submit-test').hide();
        var id = ele.attr('value');
         var total = $('.review').attr('value');
        
        $('#test-nt .question_'+id).hide();
        var id = ++id;
        $('#test-nt .question_'+id).show();
         if(id == total)
            $('#test-nt .submit-test').show();
        return false;
    });
    
    $('#test-nt .back').click(function(){
        $('#test-nt .submit-test').hide();
        var ele = $(this);
        var id = ele.attr('value');
        var total = $('.review').attr('value');
       
        $('#test-nt .question_'+id).hide();
        var id = --id;
        $('#test-nt .question_'+id).show();
        if(id == total)
            $('#test-nt .submit-test').show();
        return false;
    });
    
    $("#test-nt .review").click(function(){
        var ele = $(this);
        ele.hide();
        $('#test-nt .review-back').show();
        $('#test-nt .list-result').show();
        $('#test-nt .test').hide();
    });
    
    $("#test-nt .review-back").click(function(){
        var ele = $(this);
        ele.hide();
        $('#test-nt .review').show();
        $('#test-nt .test:eq(0)').show();
        $('#test-nt .list-result').hide();
        
    });
    
    $('#test-nt .choice_status').click(function(){
        var ele = $(this);
        var id = ele.attr('va');
 
        var checked = $('#test-nt input[name=choice_'+id+']:checked').val();
        if(checked)
        {
            var answered = "<i class='icon-ok'></i>";
            $('#test-nt .status_'+id).html(answered);            
        }
    });
    
    var choices = $("#test-nt .choice_status:checked");
    $.each(choices,function(k,v){
        var id = $(v).attr('va');
        var answered = "<i class='icon-ok'></i>";
        $('#test-nt .status_'+id).html(answered);            
    });
    
    $(".query-search").click(function(){
        var ele = $(this);
        var li = ele.parents('li');
        var form = ele.parents('form');
        li.remove();
        form.trigger('submit');
        return false;
    });
}

function add_test(){
    $('.create-test').click(function(){
        $(".add-test").toggle("slow");
    });
}
    

function bind_user(){
    $("#modal-card form,#modal-coupon form").ajaxForm({
        beforeSubmit:function(arr,ele){
            $(".modal .alert").remove();
        },
        success:function(response, statusText, xhr, ele){    
            var msg = '';
            $.each(response.message.error,function(k,v){
                msg = msg+v+"<br/>";
            });    
            if(!response.message.success){                           
                display_modal_error(ele, msg);
            }else{
                display_modal_success(ele, msg);     
                $("#user-amount").text(number_format(response.data.user_amount, 0, ',', '.')+"đ");
            }
            
        },
        dataType:'json'
    });    
    
    $("#modal-paypal form").ajaxForm({
        beforeSubmit:function(arr,ele){
            $(".modal .alert").remove();
            $("#modal-paypal input,#modal-paypal button").attr('disabled','disabled');
        },
        success:function(response, statusText, xhr, ele){    
            var msg = '';
            $.each(response.message.error,function(k,v){
                msg = msg+v+"<br/>";
            });    
            if(!response.message.success){               
                $("#modal-paypal input,#modal-paypal button").removeAttr('disabled');
                display_modal_error(ele, msg);
            }else{
                //display_modal_success(ele, msg);     
                //$("#user-amount").text(number_format(response.data.user_amount, 0, ',', '.')+"đ");
                window.location = response.data.link;
            }
            
        },
        dataType:'json'
    });    
    
    $(".frm-buy-card .update-price").click(function(){
        var ele = $(this);
        $(".frm-buy-card").ajaxSubmit({
            success:function(response, statusText, xhr, ele){    
                $(".price-vnd",ele).text(response.vnd);
                $(".price-usd",ele).text(response.usd);
            },
            dataType:'json',
            url: ele.attr('href')
        });
        return false;
    });
    
    $(".frm-buy-card .quantity").blur(function(){
        var ele = $(this);
        $(".frm-buy-card").ajaxSubmit({
            success:function(response, statusText, xhr, ele){    
                $(".frm-buy-card .price-vnd").text(response.vnd);
                $(".frm-buy-card .price-usd").text(response.usd);
            },
            dataType:'json',
            url: ele.attr('href')
        });
        return false;
    });
}

function display_modal_error(selector,msg){    
    var popup = $(".error-popup").clone().find('.message').html(msg).end();
    $(".modal-body",selector).prepend(popup);
    $(".modal-body .alert",selector).fadeIn('slow');
}

function display_modal_success(selector,msg){    
    var popup = $(".success-popup").clone().find('.message').html(msg).end();
    $(".modal-body",selector).prepend(popup);
    $(".modal-body .alert",selector).fadeIn('slow');
}

function show_subject(){
    $("#faculty .faculty").click(function(){    
             
        
        var id = $("#faculty .faculty").attr('value'); 
        $("#faculty .sub-"+id).toggle("slow");
        return false;
    });
}

function toefl_test(){
    $(".find-magu a.toefl-link").click(function(){
      
        //$('.find-magu .toefl-test').css('display','none');
        var ele = $(this);       
        var id = ele.attr('value');
        console.log(id);
        //        $('#toefl_'+id).css('display','block');
        $('#toefl_'+id).toggle('slow', function() {});
        return false;
    }
    )
}


function bind_mce(){
    
    tinyMCE.init({
        editor_selector : "tinymce",
        theme : "advanced",        
        
        mode : "specific_textareas",
        //plugins : "fullpage, equation",
        plugins:"autolink,equation,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager",
        theme_advanced_buttons1 : "equation",
        
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true
        
        
    });


}

function init(){
    /*
    $('a.setting').click(function(){
        var $span = $('span',$(this));
        var hide = $span.hasClass('ico-hide');
        var show = $span.hasClass('ico-show');
        var $body = $(this).parents('tbody');
        console.log($('.description-ticket',$body));
        if(hide){
            $span.removeClass('ico-hide').removeClass('icon-chevron-down').addClass('ico-show').addClass('icon-chevron-up');
            $('.description-ticket',$body).show();
        }else{
            $span.removeClass('ico-show').removeClass('icon-chevron-up').addClass('ico-hide').addClass('icon-chevron-down');
            $('.description-ticket',$body).hide();
        }
    });*/
    
    $('.url_edit').click(function(){
        var $p = $(this).parent(".preview");
        $p.removeClass('show').addClass('hide');
        $('#shortname .edit').removeClass('hide').addClass('show');
        $('#shortname .txt-edit-url').focus();
    });
    
    $('.url_cancel').click(function(){
        var $p = $(this).parents('.edit');
        $p.removeClass('show').addClass('hide');
        $('#shortname .preview').removeClass('hide').addClass('show');
    });
    
    $('ul.list-info li input[type=checkbox]').change(function(){
        var ele = $(this);
        var li = ele.parents('li');
        if($('.block-hide',li).hasClass('hide'))
            $('.block-hide',li).removeClass('hide').addClass('show');
        else
            $('.block-hide',li).removeClass('show').addClass('hide');
    });
    
    $('.facebook input[type=checkbox]').change(function(){
        var ele = $(this);
        var div = ele.parents('label').next();
        if(div.hasClass('hide'))
            div.removeClass('hide').addClass('show');
        else
            div.removeClass('show').addClass('hide');
    });
    
    $('.twitter input[type=checkbox]').change(function(){
        var ele = $(this);
        var div = ele.parents('label').next();
        if(div.hasClass('hide'))
            div.removeClass('hide').addClass('show');
        else
            div.removeClass('show').addClass('hide');
    });
    
    var socials = $('.socials input[type=checkbox]:checked');
    $.each(socials,function(k,v){
        var div = $(v).parents(".socials");
        $('.link',div).removeClass('hide').addClass('show');
    });
    
    
    var checkbox_organizer = $(".list-info input[type=checkbox]:checked");
    $.each(checkbox_organizer,function(k,v){
        var ele = $(v);
        var li = ele.parents('li');
        $(".block-hide",li).removeClass('hide').addClass('show');
    });
    
    
    var radio = $('ul#org_button_select li input[type=radio]:checked');
    var image = radio.next();
    image.addClass('selected');
    
    $('ul#org_button_select li input[type=radio]').change(function(){
        var ele = $(this);
        $('ul#org_button_select li img').removeClass();
        //var li = ele.parents('li');
        var img = ele.next();
        if(!img.hasClass('selected')){
            img.removeClass().addClass('selected');
            return false;
        }
    });
    
    $('.add_calendar').toggle(
        function(){
            var parent = $(this).parents('.event-body');
            $('.other-calendar',parent).slideDown(500);
        }
        ,function(){
            var parent = $(this).parents('.event-body');
            $('.other-calendar',parent).slideUp(500);
        }
        );  

    $('.toggle-preview').click(function(){
        var toggle_preview = $(this);
        var flag = toggle_preview.hasClass("down") ? false : true;

        if(flag){
            $(this).removeClass('up').addClass('down').css('margin-top','0px');
        }else{
            $(this).removeClass('down').addClass('up').css('margin-top','-20px');
        }
        $('.choose-themes').slideToggle("normal");
    });   
  
    $('#attendee').change(function(){
        if($('.attendees #attendee').prop('checked')) {
            $('.display-attendees').trigger('click');
        } else {
        // something else when not
        }
    });
    
    $('#modelAttends').on('hidden', function () {
        $('#attendee').removeAttr('checked');
    });
  
    $('.themes > p > a').click(function(){
        var index = $(this).index();
        $('.themes > p > a').removeClass('current');
        $(this).addClass('current');
        $('.tab-themes ul').hide().eq(index).show();
    });
    
    $(".btn-submit").click(function(){
        var ele= $(this);
        ele.parents('form').trigger('submit');
        return false;
    });
    
    $('.datetimepicker').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth:true,
        changeYear:true,
        yearRange: "c-1:c+1"
    });
    $(".button-submit").click(function(){
        var ele = $(this);
        ele.parents('form').trigger('submit');
        return false; 
    });
    
    $("a[rel=tooltip]").tooltip();
    
    $("table .delete-row").click(function(){
        if(!confirm("Are you sure you want to Delete?")) return false;
        var ele = $(this);
        $.get(ele.attr('href'),"",function(){
            ele.parents("tr").fadeOut('slow');
        });
        return false;
    });
    
    $(".require-login").click(function(){       
        window.location = baseUrl+"/user/signin/?return="+httpReferer;       
    });
}
function tab_active(){
    $('#theme_picker ul.themes li').click(function(){
        $('#theme_picker ul.themes li').removeClass();
        $(this).addClass('active');;
    });
}

function model_tab(){
    $('.header span').click(function(){
        var index = $(this).index();
        $('span',$(this).parent('.header')).removeClass('current');
        $(this).addClass('current');
        $('.content-html div').hide();
        $('.content-html div').eq(index).show();
    });
}

function number_format (number, decimals, dec_point, thousands_sep) {
    // *     example 1: number_format(1234.56);
    // *     returns 1: '1,235'
    // *     example 2: number_format(1234.56, 2, ',', ' ');
    // *     returns 2: '1 234,56'
    // *     example 3: number_format(1234.5678, 2, '.', '');
    // *     returns 3: '1234.57'
    // *     example 4: number_format(67, 2, ',', '.');
    // *     returns 4: '67,00'
    // *     example 5: number_format(1000);
    // *     returns 5: '1,000'
    // *     example 6: number_format(67.311, 2);
    // *     returns 6: '67.31'
    // *     example 7: number_format(1000.55, 1);
    // *     returns 7: '1,000.6'
    // *     example 8: number_format(67000, 5, ',', '.');
    // *     returns 8: '67.000,00000'
    // *     example 9: number_format(0.9, 0);
    // *     returns 9: '1'
    // *    example 10: number_format('1.20', 2);
    // *    returns 10: '1.20'
    // *    example 11: number_format('1.20', 4);
    // *    returns 11: '1.2000'
    // *    example 12: number_format('1.2000', 3);
    // *    returns 12: '1.200'
    // *    example 13: number_format('1 000,50', 2, '.', ' ');
    // *    returns 13: '100 050.00'
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
    };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}