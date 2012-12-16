<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/">Add user</a> <span class="divider">/</span> </li>
    <li class="active">Add User</li>
</ul>
<hr/>
<legend>Add User</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Username</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">First Name</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="firstname" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Last Name</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="lastname" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Email</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Password</label>
        <div class="controls">
            <input type="password" class="input-xxlarge" name="password" value="">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Confirm Password</label>
        <div class="controls">
            <input type="password" class="input-xxlarge" name="confirm_password" value="">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Role</label>
        <div class="controls">
            <select id="role" class="input-xxlarge" name="role">
                <option value="none">--- Select Role ---</option>
                <option value="normal" <?php if (isset($_POST['role'])) echo 'selected'; ?>>Normal User</option>
                <option value="power" <?php if (isset($_POST['role'])) echo 'selected'; ?>>Power User</option>
                <option value="teacher" <?php if (isset($_POST['role'])) echo 'selected'; ?>>Teacher</option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Profile's Picture</label>
        <div class="controls">
            <input type="file" name="file"/>
            <p class="help-block">Hình ảnh phải lơn hơn kích thước 300x300px và dung lượng nhỏ hơn 3MB</p>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

