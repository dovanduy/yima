<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_object; ?>">User</a></li>
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
                    <input name="id" type="hidden" value="<?php if (isset($id)) echo $id; ?>"/>
                    <fieldset>
                        <dl>
                            <dt><label>Campus</label></dt><dd>
                                <select name="campus_id">
                                    <option value="0" <?php if (isset($item->campus_id) && $item->campus_id == 0) echo 'selected'; ?>>--- Select Campus ---</option>
                                    <?php
                                    foreach ($campus as $key => $val) {
                                        ?>
                                        <option value="<?php echo $key; ?>" <?php if (isset($item->campus_id) && $item->campus_id == $key) echo 'selected'; ?>><?php echo $val; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </dd>
                            <dt><label>Group</label></dt><dd>
                                <select name="group_id" id="group_id">
                                    <option value="0" <?php if (isset($item->group_id) && $item->group_id == 0) echo 'selected'; ?>>--- Select Group ---</option>
                                    <option value="1" <?php if (isset($item->group_id) && $item->group_id == 1) echo 'selected'; ?>><?php echo $user_group[1]; ?></option>
                                    <option value="2" <?php if (isset($item->group_id) && $item->group_id == 2) echo 'selected'; ?>><?php echo $user_group[2]; ?></option>
                                </select>
                            </dd>
                            <dt><label>Username</label></dt><dd><input class="medium" type="text" name="title" value="<?php if (isset($item->title)) echo $item->title; ?>"/></dd>
                            <dt><label>First Name</label></dt><dd><input class="medium" type="text" name="firstname" value="<?php if (isset($item->firstname)) echo $item->firstname; ?>"/></dd>
                            <dt><label>Last Name</label></dt><dd><input class="medium" type="text" name="lastname" value="<?php if (isset($item->lastname)) echo $item->lastname; ?>"/></dd>
                            <dt><label>Password</label></dt><dd><input class="medium" type="password" name="password" value="<?php if (isset($item->password_post)) echo $item->password_post; ?>"/></dd>
                            <dt><label>Confirm Password</label></dt><dd><input class="medium" type="password" name="confirm_password" value="<?php if (isset($item->confirm_password)) echo $item->confirm_password; ?>"/></dd>
                        </dl>
                    </fieldset>
                    <fieldset class="permissions">
                        <legend>Permissions</legend>
                        <div class="left" style="width: 180px; margin-right: 20px;" >
                            <dl>
                                <dt><label>Session - View</label></dt><dd><input type="checkbox" name="ss_view" value="1" <?php if (isset($item->ss_view) && $item->ss_view == 1) echo 'checked'; ?>></dd>
                                <dt><label>Session - Edit</label></dt><dd><input type="checkbox" name="ss_edit" value="1" <?php if (isset($item->ss_edit) && $item->ss_edit == 1) echo 'checked'; ?>></dd>
                                <dt><label>Session - Delete</label></dt><dd><input type="checkbox" name="ss_delete" value="1" <?php if (isset($item->ss_delete) && $item->ss_delete == 1) echo 'checked'; ?>></dd>
                                <br/>
                                <dt><label>Session - Manage Source</label></dt><dd><input type="checkbox" name="ss_source" value="1" <?php if (isset($item->ss_source) && $item->ss_source == 1) echo 'checked'; ?>></dd>
                                <dt><label>Session - Manage Class</label></dt><dd><input type="checkbox" name="ss_class" value="1" <?php if (isset($item->ss_class) && $item->ss_class == 1) echo 'checked'; ?>></dd>
                                <dt><label>Session - Assign Student</label></dt><dd><input type="checkbox" name="ss_assign" value="1" <?php if (isset($item->ss_assign) && $item->ss_assign == 1) echo 'checked'; ?>></dd>                                
                                <br/>
                                <dt><label>Assign - Status</label></dt><dd><input type="checkbox" name="ss_assign_status" value="1" <?php if (isset($item->ss_assign_status) && $item->ss_assign_status == 1) echo 'checked'; ?>></dd>                                
                                <dt><label>Assign - Mixed Test</label></dt><dd><input type="checkbox" name="ss_assign_mixed" value="1" <?php if (isset($item->ss_assign_mixed) && $item->ss_assign_mixed == 1) echo 'checked'; ?>></dd>                                
                                <dt><label>Assign - Test Order</label></dt><dd><input type="checkbox" name="ss_assign_order" value="1" <?php if (isset($item->ss_assign_order) && $item->ss_assign_order == 1) echo 'checked'; ?>></dd>                                
                            </dl>
                        </div>
                        <div class="left" style="width: 180px; margin-right: 20px;">
                            <dl>
                                <dt><label>Student - View</label></dt><dd><input type="checkbox" name="student_view" value="1" <?php if (isset($item->student_view) && $item->student_view == 1) echo 'checked'; ?>></dd>
                                <dt><label>Student - Edit</label></dt><dd><input type="checkbox" name="student_edit" value="1" <?php if (isset($item->student_edit) && $item->student_edit == 1) echo 'checked'; ?>></dd>
                                <dt><label>Student - Delete</label></dt><dd><input type="checkbox" name="student_delete" value="1" <?php if (isset($item->student_delete) && $item->student_delete == 1) echo 'checked'; ?>></dd>
                                <br/>
                                <dt><label>Teacher - View</label></dt><dd><input type="checkbox" name="teacher_view" value="1" <?php if (isset($item->teacher_view) && $item->teacher_view == 1) echo 'checked'; ?>></dd>
                                <dt><label>Teacher - Edit</label></dt><dd><input type="checkbox" name="teacher_edit" value="1" <?php if (isset($item->teacher_edit) && $item->teacher_edit == 1) echo 'checked'; ?>></dd>
                                <dt><label>Teacher - Delete</label></dt><dd><input type="checkbox" name="teacher_delete" value="1" <?php if (isset($item->teacher_delete) && $item->teacher_delete == 1) echo 'checked'; ?>></dd>                            
                                <br/>
                                <dt><label>Class - View</label></dt><dd><input type="checkbox" name="class_view" value="1" <?php if (isset($item->class_view) && $item->class_view == 1) echo 'checked'; ?>></dd>
                                <dt><label>Class - Edit</label></dt><dd><input type="checkbox" name="class_edit" value="1" <?php if (isset($item->class_edit) && $item->class_edit == 1) echo 'checked'; ?>></dd>
                                <dt><label>Class - Delete</label></dt><dd><input type="checkbox" name="class_delete" value="1" <?php if (isset($item->class_delete) && $item->class_delete == 1) echo 'checked'; ?>></dd>
                            </dl>
                        </div>
                        <div class="left" style="width: 180px;" >
                            <dl>
                                <dt><label>Question Bank - View</label></dt><dd><input type="checkbox" name="qb_view" value="1" <?php if (isset($item->qb_view) && $item->qb_view == 1) echo 'checked'; ?>></dd>
                                <dt><label>Question Bank - Edit</label></dt><dd><input type="checkbox" name="qb_edit" value="1" <?php if (isset($item->qb_edit) && $item->qb_edit == 1) echo 'checked'; ?>></dd>
                                <dt><label>Question Bank - Delete</label></dt><dd><input type="checkbox" name="qb_delete" value="1" <?php if (isset($item->qb_delete) && $item->qb_delete == 1) echo 'checked'; ?>></dd>
                                <br/>
                                <dt><label>Source Test - View</label></dt><dd><input type="checkbox" name="source_view" value="1" <?php if (isset($item->source_view) && $item->source_view == 1) echo 'checked'; ?>></dd>
                                <dt><label>Source Test - Edit</label></dt><dd><input type="checkbox" name="source_edit" value="1" <?php if (isset($item->source_edit) && $item->source_edit == 1) echo 'checked'; ?>></dd>
                                <dt><label>Source Test - Delete</label></dt><dd><input type="checkbox" name="source_delete" value="1" <?php if (isset($item->source_delete) && $item->source_delete == 1) echo 'checked'; ?>></dd>
                            </dl>
                        </div>
                        <div class="clearfix"></div>
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
        change_group_id();
        
        $('#group_id').live('change',function(){
            change_group_id();
        });
        
        function change_group_id(){
            group_id = $('#group_id').val();
            if (group_id==2){
                $('.permissions').show();
            }else{
                $('.permissions').hide();
            }
        }
    })
</script>