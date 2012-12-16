<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/reading/">TOEIC Reading</a><span class="divider">/</span></li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/reading_part5/index/rid/<?php echo $reading['id']; ?>"><?php echo $reading['title']; ?></a><span class="divider">/</span></li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/reading_part5/index/rid/<?php echo $reading['id']; ?>">Part 5</a><span class="divider">/</span></li>
    <li class="active">Edit</li>
</ul>
<hr/>
<legend>Edit Reading Question:</legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="question" value="<?php echo $reading_part5['question'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice1" value="<?php echo $reading_part5['choice1'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice2" value="<?php echo $reading_part5['choice2'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice3" value="<?php echo $reading_part5['choice3'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice4" value="<?php echo $reading_part5['choice4'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Answer</label>
        <div class="controls">
            <select  class="input-xxlarge" name="answer">
                <option value="1" <?php if ($reading_part5['answer'] == 1) echo 'selected'; ?>>Choice 1</option>
                <option value="2" <?php if ($reading_part5['answer'] == 2) echo 'selected'; ?>>Choice 2</option>
                <option value="3" <?php if ($reading_part5['answer'] == 3) echo 'selected'; ?>>Choice 3</option>
                <option value="4" <?php if ($reading_part5['answer'] == 4) echo 'selected'; ?>>Choice 4</option>
            </select>
        </div>
    </div>


    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$reading_part5['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($reading_part5['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($reading_part5['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$reading_part5['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

