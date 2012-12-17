<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_object; ?>">Session</a></li>
        <li>Source Test</li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2>Source Test</h2>

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
                <table>
                    <thead>
                        <tr>
                            <th width="50%">Source Test</th>
                            <th width="20%">Status</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($source_tests)) {
                            foreach ($source_tests as $item) {
                                ?>
                                <tr id="item<?php echo $item['id']; ?>">
                                    <td class="center <?php if (isset($session_source_test[$item['id']]) && $session_source_test[$item['id']] == 1) echo 'featured'; ?>"><?php echo $item['title']; ?></td>
                                    <td class="center <?php if (isset($session_source_test[$item['id']]) && $session_source_test[$item['id']] == 1) echo 'featured'; ?>">
                                        <?php
                                        if (isset($session_source_test[$item['id']]) && $session_source_test[$item['id']] == 1)
                                            echo 'In Session';
                                        ?>
                                    </td>
                                    <td class="center">
                                        <?php
                                        if (isset($session_source_test[$item['id']]) && $session_source_test[$item['id']] == 1) {
                                            ?>
                                            <a class="button gray remove_from_session" alt="<?php echo $item['id']; ?>" title="<?php echo $item['title']; ?>" href="#">Remove from Session</a>
                                            <?php
                                        } else {
                                            ?>
                                            <a class="button blue add_to_session" alt="<?php echo $item['id']; ?>" title="<?php echo $item['title']; ?>" href="#">Add to Session</a>
                                            <?php
                                        }
                                        ?>
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

<script>
    $().ready(function(){
        $('.remove_from_session').live('click',function(){
            var url = '<?php echo base_url(); ?>session/source_test_session/remove';
            var session_id = <?php echo $session_id; ?>;
            var source_test_id = $(this).attr('alt');
            $.post(url,{session_id:session_id, source_test_id:source_test_id}, function(response) {
                $(location).attr('href','<?php echo $link_current; ?>');
            }, 'json');
        });
        
        $('.add_to_session').live('click',function(){
            var url = '<?php echo base_url(); ?>session/source_test_session/add';
            var session_id = <?php echo $session_id; ?>;
            var source_test_id = $(this).attr('alt');
            $.post(url,{session_id:session_id, source_test_id:source_test_id}, function(response) {
                $(location).attr('href','<?php echo $link_current; ?>');
            }, 'json');
        });
    });
</script>