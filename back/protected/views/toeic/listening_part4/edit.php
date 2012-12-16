<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening/">TOEIC Listening</a><span class="divider">/</span></li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening_part4/index/lid/<?php echo $listening['id']; ?>"><?php echo $listening['title']; ?></a><span class="divider">/</span></li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening_part4/index/lid/<?php echo $listening['id']; ?>">Part 4</a><span class="divider">/</span></li>
    <li class="active">Edit</li>
</ul>
<hr/>
<legend>Edit Listening Question:</legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">

    <legend>Sound File</legend>
    <div class="control-group">
        <label class="control-label">Sound's Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="sound_title" value="<?php if (isset($listening_part4['title'])) echo $listening_part4['title']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Question's Sound</label>
        <div class="controls">
            <input type="file" class="input-xlarge" name="question_sound">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <embed type="application/x-shockwave-flash" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" quality="best" flashvars="audioUrl=<?php echo HelperApp::get_audio($listening_part4['lsound']); ?>" width="545" height="22"></embed>
        </div>
    </div>
    <legend>Question 1</legend>
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="question_q1" value="<?php if (isset($listening_part4['question_1'])) echo $listening_part4['question_1']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice1_q1" value="<?php if (isset($listening_part4['choice1_1'])) echo $listening_part4['choice1_1']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice2_q1" value="<?php if (isset($listening_part4['choice2_1'])) echo $listening_part4['choice2_1']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice3_q1" value="<?php if (isset($listening_part4['choice3_1'])) echo $listening_part4['choice3_1']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice4_q1" value="<?php if (isset($listening_part4['choice4_1'])) echo $listening_part4['choice4_1']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Answer</label>
        <div class="controls">
            <select name="answer_q1">
                <option value="1" <?php if ($listening_part4['answer_1'] == '1') echo 'selected'; ?>>Choice 1</option>
                <option value="2" <?php if ($listening_part4['answer_1'] == '2') echo 'selected'; ?>>Choice 2</option>
                <option value="3" <?php if ($listening_part4['answer_1'] == '3') echo 'selected'; ?>>Choice 3</option>
                <option value="4" <?php if ($listening_part4['answer_1'] == '4') echo 'selected'; ?>>Choice 4</option>
            </select>
        </div>
    </div>
    <legend>Question 2</legend>
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="question_q2" value="<?php if (isset($listening_part4['question_2'])) echo $listening_part4['question_2']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice1_q2" value="<?php if (isset($listening_part4['choice1_2'])) echo $listening_part4['choice1_2']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice2_q2" value="<?php if (isset($listening_part4['choice2_2'])) echo $listening_part4['choice2_2']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice3_q2" value="<?php if (isset($listening_part4['choice3_2'])) echo $listening_part4['choice3_2']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice4_q2" value="<?php if (isset($listening_part4['choice4_2'])) echo $listening_part4['choice4_2']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Answer</label>
        <div class="controls">
            <select name="answer_q2">
                <option value="1" <?php if ($listening_part4['answer_2'] == '1') echo 'selected'; ?>>Choice 1</option>
                <option value="2" <?php if ($listening_part4['answer_2'] == '2') echo 'selected'; ?>>Choice 2</option>
                <option value="3" <?php if ($listening_part4['answer_2'] == '3') echo 'selected'; ?>>Choice 3</option>
                <option value="4" <?php if ($listening_part4['answer_2'] == '4') echo 'selected'; ?>>Choice 4</option>
            </select>
        </div>
    </div>
    <legend>Question 3</legend>
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="question_q3" value="<?php if (isset($listening_part4['question_3'])) echo $listening_part4['question_3']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice1_q3" value="<?php if (isset($listening_part4['choice1_3'])) echo $listening_part4['choice1_3']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice2_q3" value="<?php if (isset($listening_part4['choice2_3'])) echo $listening_part4['choice2_3']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice3_q3" value="<?php if (isset($listening_part4['choice3_3'])) echo $listening_part4['choice3_3']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice4_q3" value="<?php if (isset($listening_part4['choice4_3'])) echo $listening_part4['choice4_3']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Answer</label>
        <div class="controls">
            <select name="answer_q3">
                <option value="1" <?php if ($listening_part4['answer_3'] == '1') echo 'selected'; ?>>Choice 1</option>
                <option value="2" <?php if ($listening_part4['answer_3'] == '2') echo 'selected'; ?>>Choice 2</option>
                <option value="3" <?php if ($listening_part4['answer_3'] == '3') echo 'selected'; ?>>Choice 3</option>
                <option value="4" <?php if ($listening_part4['answer_3'] == '4') echo 'selected'; ?>>Choice 4</option>
            </select>
        </div>
    </div>


    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$listening_part4['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($listening_part4['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($listening_part4['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$listening_part4['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

