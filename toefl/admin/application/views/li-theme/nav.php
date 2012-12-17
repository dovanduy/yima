<!-- Aside Block -->
<section role="navigation">
    <!-- Header with logo and headline -->
    <header>
        <a href="<?php echo base_url(); ?>" title="Back to Homepage"></a>
    </header>

    <!-- User Info -->
    <section id="user-info">
        <img src="<?php echo theme_url(); ?>img/admin/admin.png" alt="" width="45">
        <div>
            <a href=""><?php echo $user_info['firstname'] . ' ' . $user_info['lastname']; ?></a>
            <?php /* <em><?php echo $user_info['group_id']; ?></em> */ ?>
            <ul>
                <li><a class="button-link" href="<?php echo base_url(); ?>login/logout">logout</a></li>
                <li><a class="button-link" href="<?php echo base_url(); ?>change_password">change pwd</a></li>
            </ul>
        </div>
    </section>
    <!-- /User Info -->

    <!-- Main Navigation -->
    <nav id="main-nav">
        <ul>
            <?php
            if ($user_info['qb_view'] == 1) {
                ?>
                <li <?php if (in_array($object, array("reading", "listening", "speaking", "writing"))) echo 'class="current"'; ?>>
                    <a href="" class="products">Question Bank</a>
                    <ul style="display: block;">
                        <li <?php if ($object == 'reading' && $part == 1) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>reading/part/1">Reading 1</a></li>
                        <li <?php if ($object == 'reading' && $part == 2) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>reading/part/2">Reading 2</a></li>
                        <li <?php if ($object == 'reading' && $part == 3) echo 'class="current"'; ?> style="border-bottom: 1px dotted #bbb; padding-bottom: 5px; margin-right: 1px; margin-bottom: 5px;"><a href="<?php echo base_url(); ?>reading/part/3">Reading 3</a></li>
                        <li <?php if ($object == 'listening' && $part == 1) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>listening/part/1">Listening 1</a></li>
                        <li <?php if ($object == 'listening' && $part == 2) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>listening/part/2">Listening 2</a></li>
                        <li <?php if ($object == 'listening' && $part == 3) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>listening/part/3">Listening 3</a></li>
                        <li <?php if ($object == 'listening' && $part == 4) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>listening/part/4">Listening 4</a></li>
                        <li <?php if ($object == 'listening' && $part == 5) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>listening/part/5">Listening 5</a></li>
                        <li <?php if ($object == 'listening' && $part == 6) echo 'class="current"'; ?> style="border-bottom: 1px dotted #bbb; padding-bottom: 5px; margin-right: 1px; margin-bottom: 5px;"><a href="<?php echo base_url(); ?>listening/part/6">Listening 6</a></li>
                        <li <?php if ($object == 'speaking' && $part == 1) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>speaking/part/1">Independent Speaking 01</a></li>
                        <li <?php if ($object == 'speaking' && $part == 2) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>speaking/part/2">Independent Speaking 02</a></li>
                        <li <?php if ($object == 'speaking' && $part == 3) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>speaking/part/3">Integrated Spk. (L + R) 03</a></li>
                        <li <?php if ($object == 'speaking' && $part == 4) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>speaking/part/4">Integrated Spk. (L + R) 04</a></li>
                        <li <?php if ($object == 'speaking' && $part == 5) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>speaking/part/5">Integrated Spk. (L) 05</a></li>
                        <li <?php if ($object == 'speaking' && $part == 6) echo 'class="current"'; ?> style="border-bottom: 1px dotted #bbb; padding-bottom: 5px; margin-right: 1px; margin-bottom: 5px;"><a href="<?php echo base_url(); ?>speaking/part/6">Integrated Spk. (L) 06</a></li>
                        <li <?php if ($object == 'writing' && $part == 1) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>writing/part/1">Integrated Writing</a></li>
                        <li <?php if ($object == 'writing' && $part == 2) echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>writing/part/2">Independent Writing</a></li>
                    </ul>
                </li> 
                <?php
            }
            ?>

            <?php
            if ($user_info['source_view'] == 1) {
                ?>
                <li <?php if ($object == 'source_test') echo 'class="current"'; ?>><a class="articles no-submenu" title="" href="<?php echo base_url(); ?>source_test">Source Test</a></li>
                <?php
            }
            ?>

            <?php
            if ($user_info['ss_view'] == 1) {
                ?>
                <li <?php if ($object == 'session') echo 'class="current"'; ?>><a class="projects no-submenu" title="" href="<?php echo base_url(); ?>session">Session</a></li>
                <?php
            }
            ?>

            <?php
            if ($user_info['e_view'] == 1) {
                ?>
                <li <?php if ($object == 'result') echo 'class="current"'; ?>><a class="events no-submenu" title="" href="<?php echo base_url(); ?>result">Result</a></li>
                <li <?php if ($object == 'evaluation') echo 'class="current"'; ?>><a class="events no-submenu" title="" href="<?php echo base_url(); ?>evaluation">Evaluation</a></li>
                <?php
            }
            ?>

            <?php
            if ($user_info['system'] == 1) {
                ?>
                <li <?php if (in_array($object, array("user", "campus", "class", "teacher", "student"))) echo 'class="current"'; ?>>
                    <a href="" class="settings">AMA Campuses</a>
                    <ul style="display: block;">
                        <li <?php if ($object == 'user') echo 'class="current"'; ?> style="border-bottom: 1px dotted #bbb; padding-bottom: 5px; margin-right: 1px; margin-bottom: 5px;"><a href="<?php echo base_url(); ?>user">User</a></li>
                        <li <?php if ($object == 'campus') echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>campus">Campus</a></li>

                        <li <?php if ($object == 'class') echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>classes">Class</a></li>


                        <li <?php if ($object == 'teacher') echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>teacher">Teacher</a></li>

                        <li <?php if ($object == 'student') echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>student">Student</a></li>
                    </ul>
                </li> 
                <?php
            }else if ($user_info['group_id'] == 2) {
                ?>
                <li <?php if ($object == 'result') echo 'class="current"'; ?>><a class="events no-submenu" title="" href="<?php echo base_url(); ?>result">Result</a></li>
                <li <?php if ($object == 'evaluation') echo 'class="current"'; ?>><a class="events no-submenu" title="" href="<?php echo base_url(); ?>evaluation">Evaluation</a></li>
                <li <?php if (in_array($object, array("user", "campus", "class", "teacher", "student"))) echo 'class="current"'; ?>>
                    <a href="" class="settings">AMA Campuses</a>
                    <ul style="display: block;">
                        <?php
                        if ($user_info['class_view'] == 1) {
                            ?>
                            <li <?php if ($object == 'class') echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>classes">Class</a></li>
                            <?php
                        }
                        ?>

                        <?php
                        if ($user_info['teacher_view'] == 1) {
                            ?>
                            <li <?php if ($object == 'teacher') echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>teacher">Teacher</a></li>
                            <?php
                        }
                        ?>

                        <?php
                        if ($user_info['student_view'] == 1) {
                            ?>
                            <li <?php if ($object == 'student') echo 'class="current"'; ?>><a href="<?php echo base_url(); ?>student">Student</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </li> 
                <?php
            }
            ?>
        </ul>
    </nav>
    <!-- /Main Navigation -->
</section>
<!-- /Aside Block -->