<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_listening; ?>">Listening <?php echo $part;?></a></li>
        <li><?php echo $listening_title;?></li>
        <li>MCQ</li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2><?php echo $listening_title;?></h2>
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
                            <th width="60%">Question</th>
                            <th width="40%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($items)) {
                            foreach ($items as $item) {
                                ?>
                                <tr id="item<?php echo $item->id; ?>">
                                    <td><?php echo $item->title; ?></td>
                                    <td class="center">
                                        <?php if ($user_info['qb_edit'] == 1) { ?>
                                            <a class="score_reading_mcq" alt="<?php echo $item->id; ?>" href="#">Configure Score</a>&nbsp;&nbsp;
                                            <a class="edit" href="<?php echo $link_edit . $item->id; ?>">Edit</a>&nbsp;&nbsp;
                                        <?php } ?>
                                        <?php if ($user_info['qb_delete'] == 1) { ?>
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


<div id="shadow_box" style="display: none;"></div>
<div id="configure_score" style="display: none;">
    <div id="configure_score_inner"></div>
</div>

<script>
    $().ready(function(){
        function center_screen(selector){
            height=$(window).height();
            var vinTop = (height - $(selector).height())/2;
            if(vinTop<0)vinTop=0;
            $(selector).css("margin-top", vinTop + 'px');
        }
    
        function full_screen(selector){
            height=$(window).height();
            $(selector).css("height", height + 'px');
        }
        full_screen('#shadow_box');
        full_screen('#configure_score');
        center_screen('#configure_score_inner');
        
        //Configure Score
        $('.score_reading_mcq').live('click',function(){
            var url = '<?php echo base_url(); ?>qb_configure_score_command';
            var question_type = 'l_mcq';
            var question_id = $(this).attr('alt');
            var action = 'load_list';
            $.post(url,{question_type:question_type, question_id:question_id, action:action}, function(response) {
                $('#shadow_box').fadeIn('normal');
                $('#configure_score').fadeIn('normal');
                $('#configure_score_inner').html(response);
            }, 'html');
        });
        
    });
</script>