<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_listening; ?>">Listening <?php echo $part;?></a></li>
        <li><?php echo $listening_title;?></li>
        <li><a href="<?php echo $link_object; ?>">Video</a></li>
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
                            <dt><label>Question</label></dt><dd><input class="medium" type="text" name="title" value="<?php if (isset($item->title)) echo $item->title; ?>"/></dd>
                            <dt><label>Time</label></dt><dd><input class="medium" type="text" name="time" value="<?php if (isset($item->time)) echo $item->time; ?>"/></dd>
                            <dt><label>Image</label></dt><dd><input class="fileupload customfile-input" name="limg" type="file"></dd>
                            <dt><label>&nbsp;</label></dt><dd>
                                <?php if (isset($item->limg) && $item->limg != '') { ?>
                                    <div id="limg_file"><img src="<?php echo base_url(); ?>data/images/listening/<?php echo $item->limg; ?>" alt="" width="350"/></div>
                                <?php } ?>
                            </dd>
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