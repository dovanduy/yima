<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_object; ?>">Source Test</a></li>
        <li><?php echo $h2_title; ?></li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2><?php echo $h2_title; ?></h2>
            </header>
            <!-- /Article Header -->

            <!-- Notification -->
            <?php
            if (isset($notification)) {
                ?>
                <div class="notification error">
                    <a href="#" class="close-notification">x</a>
                    <p><?php echo $notification; ?></p>
                </div>
                <?php
            }
            ?>
            <!-- /Notification -->

            <!-- Article Content -->
            <section>

                <form action="<?php echo $link_current; ?>" method="post" id="frm_source_test">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                    <input name="id" type="hidden" value="<?php if (isset($id)) echo $id; ?>"/>
                    <fieldset>
                        <dl>
                            <dt><label>Title</label></dt><dd><input class="medium" type="text" name="title" value="<?php if (isset($item->title)) echo $item->title; ?>"/></dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                        <legend>Reading</legend>
                        <dl>
                            <dt><label>Reading 01</label></dt><dd><?php if (isset($sel_reading1)) echo $sel_reading1; ?></dd>
                            <dt><label>Reading 02</label></dt><dd><?php if (isset($sel_reading2)) echo $sel_reading2; ?></dd>
                            <dt><label>Reading 03</label></dt><dd><?php if (isset($sel_reading3)) echo $sel_reading3; ?></dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                        <legend>Listening</legend>
                        <dl>
                            <dt><label>Listening 01</label></dt><dd><?php if (isset($sel_listening1)) echo $sel_listening1; ?></dd>
                            <dt><label>Listening 02</label></dt><dd><?php if (isset($sel_listening2)) echo $sel_listening2; ?></dd>
                            <dt><label>Listening 03</label></dt><dd><?php if (isset($sel_listening3)) echo $sel_listening3; ?></dd>
                            <dt><label>Listening 04</label></dt><dd><?php if (isset($sel_listening4)) echo $sel_listening4; ?></dd>
                            <dt><label>Listening 05</label></dt><dd><?php if (isset($sel_listening5)) echo $sel_listening5; ?></dd>
                            <dt><label>Listening 06</label></dt><dd><?php if (isset($sel_listening6)) echo $sel_listening6; ?></dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                        <legend>Speaking</legend>
                        <dl>
                            <dt><label>Independent Task 01</label></dt><dd><?php if (isset($sel_speaking1)) echo $sel_speaking1; ?></dd>
                            <dt><label>Independent Task 02</label></dt><dd><?php if (isset($sel_speaking2)) echo $sel_speaking2; ?></dd>
                            <dt><label>Integrated Task (L+R) 03</label></dt><dd><?php if (isset($sel_speaking3)) echo $sel_speaking3; ?></dd>
                            <dt><label>Integrated Task (L+R) 04</label></dt><dd><?php if (isset($sel_speaking4)) echo $sel_speaking4; ?></dd>
                            <dt><label>Integrated Task (L) 05</label></dt><dd><?php if (isset($sel_speaking5)) echo $sel_speaking5; ?></dd>
                            <dt><label>Integrated Task (L) 06</label></dt><dd><?php if (isset($sel_speaking6)) echo $sel_speaking6; ?></dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                        <legend>Writing</legend>
                        <dl>
                            <dt><label>Integrated Task</label></dt><dd><?php if (isset($sel_writing1)) echo $sel_writing1; ?></dd>
                            <dt><label>Independent Task</label></dt><dd><?php if (isset($sel_writing2)) echo $sel_writing2; ?></dd>
                        </dl>
                    </fieldset>
                    <input type="submit" class="button" value="Submit"/>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="<?php echo $link_object; ?>">Cancel</a>
                </form>

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
        $('#frm_source_test #sel_reading1').val(<?php if (isset($item->reading1)) {echo $item->reading1; } else { echo '0';} ?>);
        $('#frm_source_test #sel_reading2').val(<?php if (isset($item->reading2)) {echo $item->reading2; } else { echo '0';} ?>);
        $('#frm_source_test #sel_reading3').val(<?php if (isset($item->reading3)) {echo $item->reading3; } else { echo '0';} ?>);
                
        $('#frm_source_test #sel_listening1').val(<?php if (isset($item->listening1)) {echo $item->listening1; } else { echo '0';} ?>);
        $('#frm_source_test #sel_listening2').val(<?php if (isset($item->listening2)) {echo $item->listening2; } else { echo '0';} ?>);
        $('#frm_source_test #sel_listening3').val(<?php if (isset($item->listening3)) {echo $item->listening3; } else { echo '0';} ?>);
        $('#frm_source_test #sel_listening4').val(<?php if (isset($item->listening4)) {echo $item->listening4; } else { echo '0';} ?>);
        $('#frm_source_test #sel_listening5').val(<?php if (isset($item->listening5)) {echo $item->listening5; } else { echo '0';} ?>);
        $('#frm_source_test #sel_listening6').val(<?php if (isset($item->listening6)) {echo $item->listening6; } else { echo '0';} ?>);
                
        $('#frm_source_test #sel_speaking1').val(<?php if (isset($item->speaking1)) {echo $item->speaking1; } else { echo '0';} ?>);
        $('#frm_source_test #sel_speaking2').val(<?php if (isset($item->speaking2)) {echo $item->speaking2; } else { echo '0';} ?>);
        $('#frm_source_test #sel_speaking3').val(<?php if (isset($item->speaking3)) {echo $item->speaking3; } else { echo '0';} ?>);
        $('#frm_source_test #sel_speaking4').val(<?php if (isset($item->speaking4)) {echo $item->speaking4; } else { echo '0';} ?>);
        $('#frm_source_test #sel_speaking5').val(<?php if (isset($item->speaking5)) {echo $item->speaking5; } else { echo '0';} ?>);
        $('#frm_source_test #sel_speaking6').val(<?php if (isset($item->speaking6)) {echo $item->speaking6; } else { echo '0';} ?>);
                
        $('#frm_source_test #sel_writing1').val(<?php if (isset($item->writing1)) {echo $item->writing1; } else { echo '0';} ?>);
        $('#frm_source_test #sel_writing2').val(<?php if (isset($item->writing2)) {echo $item->writing2; } else { echo '0';} ?>);
    });
</script>