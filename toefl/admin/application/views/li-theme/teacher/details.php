<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_object; ?>">Teacher</a></li>
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

                <form action="<?php echo $link_current; ?>" method="post">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                    <input type="hidden" name="group_id" value="3">
                    <input name="id" type="hidden" value="<?php if (isset($id)) echo $id; ?>"/>
                    <fieldset>
                        <dl>
                            <dt><label>Username</label></dt><dd><input class="medium" type="text" name="title" value="<?php if (isset($item->title)) echo $item->title; ?>"/></dd>
                            <dt><label>First Name</label></dt><dd><input class="medium" type="text" name="firstname" value="<?php if (isset($item->firstname)) echo $item->firstname; ?>"/></dd>
                            <dt><label>Last Name</label></dt><dd><input class="medium" type="text" name="lastname" value="<?php if (isset($item->lastname)) echo $item->lastname; ?>"/></dd>
                            <dt><label>Password</label></dt><dd><input class="medium" type="password" name="password" value="<?php if (isset($item->password_post)) echo $item->password_post; ?>"/></dd>
                            <dt><label>Confirm Password</label></dt><dd><input class="medium" type="password" name="confirm_password" value="<?php if (isset($item->confirm_password)) echo $item->confirm_password; ?>"/></dd>
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