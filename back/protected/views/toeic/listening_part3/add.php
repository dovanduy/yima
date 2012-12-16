<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening/">TOEIC Listening</a><span class="divider">/</span></li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening_part3/index/lid/<?php echo $listening['id']; ?>"><?php echo $listening['title']; ?></a><span class="divider">/</span></li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening_part3/index/lid/<?php echo $listening['id']; ?>">Part 3</a><span class="divider">/</span></li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Listening Questions</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <legend>Sound File</legend>
    <div class="control-group">
        <label class="control-label">Sound's Title</label>
        <div class="controls">
             <input type="text" class="input-xxlarge" name="sound_title" value="<?php if (isset($_POST['sound_title'])) echo $_POST['sound_title']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Question's Sound</label>
        <div class="controls">
            <input type="file" class="input-xlarge" name="question_sound">
        </div>
    </div>
    <legend>Question 1</legend>
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="question_q1" value="<?php if (isset($_POST['question_q1'])) echo $_POST['question_q1']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice1_q1" value="<?php if (isset($_POST['choice1_q1'])) echo $_POST['choice1_q1']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice2_q1" value="<?php if (isset($_POST['choice2_q1'])) echo $_POST['choice2_q1']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice3_q1" value="<?php if (isset($_POST['choice3_q1'])) echo $_POST['choice3_q1']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice4_q1" value="<?php if (isset($_POST['choice4_q1'])) echo $_POST['choice4_q1']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Answer</label>
        <div class="controls">
            <select name="answer_q1">
                <option value="1">Choice 1</option>
                <option value="2">Choice 2</option>
                <option value="3">Choice 3</option>
                <option value="4">Choice 4</option>
            </select>
        </div>
    </div>
    <legend>Question 2</legend>
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="question_q2" value="<?php if (isset($_POST['question_q2'])) echo $_POST['question_q2']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice1_q2" value="<?php if (isset($_POST['choice1_q2'])) echo $_POST['choice1_q2']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice2_q2" value="<?php if (isset($_POST['choice2_q2'])) echo $_POST['choice2_q2']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice3_q2" value="<?php if (isset($_POST['choice3_q2'])) echo $_POST['choice3_q2']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice4_q2" value="<?php if (isset($_POST['choice4_q2'])) echo $_POST['choice4_q2']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Answer</label>
        <div class="controls">
            <select name="answer_q2">
                <option value="1">Choice 1</option>
                <option value="2">Choice 2</option>
                <option value="3">Choice 3</option>
                <option value="4">Choice 4</option>
            </select>
        </div>
    </div>
    <legend>Question 3</legend>
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="question_q3" value="<?php if (isset($_POST['question_q3'])) echo $_POST['question_q3']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice1_q3" value="<?php if (isset($_POST['choice1_q3'])) echo $_POST['choice1_q3']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice2_q3" value="<?php if (isset($_POST['choice2_q3'])) echo $_POST['choice2_q3']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice3_q3" value="<?php if (isset($_POST['choice3_q3'])) echo $_POST['choice3_q3']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice4_q3" value="<?php if (isset($_POST['choice4_q3'])) echo $_POST['choice4_q3']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Answer</label>
        <div class="controls">
            <select name="answer_q3">
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

