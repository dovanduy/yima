<div id="oq">
    <?php
    if (isset($reading_oq)) {
        foreach ($reading_oq as $row) {
            ?>
            <div class="question oq<?php echo $row['id']; ?>" id="question<?php echo $row['number_question']; ?>" style="display: none;">
                <article class="half-block left_panel">
                    <div class="article-container">
                        <section>
                            <div class="bold" style="margin-bottom: 20px;"><?php echo $row['title']; ?></div>
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
                        </section>
                    </div>
                </article>
                <article class="half-block text clearrm">
                    <div class="article-container">
                        <header><h2><?php echo $reading['title']; ?></h2></header>
                        <section><?php echo $row['content']; ?></section>
                    </div>
                </article> 
                <div class="clearfix"></div>
            </div>
            <?php
        }
    }
    ?>
</div>