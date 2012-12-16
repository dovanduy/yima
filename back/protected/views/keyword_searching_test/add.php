<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/keyword_searching_test/">Keyword List</a> <span class="divider">/</span> </li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Organization</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Keyword Category</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="category" value="<?php if (isset($_POST['category'])) echo $_POST['category']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Keyword Owner</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="owner" value="<?php if (isset($_POST['owner'])) echo $_POST['owner']; ?>">
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

