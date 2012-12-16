<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/keyword_searching_test/">Keyword List</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
</ul>
<hr/>
<legend>Edit Keyword: <?php
echo ($keyword['keyword_owner'] != '') ?
        $keyword['keyword_subject'] . ' --- ' . $keyword['keyword_owner'] : $keyword['keyword_subject'];
?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Keyword Category</label>
        <div class="controls">
            <input type="text" name="category" class="input-xxlarge" value="<?php echo $keyword['keyword_subject'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Keyword Owner</label>
        <div class="controls">
            <input type="text" name="owner" class="input-xxlarge" value="<?php echo $keyword['keyword_owner'] ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Featured</label>
        <div class="controls">
            <input type="checkbox" class="input-xxlarge" name="featured" value="1" <?php if ($keyword['featured'] != 0) echo "checked" ?>>
        </div>
    </div>

    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$keyword['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($keyword['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($keyword['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$keyword['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

