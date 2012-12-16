<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/reading/">TOEIC Reading</a><span class="divider">/</span></li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/reading_part7/index/rid/<?php echo $reading['id']; ?>"><?php echo $reading['title']; ?></a><span class="divider">/</span></li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/reading_part7/index/rid/<?php echo $reading['id']; ?>">Part 7</a><span class="divider">/</span></li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Reading Question</legend>

<?php echo Helper::print_error($message); ?>

<?php if (isset($_GET['total_question']) && $_GET['total_question'] > 0): ?>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="control-group">
            <label class="control-label">Image</label>
            <div class="controls">
                <input type="file"  name="image">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Reading Text</label>
            <div class="controls">
                <textarea name="content" rows="7" class="input-xxlarge tinymce"><?php if (isset($_POST['content'])) echo $_POST['content']; ?></textarea>
            </div>
        </div>
        <?php for ($i = 0; $i < $_GET['total_question']; $i++): ?>
            <legend>Question <?php echo $i + 1; ?></legend>
            <div class="control-group">
                <label class="control-label">Question</label>
                <div class="controls">
                    <input type="text" class="input-xxlarge" name="question[<?php echo $i; ?>]" value="<?php if (isset($_POST['question'][$i])) echo $_POST['question'][$i]; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Choice 1</label>
                <div class="controls">
                    <input type="text" class="input-xxlarge" name="choice1[<?php echo $i; ?>]" value="<?php if (isset($_POST['choice1'][$i])) echo $_POST['choice1'][$i]; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Choice 2</label>
                <div class="controls">
                    <input type="text" class="input-xxlarge" name="choice2[<?php echo $i; ?>]" value="<?php if (isset($_POST['choice2'][$i])) echo $_POST['choice2'][$i]; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Choice 3</label>
                <div class="controls">
                    <input type="text" class="input-xxlarge" name="choice3[<?php echo $i; ?>]" value="<?php if (isset($_POST['choice3'][$i])) echo $_POST['choice3'][$i]; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Choice 4</label>
                <div class="controls">
                    <input type="text" class="input-xxlarge" name="choice4[<?php echo $i; ?>]" value="<?php if (isset($_POST['choice4'][$i])) echo $_POST['choice4'][$i]; ?>">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Answer</label>
                <div class="controls">
                    <select name="answer[<?php echo $i; ?>]">
                        <option value="1"> Choice 1</option>
                        <option value="2">Choice 2</option>
                        <option value="3">Choice 3</option>
                        <option value="4">Choice 4</option>
                    </select>
                </div>
            </div>
        <?php endfor; ?>
        <div class="form-actions">        
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
        </div>
    </form>

<?php else: ?>
    <form class="form-horizontal" method="get" enctype="multipart/form-data">
        <div class="control-group">
            <label class="control-label">Total questions</label>
            <div class="controls">
                <select name="total_question">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="form-actions">        
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
        </div>
    </form>
<?php endif; ?>
