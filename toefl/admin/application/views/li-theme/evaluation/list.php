<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li>Evaluation</li>
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
                    <input type="submit" class="button right" value="Search"/>
                    <input type="text" name="search_val" class="right" value="<?php if (isset($search_val)) echo $search_val; ?>"/>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th width="40%">Session Name</th>
                            <th width="10%">Start Date</th>
                            <th width="10%">End Date</th>
                            <th width="10%">Reading</th>
                            <th width="10%">Listening</th>
                            <?php
                            if ($user_info['group_id'] == 3 || $user_info['group_id'] == 1):
                                ?>
                                <th width="10%">Speaking</th>
                                <th width="10%">Writing</th>
                                <?php
                            endif;
                            ?>
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
                                    <td class="center"><a class="edit" href="<?php echo $link_reading . $item->id; ?>">Reading</a>&nbsp;&nbsp;</td>
                                    <td class="center"><a class="edit" href="<?php echo $link_listening . $item->id; ?>">Listening</a>&nbsp;&nbsp;</td>
                                    <?php
                                    if ($user_info['group_id'] == 3 || $user_info['group_id'] == 1):
                                        ?>
                                        <td class="center"><a class="edit" href="<?php echo $link_speaking . $item->id; ?>">Speaking</a>&nbsp;&nbsp;</td>
                                        <td class="center"><a class="edit" href="<?php echo $link_writing . $item->id; ?>">Writing</a>&nbsp;&nbsp;</td>
                                        <?php
                                    endif;
                                    ?>
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