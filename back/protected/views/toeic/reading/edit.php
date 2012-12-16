<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/reading/">TOEIC Reading</a> <span class="divider">/</span> </li>
    <li class="active">Edit </li>
</ul>
<hr/>
<legend>Edit Reading Test: <?php echo $reading['title'] ?></legend>

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
        <label class="control-label">Keyword</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="keyword" value="<?php echo $reading['keyword'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Source</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="source" value="<?php echo $reading['source'] ?>">
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

