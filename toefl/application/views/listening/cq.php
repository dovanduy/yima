<div id="cq">
    <?php
    if (isset($listening_cq)) {
        foreach ($listening_cq as $row) {
            ?>
            <div class="question" id="question<?php echo $row['number_question'] ?>" style="display: none;">
                <input type="hidden" class="question_type" value="cq">
                <?php echo '<input type="hidden" class="lsound" value="' . $row['lsound'] . '">'; ?>
                <?php echo '<input type="hidden" class="lsound_duration" value="' . $row['lsound_duration'] . '">'; ?>

                <?php echo '<input type="hidden" class="replay" value="' . $row['replay'] . '">'; ?>
                <?php echo '<input type="hidden" class="replay_from" value="' . $row['replay_from'] . '">'; ?>
                <?php echo '<input type="hidden" class="replay_to" value="' . $row['replay_to'] . '">'; ?>
                <?php echo '<input type="hidden" class="replay_sound" value="' . $row['replay_sound'] . '">'; ?>				

                <?php echo '<input type="hidden" class="sentence" value="' . $row['sentence'] . '">'; ?>
                <?php echo '<input type="hidden" class="sentence_sound" value="' . $row['sentence_sound'] . '">'; ?>
                <?php echo '<input type="hidden" class="sentence_sound_duration" value="' . $row['sentence_sound_duration'] . '">'; ?>

                <p style="margin-bottom: 20px;"><?php echo $row['content']; ?></p>
                <p class="center bold">Click in the correct box</p>
                <div class="cq_table"><?php echo $row['table']; ?></div>
            </div>
            <?php
        }
    }
    ?>
</div>