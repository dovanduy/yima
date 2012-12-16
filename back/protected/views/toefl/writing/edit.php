<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/writing/">Writing</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $writing['title'] ?></li>
</ul>
<hr/>
<legend>Edit writing: <?php echo $writing['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" name="title" value="<?php echo $writing['title'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Status</label>
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($writing['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$writing['disabled']) echo 'checked' ?>>
                Active
            </label>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Delete</label>
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$writing['deleted']) echo 'checked'; ?>>
                No
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($writing['deleted']) echo 'checked'; ?>>
                Yes
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>

