<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_reading; ?>">Reading <?php echo $part; ?></a></li>
        <li><?php echo $reading_title; ?></li>
        <li><a href="<?php echo $link_object; ?>">MCQ</a></li>
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
                            <dt><label>Question</label></dt><dd><input class="medium" type="text" name="title" value="<?php if (isset($item->title))
                echo out_char($item->title); ?>"/></dd>
                            <dt><label>Choice 1&nbsp;&nbsp;&nbsp;<input type="checkbox" name="answer[]" value="1" <?php if (isset($item->answer) && in_array(1, $item->answer))
                                                                            echo 'checked'; ?>></label></dt><dd><input class="medium" type="text" name="choice1" value="<?php if (isset($item->choice1))
                                                                            echo out_char($item->choice1); ?>"></dd>
                            <dt><label>Choice 2&nbsp;&nbsp;&nbsp;<input type="checkbox" name="answer[]" value="2" <?php if (isset($item->answer) && in_array(2, $item->answer))
                                                                            echo 'checked'; ?>></label></dt><dd><input class="medium" type="text" name="choice2" value="<?php if (isset($item->choice2))
                                                                            echo out_char($item->choice2); ?>"></dd>
                            <dt><label>Choice 3&nbsp;&nbsp;&nbsp;<input type="checkbox" name="answer[]" value="3" <?php if (isset($item->answer) && in_array(3, $item->answer))
                                                                            echo 'checked'; ?>></label></dt><dd><input class="medium" type="text" name="choice3" value="<?php if (isset($item->choice3))
                                                                            echo out_char($item->choice3); ?>"></dd>
                            <dt><label>Choice 4&nbsp;&nbsp;&nbsp;<input type="checkbox" name="answer[]" value="4" <?php if (isset($item->answer) && in_array(4, $item->answer))
                                                                            echo 'checked'; ?>></label></dt><dd><input class="medium" type="text" name="choice4" value="<?php if (isset($item->choice4))
                                                                            echo out_char($item->choice4); ?>"></dd>
                            <dt><label>Reading Text</label></dt><dd></dd>
                            <div style="margin: 20px 0;">
                                <textarea name="content" rows="5">
                                    <?php
                                    if (isset($item->content)) {
                                        echo $item->content;
                                    }else if (isset($reading_content) && $reading_content!='') {
                                        echo $reading_content;
                                    }
                                    ?>
                                </textarea>
                            </div>
                        </dl>
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