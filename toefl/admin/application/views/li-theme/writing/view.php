<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
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
                        <legend>Subject</legend>
                        <dl>
                            <dt><label>Subject</label></dt><dd style="padding-top: 5px; width: 450px;"><?php if (isset($item->subject)) echo out_char($item->subject); ?></dd>
                            <dt><label>Sound</label></dt><dd>
                                <?php if (isset($item->ssound) && $item->ssound != '') { ?>
                                
                                <div id="ssound">Loading the player ...</div>
                                    <script type="text/javascript">
                                        jwplayer("lsound").setup({ flashplayer: "<?php echo theme_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>data/sounds/writing/<?php echo $item->ssound; ?>",
                                            height: 50,
                                            width: 250
                                        });
                                    </script>
                                    
                                <?php } ?>
                            </dd>
                        </dl>
                    </fieldset>
                    <fieldset class="field_listening" style="<?php if ($part == 2) echo 'display: none;'; ?>">
                        <legend>Listening</legend>
                        <dl>
                            <dt><label></label></dt><dd>
                                <?php if (isset($item->limg) && $item->limg != '') { ?>
                                    <div id="limg_file"><img src="<?php echo base_url(); ?>data/images/writing/<?php echo $item->limg; ?>" alt="" width="350"/></div>
                                <?php } ?>
                            </dd>
                            <dt><label></label></dt><dd>
                                <?php if (isset($item->lsound) && $item->lsound != '') { ?>
                                
                                <div id="lsound">Loading the player ...</div>
                                    <script type="text/javascript">
                                        jwplayer("lsound").setup({ flashplayer: "<?php echo theme_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>data/sounds/writing/<?php echo $item->lsound; ?>",
                                            height: 50,
                                            width: 250
                                        });
                                    </script>
                                    
                                <?php } ?>
                            </dd>
                        </dl>
                    </fieldset>
                    <fieldset class="field_direction" style="<?php if ($part == 2) echo 'display: none;'; ?>">
                        <legend>Direction</legend>
                        <dl>
                            <dt><label></label></dt><dd style="padding-top: 5px; width: 450px;"><?php if (isset($item->direction)) echo out_char($item->direction); ?></dd>
                            <dt><label></label></dt><dd>
                                <?php if (isset($item->dsound) && $item->dsound != '') { ?>
                                
                                <div id="dsound">Loading the player ...</div>
                                    <script type="text/javascript">
                                        jwplayer("lsound").setup({ flashplayer: "<?php echo theme_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>data/sounds/writing/<?php echo $item->dsound; ?>",
                                            height: 50,
                                            width: 250
                                        });
                                    </script>
                                    
                                <?php } ?>
                            </dd>
                        </dl>
                    </fieldset>
                    <fieldset class="field_reading" style="<?php if ($part == 2) echo 'display: none;'; ?>">
                        <dt><label>Reading Text</label></dt><dd style="padding-top: 5px; width: 450px;"><?php if (isset($item->content)) echo $item->content; ?></dd>
                    </fieldset>
                </form>

            </section>
            <!-- /Article Content -->

        </div>
        <!-- /Article Container -->

    </article>
    <!-- /Full Content Block -->

</section>
<!-- /Main Content -->