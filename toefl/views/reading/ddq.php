<div id="ddq">
    <?php
    if (isset($reading_ddq)) {
        foreach ($reading_ddq as $row) {
            ?>
            <div class="question" id="question<?php echo $row['number_question']; ?>" style="display: none;">
                <span class="bold">Directions:</span>
                <div style="font-size: 12px; line-height: 16px; margin-bottom: 20px;"><?php echo $row['content']; ?></div>
                <div>
                    <article class="half-block">
                        <div class="article-container choice">
                            <p class="center bold" style="margin: 10px;">Answer Choices</p>
                            <section>
                                <ul class="stats-summary">
                                    <?php
                                    if (isset($row['choice'])) {
                                        foreach ($row['choice'] as $row1) {
                                            ?>
                                            <li id="choice190" style="position: relative;" class="ui-draggable">
                                                <p alt="190" class="choice_title">
                                                    <?php echo $row1['title']; ?>
                                                </p>
                                                <a style="display: none;" class="button stats-view delete" alt="<?php echo $row1['id']; ?>" href="#">Delete</a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </section>
                        </div>
                    </article>
                    <div class="subject_wrapper">
                        <?php
                        if (isset($row['subject'])) {
                            foreach ($row['subject'] as $row1) {
                                ?>
                                <article class="half-block nested clearrm subject ddq<?php echo $row['id'] ?>" id="subject<?php echo $row1['id']; ?>" alt="<?php echo $row1['id']; ?>" number_question="<?php echo $row['number_question']; ?>">
                                    <div class="article-container subject">
                                        <header style="height: auto;">
                                            <div class="bold"><?php echo $row1['title']; ?></div>
                                            <a style="display: none;" class="button stats-view right delete" alt="<?php echo $row1['id']; ?>" href="#">Delete</a>
                                        </header>
                                        <section>
                                            <ul class="subject_list">
                                            </ul>
                                        </section>
                                    </div>
                                </article>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php
        }
    }
    ?>
</div>
<script>
    $().ready(function(){
        //draggable
        $('.article-container.choice li').live('mouseover',function(){
            $(this).draggable({
                revert: 'invalid',
                appendTo: 'body',
                containment: 'window',
                scroll: false,
                helper: 'clone',
                cursorAt: { left: 10, top: 10}
            });
        });
        
        function add_choice_to_subject(cid,title,subid){
            $('#subject'+subid+' ul.subject_list').append('<li>'+title+' (<a class="remove_choice" alt="'+cid+'" title="'+title+'">Remove</a>)</li>');
        }
        
        $('.remove_choice').live('click',function(){
            var cid = $(this).attr('alt');
            var title = $(this).attr('title');

            $(this).parents('li').remove();
            
            add_choice(cid, title);
        });
        
        function add_choice(id, title){
            var item='<li id="choice'+id+'"><p class="choice_title" alt="'+id+'">'+title+'</p><a style="display: none;" class="button stats-view delete" alt="'+id+'" href="#">Delete</a></li>';
            $('.article-container.choice ul').append(item);
        }

        //droppable
        $('.half-block.subject').droppable({
            drop: function( event, ui ) {
                question=$(this).attr('number_question');
                $('#status'+question).html('Answered');
            
                var cid = $(ui.draggable.context).children('.delete').attr('alt');
                var title = $(ui.draggable.context).children('.choice_title').text();
                var subid = $(this).find('.delete').attr('alt');
                    
                add_choice_to_subject(cid,title,subid);
                ($(ui.draggable)).remove();
                return false;
                    
            }
        });
    });
</script>