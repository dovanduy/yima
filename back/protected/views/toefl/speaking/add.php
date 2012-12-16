<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/speaking/">Add</a> <span class="divider">/</span> </li>
    <li class="active">Add Speaking</li>
</ul>
<hr/>
<legend>Add Speaking</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>

