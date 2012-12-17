<div id="review_inner">
    <h2 style="background: #dedede; padding: 5px 10px;"><?php echo $firstname; ?> <?php echo $lastname; ?></h2>
    <table>
        <tr>
            <th width="100">Speaking Part</th>
            <th width="200">Subject</th>
            <th width="100">Score</th>
        </tr>
        <tr>
            <td>Independent Task 01</td>
            <td>
                <?php echo $speaking1['subject']; ?>
                <a href="<?php echo base_url();?>speaking/view/<?php echo $speaking1['id'];?>/1" target="_blank">View Details</a>
            </td>
            <td class="center">
                <?php if ($speaking1['recording']!=''):?>
                <a href="<?php echo $speaking1['recording']; ?>" target="_blank">Download File</a>
                <?php endif;?>
                <br/><?php echo $speaking1['score']; ?></td>
        </tr>
        <tr>
            <td>Independent Task 02</td>
            <td>
                <?php echo $speaking2['subject']; ?>
                <a href="<?php echo base_url();?>speaking/view/<?php echo $speaking2['id'];?>/2" target="_blank">View Details</a>
            </td>
            <td class="center">
                <?php if ($speaking2['recording']!=''):?>
                <a href="<?php echo $speaking2['recording']; ?>" target="_blank">Download File</a>
                <?php endif;?>
                <br/><?php echo $speaking2['score']; ?></td>
        </tr>
        <tr>
            <td>Integrated Task (Listening + Reading) 03</td>
            <td>
                <?php echo $speaking3['subject']; ?>
                <a href="<?php echo base_url();?>speaking/view/<?php echo $speaking3['id'];?>/3" target="_blank">View Details</a>
            </td>
            <td class="center">
                <?php if ($speaking3['recording']!=''):?>
                <a href="<?php echo $speaking3['recording']; ?>" target="_blank">Download File</a>
                <?php endif;?>
                <br/><?php echo $speaking3['score']; ?></td>
        </tr>
        <tr>
            <td>Integrated Task (Listening + Reading) 04</td>
            <td>
                <?php echo $speaking4['subject']; ?>
                <a href="<?php echo base_url();?>speaking/view/<?php echo $speaking4['id'];?>/4" target="_blank">View Details</a>
            </td>
            <td class="center">
                <?php if ($speaking4['recording']!=''):?>
                <a href="<?php echo $speaking4['recording']; ?>" target="_blank">Download File</a>
                <?php endif;?>
                <br/><?php echo $speaking4['score']; ?></td>
        </tr>
        <tr>
            <td>Integrated Task (Listening) 05</td>
            <td>
                <?php echo $speaking5['subject']; ?>
                <a href="<?php echo base_url();?>speaking/view/<?php echo $speaking5['id'];?>/5" target="_blank">View Details</a>
            </td>
            <td class="center">
                <?php if ($speaking5['recording']!=''):?>
                <a href="<?php echo $speaking5['recording']; ?>" target="_blank">Download File</a>
                <?php endif;?>
                <br/><?php echo $speaking5['score']; ?></td>
        </tr>
        <tr>
            <td>Integrated Task (Listening) 06</td>
            <td>
                <?php echo $speaking6['subject']; ?>
                <a href="<?php echo base_url();?>speaking/view/<?php echo $speaking6['id'];?>/6" target="_blank">View Details</a>
            </td>
            <td class="center">
                <?php if ($speaking6['recording']!=''):?>
                <a href="<?php echo $speaking6['recording']; ?>" target="_blank">Download File</a>
                <?php endif;?>
                <br/><?php echo $speaking6['score']; ?></td>
        </tr>
    </table>
    <img src="<?php echo base_url(); ?>data/instruction/Speaking(1-2).png" style="padding: 0; margin-top: 20px;"/>
    <img src="<?php echo base_url(); ?>data/instruction/Speaking(3-6).png" style="padding: 0; margin-top: 20px;"/>
</div>

<script>
    $().ready(function(){
        $('.sel_score').live('change',function(){
            var url = '<?php echo base_url(); ?>evaluation/speaking_update_sel_score';
            var id = $(this).attr('alt');
            var speaking_part = $(this).attr('speaking_part');
            var score = $(this).val();
            $.post(url,{id:id, speaking_part:speaking_part,score:score}, function() {}, 'json');
        });

    });
</script>