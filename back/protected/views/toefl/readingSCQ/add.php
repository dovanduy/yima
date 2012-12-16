<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/index/?part=<?php echo $part ?>">Reading 0<?php echo $part ?></a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/readingSCQ/index/?rid=<?php echo $rid ?>&part=<?php echo $part ?>">SCQ</a> <span class="divider">/</span> </li>
    <li class="active">Add Reading</li>
</ul>
<hr/>
<legend>Add Reading SCQ</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" name="title" class="input-xxlarge" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <input type="hidden" value ="<?php echo $part ?>" name="part"/>


    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <input type="radio" name="choice" value="1"/>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice1" >
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <input type="radio" name="choice" value="2"/>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice2" >
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <input type="radio" name="choice" value="3"/>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice3" >
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <input type="radio" name="choice" value="4"/>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice4" >
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Reading Text</label>
        <div class="controls">
            <textarea name="content" rows="5" class="input-xxlarge tinymce"><?php if (isset($_POST['content'])) echo $_POST['content']; ?></textarea>
        </div>
    </div>


    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

