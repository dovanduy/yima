<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/subject/">Subject</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $subject['title'] ?></li>
</ul>
<hr/>
<legend>Edit Class: <?php echo $subject['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php echo $subject['title'] ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Subject Image</label>
        <div class="controls">
            <img src="<?php echo HelperApp::get_thumbnail($subject['thumbnail']) ?>" alt=""/>
        </div>
    </div>
    
        <div class="control-group">
        <label class="control-label">Image</label>
        <div class="controls">
            <input type="file" name="image" >
        </div>
    </div>



    <div class="control-group">
        <label class="control-label">Priority</label>
        <div class="controls">
            <input type="text" name="priority" class="input-xxlarge" value="<?php echo $subject['priority'] ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Search</label>
        <div class="controls">
            <input type="checkbox" class="input-xxlarge" name="search" value="1" <?php if ($subject['search'] != 0) echo "checked" ?>>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Featured</label>
        <div class="controls">
            <input type="checkbox" class="input-xxlarge" name="featured" value="1" <?php if ($subject['featured'] != 0) echo "checked" ?>>
        </div>
    </div>

    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$subject['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($subject['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($subject['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$subject['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

