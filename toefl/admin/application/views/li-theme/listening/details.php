<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_object; ?>">Listening <?php echo $part; ?></a></li>
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
                            <dt><label>Type</label></dt><dd>
                                <select name="listening_type">
                                    <option value="0" <?php if (isset($item->listening_type) && $item->listening_type == 0) echo 'selected'; ?>>--- Select Type ---</option>
                                    <option value="1" <?php if (isset($item->listening_type) && $item->listening_type == 1) echo 'selected'; ?>><?php echo $type_group[1]; ?></option>
                                    <option value="2" <?php if (isset($item->listening_type) && $item->listening_type == 2) echo 'selected'; ?>><?php echo $type_group[2]; ?></option>
                                    <option value="3" <?php if (isset($item->listening_type) && $item->listening_type == 3) echo 'selected'; ?>><?php echo $type_group[3]; ?></option>
                                    <option value="4" <?php if (isset($item->listening_type) && $item->listening_type == 4) echo 'selected'; ?>><?php echo $type_group[4]; ?></option>
                                </select>
                            </dd>
                            <dt><label>Test Time</label></dt><dd><input class="medium" type="text" name="test_time" value="<?php if (isset($item->test_time)) echo $item->test_time; ?>"/></dd>
                            <dt><label>Source</label></dt><dd><input class="medium" type="text" name="source" value="<?php if (isset($item->source)) echo out_char($item->source); ?>"/></dd>
                            <dt><label>Keyword</label></dt><dd><input class="medium" type="text" name="keyword" value="<?php if (isset($item->keyword)) echo out_char($item->keyword); ?>"/></dd>
                            <dt><label>Sound</label></dt><dd><input class="fileupload customfile-input" name="lsound" type="file"></dd>
                            <?php if (isset($item->lsound) && $item->lsound != '') { ?>
                                <dt><label>&nbsp;</label></dt><dd>
                                    
                                    <div id="lsound">Loading the player ...</div>
                                    <script type="text/javascript">
                                        jwplayer("lsound").setup({ flashplayer: "<?php echo theme_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>data/sounds/listening/listening_page/<?php echo $item->lsound; ?>",
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