<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/">Organization</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/add_subject/id/<?php echo $organization['id'] ?>"><?php echo $organization['title'] ?></a><span class="divider">/</span></li>
    <li class="active">Edit</li>
</ul>
<hr/>
<legend>Edit Organization Subject</legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">

    <div class="control-group">
        <label class="control-label">Subject</label>
        <div class="controls">
            <select id="grade_id" class="input-xxlarge" name="subject_id">
                <option value="0">-- Select Subject ---</option>
                <?php foreach ($subject as $g): ?>
                    <option value="<?php echo $g['id']; ?>" <?php if ($organization_subject['subject_id'] == $g['id']) echo 'selected'; ?>><?php echo $g['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Subject Number</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="sub_num" value="<?php echo $organization_subject['sub_number']  ?>">
        </div>
    </div>
    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$organization_subject['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($organization_subject['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($organization_subject['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$organization_subject['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Edit</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

