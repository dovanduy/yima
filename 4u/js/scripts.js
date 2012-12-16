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
    bind_post();
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
    if($("#search_bar").html() != null)
        filter_search($("#search_bar #organization_id").val(), $("#search_bar #faculty_id").val(), $("#search_bar #subject_id").val(),true);
    
    $("#search_bar #organization_id,#search_bar #faculty_id").change(function(){
       filter_search($("#search_bar #organization_id").val(), $("#search_bar #faculty_id").val(), $("#search_bar #subject_id").val(),false);
    });
}

function filter_search(oid,fid,sid,reload){
    if(reload){
        fid = $("#search_bar #current_faculty_id").val();
        sid = $("#search_bar #current_subject_id").val();
    }
    
    var data = {
        'oid':oid,
        'fid':fid,
        'sid':sid
    };
    $.get(baseUrl+"/post/filter_search/",data,function(response){
        $("#searchform #organization_id").val(oid)
        $("#searchform #faculty_id").html(response.faculty_html);
        $("#searchform #subject_id").html(response.subject_html);
    },'json');
}

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

function bind_mce(){
    
    tinyMCE.init({
        editor_selector : "tinymce",
        theme : "advanced",        
        mode : "specific_textareas",
        plugins : "fullpage"
        
    });

}

function init(){
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
    
    $(".require-login").click(function(){       
        window.location = baseDomain+"/user/signin/?return="+httpReferer;       
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

function display_error(msg){
    $(".alert-success").hide();
    $(".alert-error .msg").html(msg);
    $(".alert-error").fadeIn('slow');
}

function display_success(msg){
    $(".alert-error").hide();
    $(".alert-success .msg").html(msg);
    $(".alert-success").fadeIn('slow');
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