<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/class/">Class</a> <span class="divider">/</span> </li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Class</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Organization</label>
        <div class="controls">
            <select id="organization_id" class="input-xxlarge" name="organization_id">
                <option value="0">-- Select Grade ---</option>
                <?php foreach ($organizations as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if (isset($_POST['organization_id']) && $_POST['organization_id'] == $o['id']) echo 'selected'; ?>><?php echo $o['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

