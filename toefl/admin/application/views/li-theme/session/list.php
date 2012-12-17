<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li>Session</li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2>Session</h2>

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
                            <th width="25%">Session Name</th>
                            <th width="15%">Start Date</th>
                            <th width="15%">End Date</th>
                            <th width="15%">Test</th>
                            <th width="15%">Student</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($items)) {
                            foreach ($items as $item) {
                                ?>
                                <tr id="item<?php echo $item->id; ?>">
                                    <td><?php echo $item->title; ?></td>
                                    <td class="center"><?php echo date('m/d/Y', $item->start_date); ?></td>
                                    <td class="center"><?php echo date('m/d/Y', $item->end_date); ?></td>
                                    <td class="center">
                                        <?php if ($user_info['ss_source'] == 1) { ?>
                                            <a class="edit" href="<?php echo $link_source . $item->id; ?>">Source</a>&nbsp;&nbsp;
                                        <?php } ?>
                                        <a class="edit" href="<?php echo $link_mixed . $item->id; ?>">Mixed</a>
                                    </td>
                                    <td class="center">
                                        <?php if ($user_info['ss_class'] == 1) { ?>
                                            <a class="edit" href="<?php echo $link_class . $item->id; ?>">Class</a>&nbsp;&nbsp;
                                        <?php } ?>
                                        <?php if ($user_info['ss_assign'] == 1) { ?>
                                            <a class="edit" href="<?php echo $link_assign . $item->id; ?>">Assign</a>
                                        <?php } ?>
                                    </td>
                                    <td class="center">
                                        <?php if ($user_info['ss_edit'] == 1) { ?>
                                            <a class="edit" href="<?php echo $link_edit . $item->id; ?>">Edit</a>&nbsp;&nbsp;
                                        <?php } ?>
                                        <?php if ($user_info['ss_delete'] == 1) { ?>
                                            <a class="delete" href="<?php echo $link_delete . $item->id; ?>">Delete</a>
                                        <?php } ?>
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