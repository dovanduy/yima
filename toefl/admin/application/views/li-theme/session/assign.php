<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_object; ?>">Session</a></li>
        <li>Mixed Test</li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2>Assign</h2>

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
                <table class="assign">
                    <thead>
                        <tr>
                            <th width="20%">Student</th>
                            <th width="20%">Refresh</th>
                            <th width="15%">Teacher</th>
                            <?php if ($user_info['ss_assign_mixed'] == 1) { ?>
                                <th width="15%">Mixed Test</th>
                            <?php } ?>

                            <?php if ($user_info['ss_assign_order'] == 1) { ?>
                                <th width="15%">Test Order</th>
                            <?php } ?>

                            <?php if ($user_info['ss_assign_status'] == 1) { ?>
                                <th width="15%">Status</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($assigns)) {
                            foreach ($assigns as $item) {
                                ?>
                                <tr>
                                    <td>
                                        <span  class="bold"><?php echo $item['fullname']; ?></span><br/>
                                        <?php echo $item['class']; ?>
                                    </td>
                                    <td class="center">
                                        R: <?php echo $item['refreshR']; ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
                                        L: <?php echo $item['refreshL']; ?><br/>
                                        S: <?php echo $item['refreshS']; ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
                                        W: <?php echo $item['refreshW']; ?>
                                    </td>
                                    <td class="center">
                                        <?php
                                        if ($item['sk_teacher_id'] != 0):
                                            ?>
                                            SK: <?php echo $item['sk_teacher']; ?><br/>
                                            <?php echo date('d/m/Y', $item['sk_date']); ?><br/><br/>
                                            <?php
                                        endif;
                                        ?>
                                        <?php
                                        if ($item['wt_teacher_id'] != 0):
                                            ?>
                                            WT: <?php echo $item['wt_teacher']; ?><br/>
                                            <?php echo date('d/m/Y', $item['wt_date']); ?>
                                            <?php
                                        endif;
                                        ?>
                                    </td>

                                    <?php if ($user_info['ss_assign_mixed'] == 1) { ?>
                                        <td><?php echo $item['mixed_tests']; ?></td>
                                    <?php } ?>

                                    <?php if ($user_info['ss_assign_order'] == 1) { ?>
                                        <td><?php echo $item['test_orders']; ?></td>
                                    <?php } ?>

                                    <?php if ($user_info['ss_assign_status'] == 1) { ?>
                                        <td><?php echo $item['status']; ?><br/><br/><?php echo $item['disabled']; ?></td>
                                    <?php } ?>

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
<script>
    $().ready(function(){
        $('.sel_mixed_tests').live('change',function(){
            var url = '<?php echo base_url(); ?>session/update_sel_mixed_tests';
            var id = $(this).attr('alt');
            var mixed_test = $(this).val();
            $.post(url,{id:id, mixed_test:mixed_test}, function() {}, 'json');
        });
        
        $('.sel_disabled').live('change',function(){
            var url = '<?php echo base_url(); ?>session/update_sel_disabled';
            var id = $(this).attr('alt');
            var disabled = $(this).val();
            $.post(url,{id:id, disabled:disabled}, function() {}, 'json');
        });
        
        $('.sel_status').live('change',function(){
            var url = '<?php echo base_url(); ?>session/update_sel_status';
            var id = $(this).attr('alt');
            var status = $(this).val();
            $.post(url,{id:id, status:status}, function() {}, 'json');
        });
        
        $('.sel_test_orders').live('change',function(){
            var url = '<?php echo base_url(); ?>session/update_sel_test_orders';
            var id = $(this).attr('alt');
            var test_order = $(this).val();
            $.post(url,{id:id, test_order:test_order}, function() {}, 'json');
        });
    });
</script>