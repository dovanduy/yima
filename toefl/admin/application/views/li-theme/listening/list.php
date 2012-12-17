<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li>Listening <?php echo $part;?></li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2>Listening <?php echo $part;?></h2>

            </header>
            <!-- /Article Header -->

            <!-- Notification -->
            <?php
            if (isset($notification)) {
                ?>
                <div class="notification success">
                    <a href="#" class="close-notification">x</a>
                    <p><?php echo $notification; ?></p>
                </div>
                <?php
            }
            ?>
            <!-- /Notification -->

            <!-- Article Content -->
            <section>
                <form action="<?php echo $link_search; ?>" id="frm_search" method="post">
                    <?php if ($user_info['group_id'] != 2) {?><a class="button blue button-add right" href="<?php echo $link_add; ?>">Add</a><?php }?>
                    <input type="submit" class="button right" value="Search"/>
                    <input type="text" name="search_val" class="right" value="<?php if (isset($search_val)) echo $search_val; ?>"/>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th width="25%">Title</th>
                            <th width="5%">Video</th>
                            <th width="5%">SCQ</th>
                            <th width="5%">MCQ</th>
                            <th width="5%">CQ</th>
                            <th width="5%">OQ</th>
                            <th width="20%">Action</th>
                            <th width="30%">Question</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($items)) {
                            foreach ($items as $item) {
                                ?>
                                <tr id="item<?php echo $item->id; ?>">
                                    <td><?php echo $item->title; ?></td>
                                    <td><?php echo $item->count_video; ?></td>
                                    <td><?php echo $item->count_scq; ?></td>
                                    <td><?php echo $item->count_mcq; ?></td>
                                    <td><?php echo $item->count_cq; ?></td>
                                    <td><?php echo $item->count_oq; ?></td>
                                    <td class="center">
                                        <?php if ($user_info['qb_edit'] == 1) { ?>
                                            <a class="edit" href="<?php echo $link_edit . $item->id; ?>">Edit</a>&nbsp;&nbsp;
                                        <?php } ?>
                                        <?php if ($user_info['qb_delete'] == 1) { ?>
                                            <a class="delete" href="<?php echo $link_delete . $item->id; ?>">Delete</a>
                                        <?php } ?>
                                    </td>
                                    <td class="center">
                                        <a class="edit" href="<?php echo $link_video . $item->id; ?>">Video</a>&nbsp;&nbsp;
                                        <a class="edit" href="<?php echo $link_scq . $item->id; ?>">SCQ</a>&nbsp;&nbsp;
                                        <a class="edit" href="<?php echo $link_mcq . $item->id; ?>">MCQ</a>&nbsp;&nbsp;
                                        <a class="edit" href="<?php echo $link_cq . $item->id; ?>">CQ</a>&nbsp;&nbsp;
                                        <a class="edit" href="<?php echo $link_oq . $item->id; ?>">OQ</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">
                                <?php if (isset($pagination)) echo $pagination; ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </section>
            <!-- /Article Content -->

        </div>
        <!-- /Article Container -->

    </article>
    <!-- /Full Content Block -->

</section>
<!-- /Main Content -->