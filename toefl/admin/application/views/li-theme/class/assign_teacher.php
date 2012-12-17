<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_object; ?>">Class</a></li>
        <li>Teacher</li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2>Teacher</h2>

            </header>
            <!-- /Article Header -->

            <!-- Article Content -->
            <section>
                <form action="<?php echo $link_current; ?>" id="frm_search" method="post">
                    <input type="submit" class="button right" value="Search"/>
                    <input type="text" name="search_val" class="right" value="<?php if (isset($search_val)) echo $search_val; ?>"/>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th width="20%">Username</th>
                            <th width="20%">First Name</th>
                            <th width="20%">Last Name</th>
                            <th width="20%">Status</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($items)) {
                            foreach ($items as $item) {
                                ?>
                                <tr id="item<?php echo $item->id; ?>">
                                    <td class="center <?php if (isset($classes[$item->id]) && $classes[$item->id] == 1) echo 'featured'; ?>""><?php echo $item->title; ?></td>
                                    <td class="center <?php if (isset($classes[$item->id]) && $classes[$item->id] == 1) echo 'featured'; ?>""><?php echo $item->firstname; ?></td>
                                    <td class="center <?php if (isset($classes[$item->id]) && $classes[$item->id] == 1) echo 'featured'; ?>""><?php echo $item->lastname; ?></td>
                                    <td class="center <?php if (isset($classes[$item->id]) && $classes[$item->id] == 1) echo 'featured'; ?>">
                                        <?php
                                        if (isset($classes[$item->id]) && $classes[$item->id] == 1)
                                            echo 'In Class';
                                        ?>
                                    </td>
                                    <td>
                                        <ul class="actions">
                                            <?php
                                            if (isset($classes[$item->id]) && $classes[$item->id] == 1) {
                                                ?>
                                                <a class="button gray remove_from_class" alt="<?php echo $item->id; ?>" title="<?php echo $item->title; ?>" href="#">Remove from Class</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="button blue add_to_class" alt="<?php echo $item->id; ?>" title="<?php echo $item->title; ?>" href="#">Add to Class</a>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </section>
            <!-- /Article Content -->

        </div>
        <!-- /Article Container -->

    </article>
    <!-- /Full Content Block -->

</section>
<!-- /Main Content -->

<script>
    $().ready(function(){
        $('.remove_from_class').live('click',function(){
            var url = '<?php echo base_url(); ?>classes/teacher_remove_from_class';
            var class_id = <?php echo $class_id; ?>;
            var teacher_id = $(this).attr('alt');
            $.post(url,{class_id:class_id, teacher_id:teacher_id }, function(response) {
                $(location).attr('href','<?php echo $link_current; ?>');
            }, 'json');
        });
        $('.add_to_class').live('click',function(){
            $('.remove_from_class').trigger('click');
            var url = '<?php echo base_url(); ?>classes/teacher_add_to_class';
            var class_id = <?php echo $class_id; ?>;
            var teacher_id = $(this).attr('alt');
            $.post(url,{class_id:class_id, teacher_id:teacher_id }, function(response) {
                $(location).attr('href','<?php echo $link_current; ?>');
            }, 'json');
        });
    });
</script>