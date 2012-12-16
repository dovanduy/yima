<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/">Admin</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
</ul>
<hr/>
<legend>Edit Admin: <?php echo $admin['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <?php if (UserControl::getId() == $admin['id']): ?>
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
    <?php endif; ?>
    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$admin['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($admin['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($admin['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$admin['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

