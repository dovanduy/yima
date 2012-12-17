<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_object; ?>">Result</a></li>
        <li>List</li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2><?php echo $session->title; ?></h2>

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

            <div class="controls" style="margin-bottom: 10px;">
                <strong>Filter by Class:</strong>&nbsp;&nbsp;&nbsp;
                <select id="filter_by_class" class="input-xxlarge">
                    <?php
                    foreach ($classes as $key => $val) {
                        ?>
                        <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>


            <!-- Article Content -->
            <section>
                <table>
                    <thead>
                        <tr>
                            <th width="22%">Student</th>
                            <th width="22%">Class</th>

                            <th width="7%">RD</th>
                            <th width="7%">LN</th>
                            <th width="7%">SK</th>
                            <th width="7%" style="border-right: 1px solid #ccc;">WT</th>

                            <th width="7%">S.RD</th>
                            <th width="7%">S.LN</th>
                            <th width="7%">S.SK</th>
                            <th width="7%">S.WT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($assigns)) {
                            foreach ($assigns as $item) {
                                ?>
                                <tr class="class class<?php echo $item['class_id']; ?>">
                                    <td class="bold"><?php echo $item['fullname']; ?></td>
                                    <td class="center"><?php echo $item['class']; ?></td>

                                    <td class="center"><?php echo $item['score_rd']; ?></td>
                                    <td class="center"><?php echo $item['score_ln']; ?></td>
                                    <td class="center"><?php echo $item['score_sk']; ?></td>
                                    <td class="center" style="border-right: 1px solid #ccc;"><?php echo $item['score_wt']; ?></td>

                                    <td class="center"><?php echo $item['scaled_score_rd']; ?></td>
                                    <td class="center"><?php echo $item['scaled_score_ln']; ?></td>
                                    <td class="center"><?php echo $item['scaled_score_sk']; ?></td>
                                    <td class="center"><?php echo $item['scaled_score_wt']; ?></td>
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

                <div id="test_details"></div>
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
        //---------------------------- Assign ---------------------------------------
        //Cancel
        $('.go_back').live('click',function(){
            $('#tab0 ul li:eq(5) a').trigger('click');
        });

        $('.button.view_details').live('click',function(){
            var url = '<?php echo base_url(); ?>evaluation/reading_details';
            var session_student_id = $(this).attr('alt');
            $.post(url,{session_student_id:session_student_id}, function(response) {
                $('#test_details').html(response);
            }, 'html');
        });

        $('#filter_by_class').change(function(){
            val=$('#filter_by_class').val();
            if (val==0){
                $('.class').show();
            }else{
                $('.class').hide();
                $('.class'+val).show();
            }

        });

    });
</script>