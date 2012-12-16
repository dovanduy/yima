<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/">Organization</a> <span class="divider">/</span> </li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Organization</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Grade</label>
        <div class="controls">
            <select id="grade_id" class="input-xxlarge" name="grade_id">
                <option value="0">-- Select Grade ---</option>
                <?php foreach ($grades as $g): ?>
                    <option value="<?php echo $g['id']; ?>" <?php if (isset($_POST['grade_id']) && $_POST['grade_id'] == $g['id']) echo 'selected'; ?>><?php echo $g['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Priority</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="priority" value="<?php if (isset($_POST['priority'])) echo $_POST['priority']; ?>">
        </div>
    </div>
    
     <div class="control-group">
        <label class="control-label">Search</label>
        <div class="controls">
            <input type="checkbox" class="input-xxlarge" name="search" value="1">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Featured</label>
        <div class="controls">
            <input type="checkbox" class="input-xxlarge" name="featured" value="1">
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

