<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/faculty/">Faculty List</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
</ul>
<hr/>
<legend>Edit Faculty: 
    <?php echo ($faculty['title'] != ''); ?>
</legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" name="title" class="input-xxlarge" value="<?php echo $faculty['title'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Organization</label>
        <div class="controls">
            <select id="organization_id" class="input-xxlarge" name="organization_id">
                <option value="0">-- Select Organization ---</option>
                <?php foreach ($organizations as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if (isset($_POST['organization_id']) && $_POST['organization_id'] == $o['id']) echo 'selected';else if ($faculty['organization_id'] == $o['id']) echo 'selected'; ?>><?php echo $o['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$faculty['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($faculty['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($faculty['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$faculty['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

