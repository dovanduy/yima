<div id="scq">
    <?php
    if (isset($listening_part3)) {
        //print_r();die;
        foreach ($listening_part3 as $row) {
            ?>
            <div class="question" id="question<?php echo $row['number_question'] ?>" style="display: none;">
                <input type="hidden" class="question_type" value="scq">
                
                <?php echo '<input type="hidden" class="lsound" value="' . $row['lsound'] . '">'; ?>
                <?php echo '<input type="hidden" class="lsound_duration" value="' . $row['lsound_duration'] . '">'; ?>

                <?php echo '<input type="hidden" class="replay" value="' . $row['replay'] . '">'; ?>
                <?php echo '<input type="hidden" class="replay_from" value="' . $row['replay_from'] . '">'; ?>
                <?php echo '<input type="hidden" class="replay_to" value="' . $row['replay_to'] . '">'; ?>
                <?php echo '<input type="hidden" class="replay_sound" value="' . $row['replay_sound'] . '">'; ?>				

                <?php echo '<input type="hidden" class="sentence" value="' . $row['sentence'] . '">'; ?>
                <?php echo '<input type="hidden" class="sentence_sound" value="' . $row['sentence_sound'] . '">'; ?>
                <?php echo '<input type="hidden" class="sentence_sound_duration" value="' . $row['sentence_sound_duration'] . '">'; ?>

                <div class="title"><?php echo $row['question_1']; ?> &nbsp;&nbsp;<?php if ($row['sentence'] == 1) echo '<img src="' . base_url() . 'img/replay.gif" alt="" style="border:none;"/>'; ?></div>
                <div class="answer">
                    <p><input type="radio" name="part3_<?php echo $row['id']; ?>" value="1"> <?php echo $row['choice1_1']; ?></p>
                    <p><input type="radio" name="part3_<?php echo $row['id']; ?>" value="2"> <?php echo $row['choice2_1']; ?></p>
                    <p><input type="radio" name="part3_<?php echo $row['id']; ?>" value="3"> <?php echo $row['choice3_1']; ?></p>
                    <p><input type="radio" name="part3_<?php echo $row['id']; ?>" value="4"> <?php echo $row['choice4_1']; ?></p>
                </div>
                
                <div class="title"><?php echo $row['question_2']; ?> &nbsp;&nbsp;<?php if ($row['sentence'] == 1) echo '<img src="' . base_url() . 'img/replay.gif" alt="" style="border:none;"/>'; ?></div>
                <div class="answer">
                    <p><input type="radio" name="part3_<?php echo $row['id']; ?>" value="1"> <?php echo $row['choice1_2']; ?></p>
                    <p><input type="radio" name="part3_<?php echo $row['id']; ?>" value="2"> <?php echo $row['choice2_2']; ?></p>
                    <p><input type="radio" name="part3_<?php echo $row['id']; ?>" value="3"> <?php echo $row['choice3_2']; ?></p>
                    <p><input type="radio" name="part3_<?php echo $row['id']; ?>" value="4"> <?php echo $row['choice4_2']; ?></p>
                </div>
                
                <div class="title"><?php echo $row['question_3']; ?> &nbsp;&nbsp;<?php if ($row['sentence'] == 1) echo '<img src="' . base_url() . 'img/replay.gif" alt="" style="border:none;"/>'; ?></div>
                <div class="answer">
                    <p><input type="radio" name="part3_<?php echo $row['id']; ?>" value="1"> <?php echo $row['choice1_3']; ?></p>
                    <p><input type="radio" name="part3_<?php echo $row['id']; ?>" value="2"> <?php echo $row['choice2_3']; ?></p>
                    <p><input type="radio" name="part3_<?php echo $row['id']; ?>" value="3"> <?php echo $row['choice3_3']; ?></p>
                    <p><input type="radio" name="part3_<?php echo $row['id']; ?>" value="4"> <?php echo $row['choice4_3']; ?></p>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>