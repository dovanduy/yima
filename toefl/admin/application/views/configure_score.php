<div class="right" style="margin-bottom: 10px;"><a class="button close_score" alt="" href="#">Close</a></div>
<div class="clear"></div>
<button class="blue small" style="margin-bottom: 20px;" alt="">Add New Score</button>
<div class="sidetab" id="sidetab_configure_score" style="display: none;">
    <form action="<?php echo base_url(); ?>qb_configure_score_command" id="frm_score_details">
        <input type="hidden" name="question_type" value="<?php echo $question_type; ?>">
        <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
        <input type="hidden" name="action" value="edit">
        <input name="id" type="hidden" />
        <input name="branch_id" type="hidden" />
        <fieldset>
            <dl>
                <dt><label>Number of Right Choice</label></dt><dd><input class="medium" type="text" name="rightchoices"></dd>
                <dt><label>Score</label></dt><dd><input class="medium" type="text" name="score"></dd>
            </dl>
        </fieldset>
        <a href="#" class="cancel student">Cancel</a> or <button type="submit">Update</button>
    </form>
</div>
<div class="dataTables_wrapper">
    <table class="datatable">
        <thead>
            <tr>
                <th style="width: 40%;" class="sorting_asc">Number of Right Choice</th>
                <th style="width: 40%;" class="sorting">Score</th>
                <th style="width: 20%;" class="sorting">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Number of Right Choice</th>
                <th>Score</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            if (isset($scores)) {
                foreach ($scores as $item1) {
                    ?>
                    <tr>
                        <td class="sorting_1"><?php echo $item1['rightchoices']; ?></td>
                        <td><?php echo $item1['score']; ?></td>
                        <td><a class="button edit_score" alt="<?php echo $item1['id']; ?>" href="#">Edit</a></td>
                        <td><a class="button delete_score gray" alt="<?php echo $item1['id']; ?>" title="<?php echo $item1['rightchoices']; ?>" href="#">Delete</a></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    $().ready(function(){
        //Configure Score
        $('.button.close_score').live('click',function(){
            $('#shadow_box').fadeOut('normal');
            $('#configure_score').fadeOut('normal');
            $('#configure_score_inner').html('');
        });
        
        //Cancel
        $('a.cancel').live('click',function(){
            $('#sidetab_configure_score').slideUp('normal');
        });
        
        //Edit
        $('.button.edit_score').live('click',function(){
            $('#sidetab_configure_score').slideDown('normal');
            
            var url = '<?php echo base_url(); ?>qb_configure_score_command';
            var id = $(this).attr('alt');
            var action = 'load_details';
            $.post(url,{id:id, action:action}, function(response) {
                $('#frm_score_details input[name=action]').val('edit');
                $('#frm_score_details input[name=id]').val(response['id']);
                $('#frm_score_details input[name=rightchoices]').val(response['rightchoices']);
                $('#frm_score_details input[name=score]').val(response['score']);
            }, 'json');
        });
        
        //Add new
        $('button.blue').live('click',function(){
            $('#sidetab_configure_score').slideDown('normal');
            $('#frm_score_details input[name=action]').val('add');
            $('#frm_score_details input[name=id]').val(0);
            $('#frm_score_details input[name=rightchoices]').val(0);
            $('#frm_score_details input[name=score]').val(0);
        });
        
        //Submit
        $('#frm_score_details').submit(function(e){
            $('#sidetab_configure_score').slideUp('normal');
            e.preventDefault();
            var options ={
                beforeSubmit:  function(){},
                type:'POST',// pre-submit callback 
                success: function(getData){
                    if (getData['status']=='success'){
                        load_myself();
                    }else{
                        load_myself();
                    }
                },
                dataType:  'json'
            }
            $('#frm_score_details').ajaxSubmit(options);
        });
        
        function load_myself(){
            var url = '<?php echo base_url(); ?>qb_configure_score_command';
            var question_type = $('#frm_score_details input[name=question_type]').val();
            var question_id = $('#frm_score_details input[name=question_id]').val();
            var action = 'load_list';
            $.post(url,{question_type:question_type, question_id:question_id, action:action}, function(response) {
                $('#configure_score_inner').html(response);
            }, 'html');
        }
        
        // Delete
        $('.button.delete_score').live('click',function(){
            var id = $(this).attr('alt');
            var title = $(this).attr('title');
            var url = "<?php echo base_url(); ?>qb_configure_score_command";
            var action = 'delete';
            $.post(url, {id: id, title: title, action: action}, function(response) {
                load_myself();
            }, 'json');
            return false;
        });
    });
</script>