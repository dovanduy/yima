<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_reading; ?>">Reading <?php echo $part; ?></a></li>
        <li><?php echo $reading_title; ?></li>
        <li><a href="<?php echo $link_object; ?>">DDQ</a></li>
        <li>Manage Subjects and Choices</li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">
            <!-- Article Header -->
            <header>
                <h2><?php if (isset($item->title)) echo $item->title; ?></h2>
            </header>
            <!-- /Article Header -->

            <div id="manage_ddq">

                <input id="ddqid" type="hidden" value="<?php if (isset($item->id)) echo $item->id; ?>"/>

                <article class="half-block" style="min-height: 1000px;">

                    <!-- Article Container for safe floating -->
                    <div class="article-container choice">

                        <!-- Article Content -->
                        <section>
                            <p>
                                <input class="medium" type="text" id="txt_add_choice" style="width: 290px; margin-bottom: 10px;"><br/>
                                <a rel="tooltip" title="Update Choice" class="button stats-view" id="update_choice" href="#" style="display: none;">Update Choice</a>
                                <a rel="tooltip" title="Add New Choice" class="button stats-view blue" id="add_choice" href="#">Add Choice</a>
                            </p>
                            <!-- Stats Summary -->
                            <ul class="stats-summary">
                            </ul>
                            <!-- /Stats Summary -->

                        </section>
                        <!-- /Article Content -->

                    </div>
                    <!-- /Article Container -->

                </article>

                <p style="margin-bottom: 10px;">
                    <input class="medium" type="text" id="txt_add_subject" style="width: 286px; margin-bottom: 10px;"><br/>
                    <a rel="tooltip" title="Update Subject" class="button stats-view" id="update_subject" href="#" style="display: none;">Update Subject</a>
                    <a rel="tooltip" title="Add New Subject" class="button stats-view blue" id="add_subject" href="#">Add Subject</a>
                </p>

            </div>

        </div>
        <!-- /Article Container -->

    </article>
    <!-- /Full Content Block -->

</section>
<!-- /Main Content -->

<script>
    $().ready(function(){
        
        init_ddq_manager();
        
        function init_ddq_manager(){
            $('#txt_add_choice').val('');
            $('#txt_add_subject').val('');
            
            var url = '<?php echo base_url(); ?>reading_ddq/load_subjects/<?php echo $ddqid; ?>';
            
            $('.half-block.subject').remove();
            $('.article-container.choice ul li').remove();
            
            $.post(url,null, function(response) {
                count=response['count'];
                for (i=0;i<=count;i++){
                    add_subject(response[i], response[i+1]);
                    i++;
                }
                
                var url = '<?php echo base_url(); ?>reading_ddq/load_choices/<?php echo $ddqid; ?>';
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
            var id = $(this).attr('alt');
            var title = $(this).parent().children('p').html();
            
            if (confirm('Are you sure you want to delete ['+title+']?')){
                var url = '<?php echo base_url(); ?>reading_ddq/delete_choice/'+id;

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
            
            if (confirm('Are you sure you want to delete ['+title+']?')){
                
                var url = '<?php echo base_url(); ?>reading_ddq/delete_subject/'+id;

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
            var item='<li id="choice'+id+'"><p class="choice_title" alt="'+id+'">'+title+'</p><a class="button stats-view edit gray" alt="'+id+'" href="#">Edit</a> <a class="button stats-view delete" alt="'+id+'" href="#">Delete</a></li>';
            $('.article-container.choice ul').append(item);
        }
        
        function update_choice(id,title){
            $('#choice'+id+' .choice_title').html(title);
        }
            
        //add choice
        $('#add_choice').live('click',function(){
            var ddqid = $('#ddqid').val();
            var title = $('#txt_add_choice').val();

            var url = '<?php echo base_url(); ?>reading_ddq/add_choice';
            
            $.post(url, {ddqid: ddqid, title: title}, function(response) {
                add_choice(response['id'], title);
            }, 'json');
            return false;
            
        });
        
        //update choice
        $('#update_choice').live('click',function(){            
            var id = $('#txt_add_choice').attr('alt');
            var title = $('#txt_add_choice').val();
            
            var url = '<?php echo base_url(); ?>reading_ddq/update_choice';
            
            $.post(url, {id: id, title: title}, function(response) {
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
            
            var url = '<?php echo base_url(); ?>reading_ddq/update_choice_subject';
            
            $.post(url, {id: cid, subid: 0}, function() {
                add_choice(cid, title);
            }, 'json');
        });
        
        function add_choice_to_subject(cid,title,subid){
            $('#subject'+subid+' ul.subject_list').append('<li>'+title+' - <a class="remove_choice" alt="'+cid+'" title="'+title+'">Remove</a></li>');
        }
        
        function add_subject(id, title){
            var item='<article class="half-block nested clearrm subject" id="subject'+id+'">'+

                '<!-- Article Container for safe floating -->'+
                '<div class="article-container subject">'+

                '<!-- Article Header -->'+
                '<header>'+
                '<h2 style="font-size: 16px;">'+title+'</h2>'+
                '<a class="button stats-view right edit gray" alt="'+id+'" href="#">Edit</a>'+
                '<a class="button stats-view right delete" alt="'+id+'" href="#" style="margin-right: 2px;">Delete</a> '+
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
            var url = '<?php echo base_url(); ?>reading_ddq/add_subject';
            
            var ddqid = $('#ddqid').val();
            var title = $('#txt_add_subject').val();

            $.post(url, {ddqid: ddqid, title: title}, function(response) {
                add_subject(response['id'], title);
            }, 'json');
            return false;
        });
        
        //update subject
        $('#update_subject').live('click',function(){            
            var id = $('#txt_add_subject').attr('alt');
            var title = $('#txt_add_subject').val();
            
            var url = '<?php echo base_url(); ?>reading_ddq/update_subject';
            
            $.post(url, {id: id, title: title}, function(response) {
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
                    
                    var url = '<?php echo base_url(); ?>reading_ddq/update_choice_subject';
            
                    $.post(url, {id: cid, subid: subid}, function(response) {
                        add_choice_to_subject(cid,title,subid);
                        ($(ui.draggable)).remove();
                    }, 'json');
                    return false;
                    
                }
            });
        });
                
    });
</script>