<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/reading/">TOEIC Reading</a><span class="divider">/</span></li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/reading_part6/index/rid/<?php echo $reading['id']; ?>"><?php echo $reading['title']; ?></a><span class="divider">/</span></li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/reading_part6/index/rid/<?php echo $reading['id']; ?>">Part 6</a><span class="divider">/</span></li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Reading Question</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <textarea name="question" rows="7" class="input-xxlarge tinymce"><?php if (isset($_POST['question'])) echo $_POST['question']; ?></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice1" value="<?php if (isset($_POST['choice1'])) echo $_POST['choice1']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice2" value="<?php if (isset($_POST['choice2'])) echo $_POST['choice2']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice3" value="<?php if (isset($_POST['choice3'])) echo $_POST['choice3']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice4" value="<?php if (isset($_POST['choice4'])) echo $_POST['choice4']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Answer</label>
        <div class="controls">
            <select name="answer">
                <option value="1">Choice 1</option>
                <option value="2">Choice 2</option>
                <option value="3">Choice 3</option>
                <option value="4">Choice 4</option>
            </select>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

