bind_mce();

$(document).ready(function(){
    init();
    init_ddq_manager();
    bind_subject_mod();
    bind_nt_test();
    bind_crawl_yahoo();
});

function bind_crawl_yahoo(){
    $("#crawl-post .more-detail").click(function(){
        var ele = $(this);
        if(ele.hasClass('disabled'))
            return false;
        ele.addClass('disabled').html('Calculating...');
        var category_id = $("#crawl-post .category-id").val();
        $("#crawl-post .more").addClass('hide');
        $.post(ele.attr('href'),{
            'category_id':category_id
        },function(response){
            console.log(response);
            ele.removeClass('disabled').html('More Detail');
            $("#crawl-post .category-name strong").text(response.category_title);
            $("#crawl-post .total-records span").text(response.total_records);
            $("#crawl-post .total-pages span").text(response.total_pages);
            $("#crawl-post .total-posts span").text(response.total_posts);
            $("#crawl-post .more").removeClass('hide');
        },'json');
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
    $.get(baseUrl+"/testNT/filter_search/",data,function(response){
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
    
    $(".fancybox").fancybox({
        mouseWheel : true,
        openEffect : 'elastic',
        openSpeed  : 200,

        closeEffect : 'elastic',
        closeSpeed  : 200
    });
    
    $(".list-images .image .pick").change(function(){
        var ele = $(this);
        var parent = ele.parents('.image');
        var checked = $(this).is(':checked');
        if(checked)
            parent.removeClass('unused');
        else
            parent.addClass('unused');
            
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
            goToByScroll('bottom');
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
    
    $(".disqualify-test").fancybox({
        
        });
    
    $(".form-disqualify").ajaxForm({
        beforeSubmit:function(formData, jqForm, options){
            var message = $.trim($('.content',jqForm).val());
            if(message == "")
            {
                alert('Please enter email content.');     
                return false;
            }
        },
        success:function(responseText, statusText, xhr, $form){
            
            $("#test"+responseText).fadeOut('slow');
            $.fancybox.close();
            
        }
    });
}

function goToByScroll(id){
    $('html,body').animate({
        scrollTop: $("#"+id).offset().top
    },'slow');
}

function bind_subject_mod(){
    var cache = {},lastXhr;
    $('#search_mod').keyup(function() {
        var ele = $(this);
        var parent = ele.parents('form');
        var str = $.trim($(this).val());
        if(str.length == 0)
            return false;        
        $("#search_mod").autocomplete({
            source: function( request, response ) {                
                var term = request.term;    
                if ( term in cache ) {
                    response( cache[ term ] );
                    return;
                }

                lastXhr = $.getJSON(baseUrl+'/subject/search_mod/s/' + str + '/', request, function( data, status, xhr ) {
                    cache[ term ] = data;
                    if ( xhr === lastXhr ) {
                        response( data );
                    }
                });
            },
            delay: 400,
            focus: function(event, ui) {
                $("#search_mod").val( ui.item.email );
                return false;
            },
            select: function(event, ui) { 
                $("#search_mod").val( ui.item.email );
                $("input[name=user_id]",parent).val(ui.item.user_id);
                return false;
            },
            change: function(event, ui) { 
                if (ui.item == null) {
                    $("input[name=user_id]",parent).val('');
                }
            }
        });        
    });
}


function insert_box()
{
    var box = '<span class="box_insert" style="font-weight: bold; background: #ccc;">[box]</span> '
    tinyMCE.execInstanceCommand("content","mceInsertContent",false,box);   
    return false;
}

function organization_change(){
    $(".faculty").fadeOut(300);
    $(".subject").fadeOut(300);
    
    var ele =  $('.organization');
    var organization  = $('.organization').val();
    var data = {
        'organization_id':organization
    };
    
    $.post(ele.attr('link'),data,function(response)
    {
        $(".faculty").html(response);
        $(".faculty").fadeIn(300);
    });
    return false;
}

function change_factulty(){
    var ele =  $('.list-faculty');
    var faculty_id  = $('.list-faculty').val();
     
    var organization  = $('.organization').val();
    var data = {
        'faculty_id':faculty_id,
        'organization_id':organization
    };
    
    $.post(ele.attr('link'),data,function(response)
    {
        $(".subject").html(response);
        $(".subject").fadeIn(300);
    });
    return false;
}


function changeFeatured(id){
    var ele = $("#featured_"+id);
    
    var data = {};
    $.post(ele.attr('linkFeatured'),data,function(response){
        
        });
    return false;    
}
function changeOrgSearch(id){
    var ele = $("#search_"+id);
    
    var data = {};
    $.post(ele.attr('linkSearch'),data,function(response){
        
        });
    return false; 
    
}
function changeSubFeatured(id){
    var ele = $("#featured_"+id);
    
    var data = {};
    $.post(ele.attr('linkFeatured'),data,function(response){
        
        });
    return false;    
}
function changeSubSearch(id){
    var ele = $("#search_"+id);
    
    var data = {};
    $.post(ele.attr('linkSearch'),data,function(response){
        
        });
    return false;
}



function init(){
    $("table .delete-row").click(function(){
        if(!confirm("Are you sure you want to Delete?")) return false;
        var ele = $(this);
        $.get(ele.attr('href'),"",function(){
            ele.parents("tr").fadeOut('slow');
        });
        return false; // khong chuyen trang
    });
    
    $("table .approve-test").click(function(){
        if(!confirm("Are you sure you want to Approve this test?")) return false;
        var ele = $(this);
        $.get(ele.attr('href'),"",function(){
            ele.parents("tr").fadeOut('slow');
        });
        return false; // khong chuyen trang
    });
    
    $(".delete-option").click(function(){
        if(!confirm("Are you sure you want to Delete?")) return false;
        var ele = $(this);
        $.get(ele.attr('href'),"",function(){
            ele.parents(".control-group").fadeOut('slow',function(){
                $(this).remove();
            });
        });
        return false; // khong chuyen trang
    });
    
    $(".subnav-down").click(function(){        
        var id = $(this).attr('id'); 
        $("."+id+"-list-item").toggle("slow");
    });
    
    $("#sidebar .toefl-test").click(function(){
        $(".toefl-test-list-item").toggle("slow");

    })
    
    $("#sidebar .toeic-test").click(function(){
        $(".toeic-test-list-item").toggle("slow");

    })
    
    $("#sidebar .nt-test").click(function(){
        $(".nt-test-list-item").toggle("slow");

    })
    
    $("#sidebar .faq").click(function(){
        $(".faq-list-item").toggle("slow");

    })
    $(".keyword_searching_test .featured").click(function(){
        var ele = $(this);
        $.get(ele.attr('href'),"",function(){
           
            });
    
    });
    
    $('.datetimepicker').datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth:true,
        changeYear:true,
        yearRange: "c-1:c+5"
    });
    
    $(".scroll-to").click(function(){
        var ele = $(this);
        goToByScroll(ele.attr('title'));
        return false;
    });
    
    $("a[rel=tooltip]").tooltip();
}

function bind_mce(){
    
    tinyMCE.init({
        editor_selector : "tinymce",
        theme : "advanced",        
        
        mode : "specific_textareas",
        //plugins : "fullpage, equation",
        plugins:"autolink,equation,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager",
        theme_advanced_buttons1 : "equation,save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,imagemanager,cleanup,help,code,forecolor,backcolor",
        theme_advanced_buttons3 : "formatselect,fontselect,fontsizeselect",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true
        
        
    });


}




        
function init_ddq_manager(){
   

    var hosturl = window.location.hostname;
   
    $('#txt_add_choice').val('');
    $('#txt_add_subject').val('');
            
    var url = $('#txt_add_subject').attr('url_sub');
            
    $('.half-block.subject').remove();
    $('.article-container.choice ul li').remove();
            
    $.post(url,null, function(response) {
        var count=response['count'];
        for (i=0;i<=count;i++){
            add_subject(response[i], response[i+1]);
            i++;
        }
                
        var url = $('#txt_add_choice').attr('url_choice');
        var cid = 0;
        var subid = 0;
        var title = 0;
            
        $.post(url,null, function(response) {
            count=response['count'];
            for (i=0;i<=count;i++){
                cid = response[i];
                subid = response[i+1];
                title = response[i+2];
                if (subid == 0){
                    add_choice(cid,title);
                }else{
                    add_choice_to_subject(cid,title,subid);
                }
                i+=2;
            }
                
        }, 'json');
                
    }, 'json'); 
    
}

//delete choice
$('.article-container.choice a.delete').live('click',function(){
    var hosturl = window.location.hostname;
    var id = $(this).attr('alt');
    var title = $(this).parent().children('p').html();
            
    if (confirm('Are you sure you want to delete ['+title+']?')){
       
        var url = 'http://'+hosturl+'/kto/back/toefl/readingDDQ/delete_choice/id/'+id;
      

        $.post(url, null, function() {
            $('#choice'+id).remove();
        }, 'json');
        return false;
                
    }
            
});
        
//edit choice
$('.article-container.choice a.edit').live('click',function(){
    var id = $(this).attr('alt');
    var title = $(this).parent().children('p').html();
            
    $('#txt_add_choice').val(title);
    $('#txt_add_choice').attr('alt',id);
            
            
    $('#update_choice').show();
});
            
//delete subject
$('.article-container.subject a.delete').live('click',function(){ 
    var id = $(this).attr('alt');
    var title = $(this).parent().children('h2').html();
    var hosturl = window.location.hostname;
            
    if (confirm('Are you sure you want to delete ['+title+']?')){
                
        
        var url = 'http://'+hosturl+'/kto/back/toefl/readingDDQ/delete_subject/id/'+id;
        $.post(url, null, function(response) {
            $('#subject'+id).remove();
        }, 'json');
        return false;
                
    }
});

//edit subject
$('.article-container.subject a.edit').live('click',function(){
    var id = $(this).attr('alt');
    var title = $(this).parent().children('h2').html();
            
    $('#txt_add_subject').val(title);
    $('#txt_add_subject').attr('alt',id);
            
    $('#update_subject').show();
});

function add_choice(id, title){
    var item='<li id="choice'+id+'" class="choice_class clearfix"><p class="choice_title" alt="'+id+'">'+title+'</p><a class="button stats-view delete btn btn-small btn-danger" alt="'+id+'" href="#">Delete</a>  <a class="button stats-view edit gray btn btn-small btn-inverse" alt="'+id+'" href="#">Edit</a></li>';
    $('.article-container.choice ul').append(item);
}
        
function update_choice(id,title){
    $('#choice'+id+' .choice_title').html(title);
}
            
//add choice
$('#add_choice').live('click',function(){
    var ddqid = $('#ddqid').val();
    var title = $('#txt_add_choice').val();

    //var url = 'http://toefl.ama.edu.vn/admin/reading_ddq/add_choice';
    var hosturl = window.location.hostname;
    var url = 'http://'+hosturl+'/kto/back/toefl/readingDDQ/add_choice';            
    $.post(url, {
        ddqid: ddqid, 
        title: title
    }, function(response) {
        add_choice(response['id'], title);
    }, 'json');
    return false;
            
});
        
//update choice
$('#update_choice').live('click',function(){            
    var id = $('#txt_add_choice').attr('alt');
    var title = $('#txt_add_choice').val();
            
    //var url = 'http://toefl.ama.edu.vn/admin/reading_ddq/update_choice';
    var hosturl = window.location.hostname;
    var url = 'http://'+hosturl+'/kto/back/toefl/readingDDQ/update_choice';     
            
    $.post(url, {
        id: id, 
        title: title
    }, function(response) {
        update_choice(id, title);
        $('#update_choice').hide();
        $('#txt_add_choice').val('');
    }, 'json');
                        
    return false;
            
});
            
$('.remove_choice').live('click',function(){
    var cid = $(this).attr('alt');
    var title = $(this).attr('title');

    $(this).parents('li').remove();
            
    //var url = 'http://toefl.ama.edu.vn/admin/reading_ddq/update_choice_subject';
    var hosturl = window.location.hostname;
    var url = 'http://'+hosturl+'/kto/back/toefl/readingDDQ/update_choice_subject'; 
            
    $.post(url, {
        id: cid, 
        subid: 0
    }, function() {
        add_choice(cid, title);
    }, 'json');
});
        
function add_choice_to_subject(cid,title,subid){
    $('#subject'+subid+' ul.subject_list').append('<li>'+title+' - <a class="remove_choice" alt="'+cid+'" title="'+title+'">Remove</a></li>');
}
        
function add_subject(id, title){
    var item='<article class="half-block nested clearrm subject" id="subject'+id+'">'+

    '<!-- Article Container for safe floating -->'+
    '<div class="article-container subject sub_class">'+

    '<!-- Article Header -->'+
    '<header>'+
    '<h2 style="font-size: 16px;">'+title+'</h2>'+
    '<a class="button stats-view right delete btn btn-small btn-danger" alt="'+id+'" href="#" style="margin-right: 2px;">Delete</a> '+
    '<a class="button stats-view right edit gray btn btn-small btn-inverse" alt="'+id+'" href="#">Edit</a>'+
   
    '<div class="clear"></div>'+
    '</header>'+
    '<!-- /Article Header -->'+

    '<!-- Article Content -->'+
    '<section>'+
    '<ul class="subject_list"></ul>'+
    '</section>'+
    '<!-- /Article Content -->'+

    '</div>'+
    '<!-- /Article Container -->'+

    '</article>';

    $('#manage_ddq').append(item);
}
        
function update_subject(id, title){
    $('#subject'+id+' h2').html(title);
}
            
//add subject
$('#add_subject').live('click',function(){
    //var url = 'http://toefl.ama.edu.vn/admin/reading_ddq/add_subject';
    var hosturl = window.location.hostname;
    var url = 'http://'+hosturl+'/kto/back/toefl/readingDDQ/add_subject';
            
    var ddqid = $('#ddqid').val();
    var title = $('#txt_add_subject').val();

    $.post(url, {
        ddqid: ddqid, 
        title: title
    }, function(response) {
        add_subject(response['id'], title);
    }, 'json');
    return false;
});
        
//update subject
$('#update_subject').live('click',function(){            
    var id = $('#txt_add_subject').attr('alt');
    var title = $('#txt_add_subject').val();
            
    //var url = 'http://toefl.ama.edu.vn/admin/reading_ddq/update_subject';
    var hosturl = window.location.hostname;
    var url = 'http://'+hosturl+'/kto/back/toefl/readingDDQ/update_subject';
            
    $.post(url, {
        id: id, 
        title: title
    }, function(response) {
        update_subject(id, title);
        $('#update_subject').hide();
        $('#txt_add_subject').val('');
    }, 'json');
                        
    return false;
            
});
            
//draggable
$('.article-container.choice li').live('mouseover',function(){
    $(this).draggable({
        revert: 'invalid'
    });
});

//droppable
$('.half-block.subject').live('mouseover',function(){
    $(this).droppable({
        drop: function( event, ui ) {
            var cid = $(ui.draggable.context).children('.delete').attr('alt');
            var title = $(ui.draggable.context).children('.choice_title').text();
            var subid = $(this).find('.delete').attr('alt');
                    
            //var url = 'http://toefl.ama.edu.vn/admin/reading_ddq/update_choice_subject';
            var hosturl = window.location.hostname;
            var url = 'http://'+hosturl+'/kto/back/toefl/readingDDQ/update_choice_subject';
            
            $.post(url, {
                id: cid, 
                subid: subid
            }, function(response) {
                add_choice_to_subject(cid,title,subid);
                ($(ui.draggable)).remove();
            }, 'json');
            return false;
                    
        }
    });
});

