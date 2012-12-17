<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_listening; ?>">Listening <?php echo $part; ?></a></li>
        <li><?php echo $listening_title; ?></li>
        <li><a href="<?php echo $link_object; ?>">CQ</a></li>
        <li>Manage Subjects & Choices</li>
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

            <div id="manage_cq">
                <h3>Manage Subjects & Choices</h3>
                <input id="cqid" type="hidden"  value="<?php if (isset($item->id)) echo $item->id; ?>"/>

                <div id="preview_cq" style="margin-bottom: 30px;">

                </div>

                <article class="half-block" style="min-height: 1000px;">

                    <!-- Article Container for safe floating -->
                    <div class="article-container row">

                        <!-- Article Content -->
                        <section>
                            <p>
                                <input class="medium" type="text" id="txt_add_row" style="width: 304px; margin-bottom: 10px;"><br/>
                                <a rel="tooltip" title="Update Row" class="button stats-view gray" id="update_row" href="#" style="display: none;">Update Row</a>
                                <a rel="tooltip" title="Add New Row" class="button stats-view blue" id="add_row" href="#">Add Row</a>
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

                <article class="half-block clearrm" style="min-height: 1000px;">

                    <!-- Article Container for safe floating -->
                    <div class="article-container column">

                        <!-- Article Content -->
                        <section>
                            <p>
                                <input class="medium" type="text" id="txt_add_column" style="width: 285px; margin-bottom: 10px;"><br/>
                                <a rel="tooltip" title="Update Column" class="button stats-view gray" id="update_column" href="#" style="display: none;">Update Column</a>
                                <a rel="tooltip" title="Add New Column" class="button stats-view blue" id="add_column" href="#">Add Column</a>
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

            </div>

        </div>
        <!-- /Article Container -->

    </article>
    <!-- /Full Content Block -->

</section>
<!-- /Main Content -->

<script>
    $().ready(function(){
        
        init_cq_manager();
        
        function init_cq_manager(){
            $('#txt_add_row').val('');
            $('#txt_add_column').val('');
        
            var url = '<?php echo base_url(); ?>listening_cq/load_columns/<?php echo $cqid; ?>';
            
            var cqid = $(this).attr('alt');
            var title = $(this).attr('title');
            
            $('.article-container.row ul li').remove();
            $('.article-container.column ul li').remove();
            
            var row = new Array();
            var col = new Array();

            var row_id_col = new Array();
            var row_id = new Array();
            var col_id = new Array();
            
            var row_count=0;
            var col_count=0;
            
            $.post(url,null, function(response) {
                var count=response['count'];
                index=-1;
                for (i=0;i<=count;i++){
                    index++;
                    col_id[index]=response[i];
                    col[index]=response[i+1];
                    
                    add_column(response[i], response[i+1]);
                    i++;
                }
                col_count=index;
                
                var url = '<?php echo base_url(); ?>listening_cq/load_rows/<?php echo $cqid; ?>';
                var row_count=0;
                $.post(url,null, function(response) {
                    count=response['count'];
                    index=-1;
                    for (i=0;i<=count;i++){
                        index++;
                        row_id[index]=response[i];
                        row[index]=response[i+1];
                        row_id_col[index]=response[i+2];
                    
                        add_row(response[i], response[i+1]);
                        i+=2;
                    }
                    row_count=index;
                    
                    
                    build_preview_table(row,col,row_id,col_id,row_count,col_count,row_id_col);
                    
                    
                }, 'json');
            }, 'json');
        }
        
        function reload_preview_table(cqid){
            var row = new Array();
            var col = new Array();

            var row_id_col = new Array();
            var row_id = new Array();
            var col_id = new Array();
            
            var row_count=0;
            var col_count=0;
            
            var url = '<?php echo base_url(); ?>listening_cq/load_columns/<?php echo $cqid; ?>';
            
            $.post(url,null, function(response) {
                var count=response['count'];
                index=-1;
                for (i=0;i<=count;i++){
                    index++;
                    col_id[index]=response[i];
                    col[index]=response[i+1];
                    i++;
                }
                col_count=index;
                
                var url = '<?php echo base_url(); ?>listening_cq/load_rows/<?php echo $cqid; ?>';
                var row_count=0;
                $.post(url,null, function(response) {
                    count=response['count'];
                    index=-1;
                    for (i=0;i<=count;i++){
                        index++;
                        row_id[index]=response[i];
                        row[index]=response[i+1];
                        row_id_col[index]=response[i+2];
                        i+=2;
                    }
                    row_count=index;
                    
                    build_preview_table(row,col,row_id,col_id,row_count,col_count,row_id_col);
                    
                    
                }, 'json');
            }, 'json');
        }
        
        function build_preview_table(row,col,row_id,col_id,row_count,col_count,row_id_col){
            var table='<table>';
            //create table header
            table+='<tr><td class="center bold">&nbsp;</td>';
            for (j=0;j<=col_count;j++){
                table+='<td class="center bold tbl_col'+col_id[j]+'">'+col[j]+'</td>';
            }
            table+='</tr>';
            //create table rows
                
            for (i=0;i<=row_count;i++){
                table+='<tr><td class="center bold tbl_row'+row_id[i]+'">'+row[i]+'</td>';
                for (j=0;j<=col_count;j++){
                    checked='';
                    if (row_id_col[i]==col_id[j]) checked=' checked="checked" ';
                    table+='<td class="center bold"><input type="radio" '+checked+' class="table_radio" name="row'+row_id[i]+'" alt="'+row_id[i]+'" value="'+col_id[j]+'" /></td>';
                }
                table+='</tr>';
            }
            table+='</table>';
                
            $('#preview_cq').html(table);
        }
        
        $('.table_radio').live('click',function(){
            var row_id = $(this).attr('alt');
            var col_id = $(this).val();
            
            var url = '<?php echo base_url(); ?>listening_cq/update_row_column';
                
            $.post(url, {row_id: row_id, col_id: col_id}, function() {
                
            }, 'json');
        });
        
        //delete row
        $('.article-container.row a.delete').live('click',function(){
            var id = $(this).attr('alt');
            var title = $(this).parent().children('p').html();
            
            if (confirm('Are you sure you want to delete ['+title+']?')){
                var url = '<?php echo base_url(); ?>listening_cq/delete_row/'+id;

                $.post(url, null, function() {
                    $('#row'+id).remove();
                    reload_preview_table(<?php echo $cqid; ?>);
                }, 'json');
                return false;
                
            }
            
        });
        
        //edit row
        $('.article-container.row a.edit').live('click',function(){
            var id = $(this).attr('alt');
            var title = $(this).parent().children('p').html();
            
            $('#txt_add_row').val(title);
            $('#txt_add_row').attr('alt',id);
            
            
            $('#update_row').show();
        });
            
        //delete column
        $('.article-container.column a.delete').live('click',function(){
            var id = $(this).attr('alt');
            var title = $(this).parent().children('p').html();
            
            if (confirm('Are you sure you want to delete ['+title+']?')){
                var url = '<?php echo base_url(); ?>listening_cq/delete_column/'+id;

                $.post(url, null, function(response) {
                    $('#column'+id).remove();
                    reload_preview_table(<?php echo $cqid; ?>);
                }, 'json');
                return false;
                
            }
        });
        
        //edit column
        $('.article-container.column a.edit').live('click',function(){
            var id = $(this).attr('alt');
            var title = $(this).parent().children('p').html();
            
            $('#txt_add_column').val(title);
            $('#txt_add_column').attr('alt',id);
            
            
            $('#update_column').show();
        });
        
        function add_row(id, title){
            var item='<li id="row'+id+'"><p class="row_title" alt="'+id+'">'+title+'</p><a class="button stats-view edit gray" alt="'+id+'" href="#">Edit</a> <a class="button stats-view delete" alt="'+id+'" href="#">Delete</a></li>';
            $('.article-container.row ul').append(item);
        }
        
        function update_row(id,title){
            $('#row'+id+' .row_title').html(title);
            $('.tbl_row'+id).html(title);
        }
            
        //add row
        $('#add_row').live('click',function(){
            var cqid = $('#cqid').val();
            var title = $('#txt_add_row').val();

            var url = '<?php echo base_url(); ?>listening_cq/add_row';
            
            $.post(url, {cqid: cqid, title: title}, function(response) {
                add_row(response['id'], title);
                
                reload_preview_table(cqid);
                
            }, 'json');
            return false;
            
        });
        
        //update row
        $('#update_row').live('click',function(){            
            var id = $('#txt_add_row').attr('alt');
            var title = $('#txt_add_row').val();
            
            var url = '<?php echo base_url(); ?>listening_cq/update_row';
            
            $.post(url, {id: id, title: title}, function(response) {
                update_row(id, title);
                $('#update_row').hide();
                $('#txt_add_row').val('');
            }, 'json');
                        
            return false;
            
        });
        
        function add_column(id, title){
            var item='<li id="column'+id+'"><p class="column_title" alt="'+id+'">'+title+'</p><a class="button stats-view edit gray" alt="'+id+'" href="#">Edit</a> <a class="button stats-view delete" alt="'+id+'" href="#">Delete</a></li>';
            $('.article-container.column ul').append(item);
        }
        
        function update_column(id,title){
            $('#column'+id+' .column_title').html(title);
            $('.tbl_col'+id).html(title);
        }
            
        //add column
        $('#add_column').live('click',function(){
            var cqid = $('#cqid').val();
            var title = $('#txt_add_column').val();

            var url = '<?php echo base_url(); ?>listening_cq/add_column';
            
            $.post(url, {cqid: cqid, title: title}, function(response) {
                add_column(response['id'], title);
                
                reload_preview_table(cqid);
                
            }, 'json');
            return false;
            
        });
        
        //update column
        $('#update_column').live('click',function(){            
            var id = $('#txt_add_column').attr('alt');
            var title = $('#txt_add_column').val();
            
            var url = '<?php echo base_url(); ?>listening_cq/update_column';
            
            $.post(url, {id: id, title: title}, function(response) {
                update_column(id, title);
                $('#update_column').hide();
                $('#txt_add_column').val('');
            }, 'json');
                        
            return false;
            
        });
    });
</script>