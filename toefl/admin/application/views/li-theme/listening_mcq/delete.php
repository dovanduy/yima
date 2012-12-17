<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_listening; ?>">Listening <?php echo $part;?></a></li>
        <li><?php echo $listening_title;?></li>
        <li><a href="<?php echo $link_object; ?>">MCQ</a></li>
        <li>Delete</li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2>Delete</h2>
            </header>
            <!-- /Article Header -->
            
            <!-- Notification -->
            <div class="notification error" style="display: none;">
                <a href="#" class="close-notification">x</a>
                <p></p>
            </div>
            <!-- /Notification -->

            <!-- Article Content -->
            <section>
                <p>Are you sure you want to delete <strong><?php echo $item->title;?></strong>?</p>
                <a href="<?php echo $link_confirm_delete . $item->id; ?>" class="button">Yes</a> <a href="<?php echo $link_object; ?>" class="button gray">No</a>
            </section>
            <!-- /Article Content -->

        </div>
        <!-- /Article Container -->

    </article>
    <!-- /Full Content Block -->

</section>
<!-- /Main Content -->