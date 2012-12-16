<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/Question/">Question</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $question['question'] ?></li>
</ul>
<hr/>
<legend>Edit Question</legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">

    <div class="control-group">
        <label class="control-label">Test title</label>
        <div class="controls">
            <p style="margin-top: 5px" class="help-block"><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/edit/id/<?php echo $question['test_id']; ?>"><?php echo $question['test_title']; ?></a></p>
        </div>
    </div>

    <?php /*
      <div class="control-group">
      <label class="control-label">Title</label>
      <div class="controls">
      <input type="text" class="span11" name="title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']): htmlspecialchars($question['title']); ?>">
      </div>
      </div> */ ?>

    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" class="span11" name="question" value="<?php echo isset($_POST['question']) ? htmlspecialchars($_POST['question']) : htmlspecialchars($question['question']); ?>">
        </div>
    </div>

    <div class="control-group">                                
        <label class="control-label">Choice 1</label>
        <div class="controls">
            <input type="text" class="span11" name="choice1" value="<?php if (isset($_POST['choice1'])) echo htmlspecialchars($_POST['choice1']);else echo htmlspecialchars($answer['choice_1']); ?>" >
        </div>
    </div>

    <div class="control-group">

        <label class="control-label">Choice 2</label>
        <div class="controls">
            <input type="text" class="span11" name="choice2" value="<?php if (isset($_POST['choice2'])) echo htmlspecialchars($_POST['choice2']);else echo htmlspecialchars($answer['choice_2']); ?>">
        </div>
    </div>

    <div class="control-group">

        <label class="control-label">Choice 3</label>
        <div class="controls">
            <input type="text" class="span11" name="choice3" value="<?php if (isset($_POST['choice3'])) echo htmlspecialchars($_POST['choice3']);else echo htmlspecialchars($answer['choice_3']) ?>">
        </div>
    </div>

    <div class="control-group">

        <label class="control-label">Choice 4</label>
        <div class="controls">
            <input type="text" class="span11" name="choice4" value="<?php if (isset($_POST['choice4'])) echo htmlspecialchars($_POST['choice4']);else echo htmlspecialchars($answer['choice_4']); ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Right choice</label>
        <div class="controls">
            <select class="span11" name="right">
                <option value="0">--- Chọn trả lời đúng ---</option>
                <?php for ($i = 1; $i < 5; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php if(isset($_POST['right']) && $_POST['right'] == $i) echo 'selected';else if($answer['right_choice'] == $i) echo 'selected'; ?>>Choice <?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>

    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if(isset($_POST['disabled']) && !$_POST['disabled']) echo 'checked';else if (!$question['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if(isset($_POST['disabled']) && $_POST['disabled']) echo 'checked';else if ($question['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if(isset($_POST['deleted']) && $_POST['deleted']) echo 'checked';else if ($question['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if(isset($_POST['deleted']) && !$_POST['deleted']) echo 'checked';else if (!$question['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

