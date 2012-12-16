<div id="top" class=""></div>
<?php $this->renderPartial('nav', array('testnt' => $testnt, 'type' => $type)); ?>

<div class="add-quest">           
    <p>Total <a href="<?php echo Yii::app()->request->baseUrl . "/testNT/question/id/$testnt[id]/"; ?>" class="label label-info"><?php echo $total_question; ?></a> question(s) of this test. <a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/question/id/<?php echo $testnt['id'] ?>" class="btn btn-warning">View</a></p>
    <p style="margin-bottom:20px">Number question: 

        <select style="margin-bottom: 0;margin-left: 10px;margin-right: 10px" link="<?php echo Yii::app()->baseUrl ?>/testNT/get_number_question"  class="input-mini number-question" name="number-question">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option>
            <?php endfor; ?>
        </select>

        <a class="btn get-number btn-info">Add question(s)</a></p>    
</div>

<?php echo Helper::print_error($message); ?>

<div class="list-question <?php if (!isset($_POST['question'])) echo 'hide'; ?>">
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <?php if (isset($_POST['question'])): ?>
            <?php foreach ($_POST['question'] as $k => $v): ?>

                <div class="questions clearfix" id="question-<?php echo $k; ?>">                                            
                    <legend>Question <?php echo $k + 1; ?></legend>
                    <?php /*
                      <div class="control-group">
                      <label class="control-label">Tên câu hỏi</label>
                      <div class="controls">
                      <textarea class="input-xxlarge tinymce" name="title_<?php echo $i ?>" ><?php if (isset($_POST['title'])) echo $_POST['title']; ?></textarea>
                      </div>
                      </div> */ ?>

                    <div class="control-group">
                        <label class="control-label">Question</label>
                        <div class="controls">
                            <textarea  class="span12" name="question[<?php echo $k; ?>]"><?php if (isset($_POST['question'][$k])) echo htmlspecialchars($_POST['question'][$k]); ?></textarea>
                        </div>
                    </div>

                    <?php /*
                      <div class="control-group">
                      <label class="control-label">Loại câu hỏi</label>
                      <div class="controls">
                      <select  class="input-xxlarge" name="type_<?php echo $i ?>">
                      <option value="0">--- Chọn loại câu hỏi ---</option>
                      <option value="1">Type 1</option>
                      <option value="2">Type 2</option>
                      <option value="3">Type 3</option>
                      </select>
                      </div>
                      </div> */ ?>

                    <p><h4>Answer</h4></p>
                    <div class="control-group">

                        <label class="control-label">Choice 1</label>
                        <div class="controls">
                            <input type="text" class="span12" name="choice1[<?php echo $k; ?>]" value="<?php if (isset($_POST['choice1'][$k])) echo htmlspecialchars($_POST['choice1'][$k]); ?>" >
                        </div>
                    </div>

                    <div class="control-group">

                        <label class="control-label">Choice 2</label>
                        <div class="controls">
                            <input type="text" class="span12" name="choice2[<?php echo $k; ?>]" value="<?php if (isset($_POST['choice2'][$k])) echo htmlspecialchars($_POST['choice2'][$k]); ?>">
                        </div>
                    </div>

                    <div class="control-group">

                        <label class="control-label">Choice 3</label>
                        <div class="controls">
                            <input type="text" class="span12" name="choice3[<?php echo $k; ?>]" value="<?php if (isset($_POST['choice3'][$k])) echo htmlspecialchars($_POST['choice3'][$k]); ?>">
                        </div>
                    </div>

                    <div class="control-group">

                        <label class="control-label">Choice 4</label>
                        <div class="controls">
                            <input type="text" class="span12" name="choice4[<?php echo $k; ?>]" value="<?php if (isset($_POST['choice4'][$k])) echo htmlspecialchars($_POST['choice4'][$k]); ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Right choice</label>
                        <div class="controls">
                            <select  class="span12" name="right[<?php echo $k; ?>]">
                                <option value="0">--- Right choice ---</option>
                                <?php for ($i = 1; $i < 5; $i++): ?>
                                    <option value="<?php echo $i; ?>" <?php if (isset($_POST['right'][$k]) && $_POST['right'][$k] == $i) echo 'selected'; ?>>Choice <?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <p class="pull-right"><a href ="#" class="btn btn-danger delete-question">Delete</a></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="form-actions">        
            <button type="submit" class="btn btn-primary btn-large">Update</button>
            <button type="button" class="btn btn-large" onclick="history.go(-1)">Cancel</button>
            <a title="top" class="btn btn-info pull-right scroll-to btn-large">Back to top</a>
            
        </div>
    </form>
    <div id="bottom" class=""></div>
</div>