<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/index/?part=<?php echo $part ?>">Reading 0<?php echo $part ?></a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/readingDDQ/index/?rid=<?php echo $rid ?>&part=<?php echo $part ?>">DDQ</a> <span class="divider">/</span> </li>
    <li class="active">Add Reading</li>
</ul>
<hr/>
<legend>Add Reading DDQ</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" name="title" class="input-xxlarge" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <input type="hidden" value ="<?php echo $part ?>" name="part"/>



    <div class="control-group">
        <label class="control-label">Direction</label>
        <div class="controls">
            <textarea name="content" rows="5" class="input-xxlarge" class="tinymce"><?php if (isset($_POST['content'])) echo $_POST['content']; ?></textarea>
        </div>
    </div>


    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

