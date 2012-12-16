<div id="mcq">
    <?php
    if (isset($listening_mcq)) {
        foreach ($listening_mcq as $row) {
            ?>
            <div class="question" id="question<?php echo $row['number_question'] ?>" style="display: none;">
                <input type="hidden" class="question_type" value="mcq">
                <?php echo '<input type="hidden" class="lsound" value="' . $row['lsound'] . '">'; ?>
                <?php echo '<input type="hidden" class="lsound_duration" value="' . $row['lsound_duration'] . '">'; ?>

                <?php echo '<input type="hidden" class="replay" value="' . $row['replay'] . '">'; ?>
                <?php echo '<input type="hidden" class="replay_from" value="' . $row['replay_from'] . '">'; ?>
                <?php echo '<input type="hidden" class="replay_to" value="' . $row['replay_to'] . '">'; ?>
                <?php echo '<input type="hidden" class="replay_sound" value="' . $row['replay_sound'] . '">'; ?>				

                <?php echo '<input type="hidden" class="sentence" value="' . $row['sentence'] . '">'; ?>
                <?php echo '<input type="hidden" class="sentence_sound" value="' . $row['sentence_sound'] . '">'; ?>
                <?php echo '<input type="hidden" class="sentence_sound_duration" value="' . $row['sentence_sound_duration'] . '">'; ?>

                <div class="title"><?php echo $row['title']; ?></div>
                <div class="answer">
                    <p><input type="checkbox" class="mcq<?php echo $row['id']; ?>" value="1"> <?php echo $row['choice1']; ?></p>
                    <p><input type="checkbox" class="mcq<?php echo $row['id']; ?>" value="2"> <?php echo $row['choice2']; ?></p>
                    <p><input type="checkbox" class="mcq<?php echo $row['id']; ?>" value="3"> <?php echo $row['choice3']; ?></p>
                    <p><input type="checkbox" class="mcq<?php echo $row['id']; ?>" value="4"> <?php echo $row['choice4']; ?></p>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>