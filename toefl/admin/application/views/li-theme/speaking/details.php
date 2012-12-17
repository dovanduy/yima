<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_object; ?>"><?php echo $part_name; ?></a></li>
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
                            <dt><label>Title</label></dt><dd><input class="medium" type="text" name="title" value="<?php if (isset($item->title)) echo out_char($item->title); ?>"/></dd>
                            <dt><label>Level</label></dt><dd>
                                <select name="level">
                                    <option value="0" <?php if (isset($item->level) && $item->level == 0) echo 'selected'; ?>>--- Select Level ---</option>
                                    <option value="1" <?php if (isset($item->level) && $item->level == 1) echo 'selected'; ?>><?php echo $level_group[1]; ?></option>
                                    <option value="2" <?php if (isset($item->level) && $item->level == 2) echo 'selected'; ?>><?php echo $level_group[2]; ?></option>
                                    <option value="3" <?php if (isset($item->level) && $item->level == 3) echo 'selected'; ?>><?php echo $level_group[3]; ?></option>
                                    <option value="4" <?php if (isset($item->level) && $item->level == 4) echo 'selected'; ?>><?php echo $level_group[4]; ?></option>
                                </select>
                            </dd>
                            <dt><label>Source</label></dt><dd><input class="medium" type="text" name="source" value="<?php if (isset($item->source)) echo out_char($item->source); ?>"/></dd>
                            <dt><label>Keyword</label></dt><dd><input class="medium" type="text" name="keyword" value="<?php if (isset($item->keyword)) echo out_char($item->keyword); ?>"/></dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                        <legend>Subject</legend>
                        <dl>
                            <dt><label>Subject</label></dt><dd><input class="medium" type="text" name="subject" value="<?php if (isset($item->subject)) echo out_char($item->subject); ?>"></dd>
                            <dt><label>Sound</label></dt><dd><input class="fileupload customfile-input" name="ssound" type="file"></dd>
                            <dt><label>&nbsp;</label></dt><dd><div id="ssound_file"></div></dd>
                            <?php if (isset($item->ssound) && $item->ssound != '') { ?>
                                <dt><label>&nbsp;</label></dt><dd>
                                    
                                    <div id="ssound">Loading the player ...</div>
                                    <script type="text/javascript">
                                        jwplayer("lsound").setup({ flashplayer: "<?php echo theme_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>data/sounds/speaking/<?php echo $item->ssound; ?>",
                                            height: 50,
                                            width: 250
                                        });
                                    </script>
                                    
                                </dd>
                            <?php } ?>
                        </dl>
                    </fieldset>
                    <fieldset class="field_listening" style="<?php if ($part == 1 || $part == 2) echo 'display: none;'; ?>">
                        <legend>Listening</legend>
                        <dl>
                            <dt><label>Image</label></dt><dd><input class="fileupload customfile-input" name="limg" type="file"></dd>
                            <dt><label>&nbsp;</label></dt><dd>
                                <?php if (isset($item->limg) && $item->limg != '') { ?>
                                    <div id="limg_file"><img src="<?php echo base_url(); ?>data/images/speaking/<?php echo $item->limg; ?>" alt="" width="350"/></div>
                                <?php } ?>
                            </dd>
                            <dt><label>Sound</label></dt><dd><input class="fileupload customfile-input" name="lsound" type="file"></dd>
                            <?php if (isset($item->lsound) && $item->lsound != '') { ?>
                                <dt><label>&nbsp;</label></dt><dd>
                                    
                                    <div id="lsound">Loading the player ...</div>
                                    <script type="text/javascript">
                                        jwplayer("lsound").setup({ flashplayer: "<?php echo theme_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>data/sounds/speaking/<?php echo $item->lsound; ?>",
                                            height: 50,
                                            width: 250
                                        });
                                    </script>
                                    
                                </dd>
                            <?php } ?>
                        </dl>
                    </fieldset>
                    <fieldset class="field_direction" style="<?php if ($part == 1 || $part == 2 || $part == 5 || $part == 6) echo 'display: none;'; ?>">
                        <legend>Direction</legend>
                        <dl>
                            <dt><label>Direction</label></dt><dd><input class="medium" type="text" name="direction" value="<?php if (isset($item->direction)) echo out_char($item->direction); ?>"></dd>
                            <dt><label>Sound</label></dt><dd><input class="fileupload customfile-input" name="dsound" type="file"></dd>
                            <?php if (isset($item->dsound) && $item->dsound != '') { ?>
                                <dt><label>&nbsp;</label></dt><dd>
                                    
                                    <div id="dsound">Loading the player ...</div>
                                    <script type="text/javascript">
                                        jwplayer("lsound").setup({ flashplayer: "<?php echo theme_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>data/sounds/speaking/<?php echo $item->dsound; ?>",
                                            height: 50,
                                            width: 250
                                        });
                                    </script>
                                    
                                </dd>
                            <?php } ?>
                        </dl>
                    </fieldset>
                    <fieldset class="field_reading" style="<?php if ($part == 1 || $part == 2 || $part == 5 || $part == 6) echo 'display: none;'; ?>">
                        <dt><label>Reading Text</label></dt><dd></dd>
                        <div style="margin: 20px 0;"><textarea name="content" rows="5"><?php if (isset($item->content)) echo $item->content; ?></textarea></div>
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