<div id="iq">
    <?php
    if (isset($reading_iq)) {
        foreach ($reading_iq as $row) {
            ?>
            <div class="question" id="question<?php echo $row['number_question']; ?>" style="display: none;">
                <article class="half-block left_panel">
                    <div class="article-container">
                        <section>
                            <p>Look at four squares <span class="square_demo">&nbsp;</span> that indicates where the following sentence can be added to the passage.</p>
                            <p class="iq_title"><?php echo $row['title']; ?></p>
                            <p>Where would the sentence best fit?</p>
                            <p>Click on a square <span class="square_demo">&nbsp;</span> to add the sentence to the passage.</p>
                        </section>
                    </div>
                </article>
                <article class="half-block text clearrm">
                    <div class="article-container">
                        <input id="iq<?php echo $row['id']; ?>" value="1" type="hidden"/>
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
<script>
    $().ready(function(){
        $('.square').live('click',function(){
            var choice=$(this).attr('alt');
            var iqid= $(this).attr('iqid');
            
            $('#iq'+iqid).val(choice);
            
            question=$(this).attr('number_question');
            $('#status'+question).html('Answered');
        });
    });
</script>