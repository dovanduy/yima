<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/question">Question:</a> <span class="divider">/</span> </li>
    <li><?php echo $question['title']; ?></li><span class="divider">/</span> </li>
<li class="active">Edit Answer SCQ</li>
</ul>
<hr/>
<legend>Edit Answer SCQ: <?php echo $question['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input disabled="disabled" type="text" name="title" class="input-xxlarge" value="<?php echo $question['question']; ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <input type="radio" name="choice" value="1" <?php if ($answer_nt['right_choice'] == 1) echo "checked" ?>/>
        <div class="controls">
            <input type="text" name="choice1" class="input-xxlarge" value="<?php echo $answer_nt['choice_1']; ?>" >
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <input type="radio" name="choice" value="2" <?php if ($answer_nt['right_choice'] == 2) echo "checked" ?>/>
        <div class="controls">
            <input type="text" name="choice2" class="input-xxlarge" value="<?php echo $answer_nt['choice_2']; ?>" >
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <input type="radio" name="choice" value="3" <?php if ($answer_nt['right_choice'] == 3) echo "checked" ?>/>
        <div class="controls">
            <input type="text" name="choice3" class="input-xxlarge" value="<?php echo $answer_nt['choice_3']; ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <input type="radio" name="choice" value="4" <?php if ($answer_nt['right_choice'] == 4) echo "checked" ?>/>
        <div class="controls">
            <input type="text" name="choice4" class="input-xxlarge" value="<?php echo $answer_nt['choice_4']; ?>">
        </div>
    </div>


    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

