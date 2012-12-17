<div id="review_inner">
    <h2 style="background: #dedede; padding: 5px 10px;"><?php echo $firstname; ?> <?php echo $lastname; ?></h2>
    <table>
        <tr>
            <th width="100">Writing Part</th>
            <th width="200">Subject</th>
            <th width="400">Student's Writing</th>
            <th width="50">Score</th>
        </tr>
        <tr>
            <td>Integrated Task</td>
            <td>
                <?php echo $writing1['subject']; ?>
                <a href="<?php echo base_url();?>writing/view/<?php echo $writing1['id'];?>/1" target="_blank">View Details</a>
            </td>
            <td><?php echo $student_writing1; ?></td>
            <td><?php echo $writing1['score']; ?></td>
        </tr>
        <tr>
            <td>Independent Task</td>
            <td>
                <?php echo $writing2['subject']; ?>
                <a href="<?php echo base_url();?>writing/view/<?php echo $writing2['id'];?>/2" target="_blank">View Details</a>
            </td>
            <td><?php echo $student_writing2; ?></td>
            <td><?php echo $writing2['score']; ?></td>
        </tr>
    </table>
    <img src="<?php echo base_url(); ?>data/instruction/Integrated_Writing.png" style="padding: 0; margin-top: 20px;"/>
    <img src="<?php echo base_url(); ?>data/instruction/Independent_Writing.png" style="padding: 0; margin-top: 20px;"/>
</div>

<script>
    $().ready(function(){
        $('.sel_score').live('change',function(){
            var url = '<?php echo base_url(); ?>evaluation/writing_update_sel_score';
            var id = $(this).attr('alt');
            var writing_part = $(this).attr('writing_part');
            var score = $(this).val();
            $.post(url,{id:id, writing_part:writing_part,score:score}, function() {}, 'json');
        });
    });
</script>s