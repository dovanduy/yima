<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/">Admin</a> <span class="divider">/</span> </li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Admin</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Username</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
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
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
            </select>
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

