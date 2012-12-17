<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li>User</li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2>User</h2>

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
                    <a class="button blue button-add right" href="<?php echo $link_add; ?>">Add</a>
                    <input type="submit" class="button right" value="Search"/>
                    <input type="text" name="search_val" class="right" value="<?php if (isset($search_val)) echo $search_val; ?>"/>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th width="20%">Campus</th>
                            <th width="20%">Group</th>
                            <th width="15%">Username</th>
                            <th width="15%">First Name</th>
                            <th width="15%">Last Name</th>
                            <th width="15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($items)) {
                            foreach ($items as $item) {
                                ?>
                                <tr id="item<?php echo $item->id; ?>">
                                    <td class="center <?php if ($item->group_id == 1) echo ' featured'; ?>"><?php if($item->campus_id!=0) echo $campus[$item->campus_id]; ?></td>
                                    <td class="center <?php if ($item->group_id == 1) echo ' featured'; ?>"><?php echo $user_group[$item->group_id];?></td>
                                    <td class="center <?php if ($item->group_id == 1) echo ' featured'; ?>"><?php echo $item->title; ?></td>
                                    <td class="center <?php if ($item->group_id == 1) echo ' featured'; ?>"><?php echo $item->firstname; ?></td>
                                    <td class="center <?php if ($item->group_id == 1) echo ' featured'; ?>"><?php echo $item->lastname; ?></td>
                                    <td>
                                        <ul class="actions">
                                            <li><a class="edit" href="<?php echo $link_edit . $item->id; ?>">Edit</a></li>
                                            <li><a class="delete" href="<?php echo $link_delete . $item->id; ?>">Delete</a></li>
                                        </ul>
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