<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/">User</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider"></span> </li>
</ul>
<hr/>
<legend>Edit User: <?php echo $user['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
   
    <div class="control-group">
        <label class="control-label">Username</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php echo $user['title'] ?>">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">First Name</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="firstname" value="<?php echo $user['firstname'] ?>">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Last Name</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="lastname" value="<?php echo $user['lastname'] ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Email</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="email" value="<?php echo $user['email'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Role</label>
        <div class="controls">
            <select id="role" class="input-xxlarge" name="role">
                <option value="none">--- Select Role ---</option>
                <option value="normal" <?php if ($user['role'] == 'normal') echo 'selected'; ?>>Normal User</option>
                <option value="power" <?php if ($user['role'] == 'power') echo 'selected'; ?>>Power User</option>
                <option value="teacher" <?php if ($user['role'] == 'teacher') echo 'selected'; ?>>Teacher</option>
            </select>
        </div>
    </div>
    <?php /* <div class="control-group">
      <label class="control-label">Current Password</label>
      <div class="controls">
      <input type="password" name="cur_password" value="">
      </div>
      </div>
      <div class="control-group">
      <label class="control-label">Password</label>
      <div class="controls">
      <input type="password" name="password" value="">
      </div>
      </div>
      <div class="control-group">
      <label class="control-label">Confirm Password</label>
      <div class="controls">
      <input type="password" name="confirm_password" value="">
      </div>
      </div> */ ?>
    <div class="control-group">
        <label class="control-label">Thumbnail</label>
        <div class="controls">
            <input type="file" name="file"/>
            <p class="help-block">Hình ảnh phải lơn hơn kích thước 300x300px và dung lượng nhỏ hơn 3MB</p><br/>
            <img class="img-polaroid" src="<?php echo HelperApp::get_thumbnail($user['thumbnail']); ?>" />
        </div>
    </div>

    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$user['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($user['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($user['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$user['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
       <button type="submit" class="btn btn-primary">Update</button>
       <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

