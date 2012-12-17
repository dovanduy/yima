<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_listening; ?>">Listening <?php echo $part; ?></a></li>
        <li><?php echo $listening_title; ?></li>
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

                <form action="<?php echo $link_current; ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                    <input name="id" type="hidden" value="<?php if (isset($id)) echo $id; ?>"/>
                    <fieldset>
                        <dl>
                            <dt><label>Question</label></dt><dd><input class="medium" type="text" name="title" value="<?php if (isset($item->title)) echo out_char($item->title); ?>"/></dd>
                            <dt><label>Question's Sound</label></dt><dd><input class="fileupload customfile-input" name="lsound" type="file"></dd>
                            <?php if (isset($item->lsound) && $item->lsound != '') { ?>
                                <dt><label>&nbsp;</label></dt><dd>
                                    <div id="lsound">Loading the player ...</div>
                                    <script type="text/javascript">
                                        jwplayer("lsound").setup({ flashplayer: "<?php echo theme_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>data/sounds/listening/mcq/<?php echo $item->lsound; ?>",
                                            height: 50,
                                            width: 250
                                        });
                                    </script>
                                </dd>
                            <?php } ?>
                            <dt><label>Choice 1&nbsp;&nbsp;&nbsp;<input type="checkbox" name="answer[]" value="1" <?php
                            if (isset($item->answer) && in_array(1, $item->answer))
                                echo 'checked';
                            ?>></label></dt><dd><input class="medium" type="text" name="choice1" value="<?php
                                                                        if (isset($item->choice1))
                                                                            echo out_char($item->choice1);
                            ?>"></dd>
                            <dt><label>Choice 2&nbsp;&nbsp;&nbsp;<input type="checkbox" name="answer[]" value="2" <?php
                                                                            if (isset($item->answer) && in_array(2, $item->answer))
                                                                                echo 'checked';
                            ?>></label></dt><dd><input class="medium" type="text" name="choice2" value="<?php
                                                                        if (isset($item->choice2))
                                                                            echo out_char($item->choice2);
                            ?>"></dd>
                            <dt><label>Choice 3&nbsp;&nbsp;&nbsp;<input type="checkbox" name="answer[]" value="3" <?php
                                                                            if (isset($item->answer) && in_array(3, $item->answer))
                                                                                echo 'checked';
                            ?>></label></dt><dd><input class="medium" type="text" name="choice3" value="<?php
                                                                        if (isset($item->choice3))
                                                                            echo out_char($item->choice3);
                            ?>"></dd>
                            <dt><label>Choice 4&nbsp;&nbsp;&nbsp;<input type="checkbox" name="answer[]" value="4" <?php
                                                                            if (isset($item->answer) && in_array(4, $item->answer))
                                                                                echo 'checked';
                            ?>></label></dt><dd><input class="medium" type="text" name="choice4" value="<?php
                                                                        if (isset($item->choice4))
                                                                            echo out_char($item->choice4);
                            ?>"></dd>
                        </dl>
                    </fieldset>

                    <fieldset>
                        <legend>Replay Listening Audio</legend>
                        <dl>
                            <dt><label>&nbsp;</label></dt><dd><input type="checkbox" name="replay" class="replay" value="1" <?php if (isset($item->replay) && $item->replay == 1) echo 'checked'; ?>>&nbsp;&nbsp;&nbsp;Replay</dd>
                            <dt><label>Sound</label></dt><dd><input class="fileupload customfile-input" name="replay_sound" type="file"></dd>
                            <?php if (isset($item->replay_sound) && $item->replay_sound != '') { ?>
                                <dt><label>&nbsp;</label></dt><dd>
                                    <div id="replay_sound">Loading the player ...</div>
                                    <script type="text/javascript">
                                        jwplayer("replay_sound").setup({ flashplayer: "<?php echo theme_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>data/sounds/listening/replay_sound/mcq/<?php echo $item->replay_sound; ?>",
                                            height: 50,
                                            width: 250
                                        });
                                    </script>
                                </dd>
                            <?php } ?>
                        </dl>
                    </fieldset>



                    <fieldset>
                        <legend>Replay Sentence Audio</legend>
                        <dl>
                            <dt><label>&nbsp;</label></dt><dd><input type="checkbox" name="sentence" class="sentence" value="1" <?php if (isset($item->sentence) && $item->sentence == 1) echo 'checked'; ?>>&nbsp;&nbsp;&nbsp;Replay</dd>
                            <dt class="sentence_div"><label>From</label></dt><dd class="sentence_div"><input class="small" type="text" name="sentence_from" value="<?php if (isset($item->sentence_from)) echo $item->sentence_from; ?>">&nbsp;&nbsp;&nbsp;second(s)</dd>
                            <dt class="sentence_div"><label>To</label></dt><dd class="sentence_div"><input class="small" type="text" name="sentence_to" value="<?php if (isset($item->sentence_to)) echo $item->sentence_to; ?>">&nbsp;&nbsp;&nbsp;second(s)</dd>
                            <dt><label>Sound</label></dt><dd><input class="fileupload customfile-input" name="sentence_sound" type="file"></dd>
                            <?php if (isset($item->sentence_sound) && $item->sentence_sound != '') { ?>
                                <dt><label>&nbsp;</label></dt><dd>
                                    <div id="sentence_sound">Loading the player ...</div>
                                    <script type="text/javascript">
                                        jwplayer("sentence_sound").setup({ flashplayer: "<?php echo theme_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>data/sounds/listening/sentence_sound/mcq/<?php echo $item->sentence_sound; ?>",
                                            height: 50,
                                            width: 250
                                        });
                                    </script>
                                </dd>
                            <?php } ?>
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