<div id="scq">
    <?php
    if (isset($reading_scq)) {
        foreach ($reading_scq as $row) {
            ?>
            <div class="question" id="question<?php echo $row['number_question']; ?>" style="display: none;">
                <article class="half-block left_panel">
                    <div class="article-container">
                        <section>
                            <p class="bold" style="margin-bottom: 20px;"><?php echo $row['title']; ?></p>
                            <p>
                                <input type="radio" class="scq_question" alt="<?php echo $row['number_question'] ?>" name="scq<?php echo $row['id']; ?>" value="1"> <?php echo $row['choice1']; ?>
                            </p>
                            <p>
                                <input type="radio" class="scq_question" alt="<?php echo $row['number_question'] ?>" name="scq<?php echo $row['id']; ?>" value="2"> <?php echo $row['choice2']; ?>
                            </p>
                            <p>
                                <input type="radio" class="scq_question" alt="<?php echo $row['number_question'] ?>" name="scq<?php echo $row['id']; ?>" value="3"> <?php echo $row['choice3']; ?>
                            </p>
                            <p>
                                <input type="radio" class="scq_question" alt="<?php echo $row['number_question'] ?>" name="scq<?php echo $row['id']; ?>" value="4"> <?php echo $row['choice4']; ?>
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