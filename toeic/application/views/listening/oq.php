<div id="oq">
    <?php
    if (isset($listening_oq)) {
        foreach ($listening_oq as $row) {
            ?>
            <div class="question oq<?php echo $row['id']; ?>" id="question<?php echo $row['number_question'] ?>" style="display: none;">
                <input type="hidden" class="question_type" value="oq">
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
                    <p class="choice1" alt="4">
                        <img class="arrow arrow1" alt="2" value="1" num="<?php echo $row['number_question']; ?>" src="<?php echo base_url(); ?>img/widgets/widget_decrease.png"/>
                        <span><?php echo $row['choice4']; ?></span>
                    </p>
                    <p class="choice2" alt="1">
                        <img class="arrow" alt="1" value="2" num="<?php echo $row['number_question']; ?>" src="<?php echo base_url(); ?>img/widgets/widget_increase.png"/>
                        <img class="arrow" alt="3" value="2" num="<?php echo $row['number_question']; ?>" src="<?php echo base_url(); ?>img/widgets/widget_decrease.png"/>
                        <span><?php echo $row['choice1']; ?></span>
                    </p>
                    <p class="choice3" alt="3">
                        <img class="arrow" alt="2" value="3" num="<?php echo $row['number_question']; ?>" src="<?php echo base_url(); ?>img/widgets/widget_increase.png"/>
                        <img class="arrow" alt="4" value="3" num="<?php echo $row['number_question']; ?>" src="<?php echo base_url(); ?>img/widgets/widget_decrease.png"/>
                        <span><?php echo $row['choice3']; ?></span>
                    </p>
                    <p class="choice4" alt="2">
                        <img class="arrow arrow2" alt="3" value="4" num="<?php echo $row['number_question']; ?>" src="<?php echo base_url(); ?>img/widgets/widget_increase.png"/>
                        <span><?php echo $row['choice2']; ?></span>
                    </p>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>