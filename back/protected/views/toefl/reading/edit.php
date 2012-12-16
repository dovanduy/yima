<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/index/?part=<?php echo $reading['reading_part']?>">Reading 0<?php echo $reading['reading_part']?></a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $reading['title'] ?></li>
</ul>
<hr/>
<legend>Edit reading: <?php echo $reading['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php echo $reading['title'] ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Level</label>
        <div class="controls">
            <select id="level" class="input-xxlarge" name="level">
                <option value="0">--- Select Level ---</option>
                <option value="1" <?php if ($reading['level']==1) echo 'selected' ?>>Elementary</option>
                <option value="2" <?php if ($reading['level']==2) echo 'selected' ?>>Intermediate</option>
                <option value="3" <?php if ($reading['level']==3) echo 'selected' ?>>Upper-Intermediate</option>
                <option value="4" <?php if ($reading['level']==4) echo 'selected' ?>>Advance</option>
            </select>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Test Time</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="time" value="<?php echo $reading['test_time'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Source</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="source" value="<?php echo $reading['source'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Keyword</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="keyword" value="<?php echo $reading['keyword'] ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Reading Text</label>
        <div class="controls">
            <textarea name="content" rows="30" class="tinymce input-xxlarge"><?php echo $reading['content'] ?></textarea>
        </div>
    </div>
    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$reading['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($reading['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($reading['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$reading['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

