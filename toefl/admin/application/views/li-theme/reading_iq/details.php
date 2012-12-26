<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_reading; ?>">Reading <?php echo $part; ?></a></li>
        <li><?php echo $reading_title; ?></li>
        <li><a href="<?php echo $link_object; ?>">IQ</a></li>
        <li><?php echo $h2_title; ?></li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2><?php echo $h2_title; ?></h2>
            </header>
            <!-- /Article Header -->

            <!-- Notification -->
            <?php
            if (isset($notification)) {
                ?>
                <div class="notification error">
                    <a href="#" class="close-notification">x</a>
                    <p><?php echo $notification; ?></p>
                </div>
                <?php
            }
            ?>
            <!-- /Notification -->

            <!-- Article Content -->
            <section>

                <form action="<?php echo $link_current; ?>" method="post">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                    <input name="id" type="hidden" value="<?php if (isset($id))
                echo $id; ?>"/>
                    <fieldset>
                        <dl>
                            <dt><label>Sentence</label></dt><dd><input class="medium" type="text" name="title" value="<?php if (isset($item->title))
                echo out_char($item->title); ?>"/></dd>
                            <dt><label>&nbsp;</label></dt><dd>
                                <input type="radio" name="answer" value="1" <?php if (isset($item->answer) && $item->answer == 1)
                               echo 'checked'; ?>> Position 1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="answer" value="2" <?php if (isset($item->answer) && $item->answer == 2)
                               echo 'checked'; ?>> Position 2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="answer" value="3" <?php if (isset($item->answer) && $item->answer == 3)
                               echo 'checked'; ?>> Position 3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="answer" value="4" <?php if (isset($item->answer) && $item->answer == 4)
                               echo 'checked'; ?>> Position 4
                            </dd>
                            <dt><label>&nbsp;</label></dt>
                            <dt><label>&nbsp;</label></dt><dd class="box_count"></dd>
                            <dt><label>&nbsp;</label></dt><dd>Click &nbsp;&nbsp;<button type="button" class="insert_box">Insert</button>&nbsp;&nbsp; to put code <span style="font-weight: bold; background: #ccc;">[box]</span> in place you want to insert sentence</dd>
                        </dl>
                        <dt><label>Reading Text</label></dt><dd></dd>
                            <div style="margin: 20px 0;">
                                <textarea name="content" rows="5">
                                    <?php
                                    if (isset($item->content)) {
                                        echo str_replace('[box]', '<span style="font-weight: bold; background: #ccc;">[box]</span>', str_replace('<span style="font-weight: bold; background: #ccc;"></span>', '', str_replace('<span style="font-weight: bold; background: #ccc;">[box]</span>', '[box]',  $item->content)));
                                    } else if (isset($reading_content) && $reading_content != '') {
                                        echo $reading_content;
                                    }
                                    ?>
                                </textarea>
                            </div>
                    </fieldset>
                    <input type="submit" class="button" value="Submit"/>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="<?php echo $link_object; ?>">Cancel</a>
                </form>

            </section>
            <!-- /Article Content -->

        </div>
        <!-- /Article Container -->

    </article>
    <!-- /Full Content Block -->

</section>
<!-- /Main Content -->
<script>
    $().ready(function(){
        number_box=count_box($('textarea.wysiwyg').val());
        $('.box_count').html('There are <strong>'+number_box+' box(es)</strong>');

        function count_box(str){
            var needles = ['\\[box\\]'];
            var pattern = new RegExp(needles[0], "g");
            var m = str.match(pattern);
            count=0;
            if (m) count=m.length;
            return count;
        }

        // Keypress
        $('.insert_box').live('click',function(){
            $('.wysiwyg').wysiwyg("insertHtml",'<span style="font-weight: bold; background: #ccc;">[box]</span> ');
            $('.wysiwyg').wysiwyg("save");
            number_box=count_box($('textarea.wysiwyg').val());
            $('.box_count').html('There are <strong>'+number_box+' box(es)</strong>');
        });
    });
</script>