<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_listening; ?>">Listening <?php echo $part;?></a></li>
        <li><?php echo $listening_title;?></li>
        <li><a href="<?php echo $link_object; ?>">CQ</a></li>
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
                            <dt><label>Direction</label></dt><dd></dd>
                            <div style="margin: 20px 0;"><textarea class="large" name="content"><?php if (isset($item->content))
                                        echo out_char($item->content); ?></textarea></div>
                             <dt><label>Direction's Sound</label></dt><dd><input class="fileupload customfile-input" name="lsound" type="file"></dd>
                            <?php if (isset($item->lsound) && $item->lsound != '') { ?>
                                <dt><label>&nbsp;</label></dt><dd>
                                    
                                    <div id="lsound">Loading the player ...</div>
                                    <script type="text/javascript">
                                        jwplayer("lsound").setup({ flashplayer: "<?php echo theme_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>data/sounds/listening/cq/<?php echo $item->lsound; ?>",
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