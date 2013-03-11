<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">
            <?php $this->renderPartial('sidebar'); ?>

            <section class="span9">
                <div id="search_results">         
                    <ul class="breadcrumb">
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Trang chủ</a> <span class="divider">/</span></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl . "/user/test/type/created/" ?>">Bài kiểm tra</a> <span class="divider">/</span></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/create_test/edit/id/<?php echo $question['test_id'] ?>"><?php echo $question['test_title'] ?></a> <span class="divider">/</span></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/create_test/edit/id/<?php echo $question['test_id'] ?>/type/question">Câu hỏi</a> <span class="divider">/</span></li>
                        <li class="active">Sửa</li>
                    </ul>
                    <legend>Sửa câu hỏi</legend>                    
                    <?php echo Helper::print_error($message); ?>  
                    <?php echo Helper::print_success($message); ?>  
                    <div class="add-test"> 
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">

                            <div class="control-group">
                                <label class="control-label">Câu hỏi</label>
                                <div class="controls">
                                    <textarea  class="span12 tinymce" name="question"><?php if (isset($_POST['question'])) echo htmlspecialchars($_POST['question']);else echo htmlspecialchars($question['question']); ?></textarea>
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

                            <p><h3>Trả lời</h3></p>
                            <div class="control-group">                                
                                <label class="control-label">Câu trả lời 1</label>
                                <div class="controls">
                                    <input type="text" class="span12" name="choice1" value="<?php if (isset($_POST['choice1'])) echo htmlspecialchars($_POST['choice1']);else echo htmlspecialchars($answer['choice_1']); ?>" >
                                </div>
                            </div>

                            <div class="control-group">

                                <label class="control-label">Câu trả lời 2</label>
                                <div class="controls">
                                    <input type="text" class="span12" name="choice2" value="<?php if (isset($_POST['choice2'])) echo htmlspecialchars($_POST['choice2']);else echo htmlspecialchars($answer['choice_2']); ?>">
                                </div>
                            </div>

                            <div class="control-group">

                                <label class="control-label">Câu trả lời 3</label>
                                <div class="controls">
                                    <input type="text" class="span12" name="choice3" value="<?php if (isset($_POST['choice3'])) echo htmlspecialchars($_POST['choice3']);else echo htmlspecialchars($answer['choice_3']) ?>">
                                </div>
                            </div>

                            <div class="control-group">

                                <label class="control-label">Câu trả lời 4</label>
                                <div class="controls">
                                    <input type="text" class="span12" name="choice4" value="<?php if (isset($_POST['choice4'])) echo htmlspecialchars($_POST['choice4']);else echo htmlspecialchars($answer['choice_4']); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Câu trả lời đúng</label>
                                <div class="controls">
                                    <select class="span12" name="right">
                                        <option value="0">--- Chọn trả lời đúng ---</option>
                                        <?php for ($i = 1; $i < 5; $i++): ?>
                                            <option value="<?php echo $i; ?>" <?php if (isset($_POST['right']) && $_POST['right'] == $i) echo 'selected';else if ($answer['right_choice'] == $i) echo 'selected'; ?>>Câu trả lời <?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">

                                <label class="control-label">Phân tích đáp án</label>
                                <div class="controls">
                                    <textarea class="span12" name="note" ><?php if (isset($_POST['note'])) echo htmlspecialchars($_POST['note']);else echo htmlspecialchars($answer['note']); ?></textarea>
                                </div>
                            </div>

                            <div class="form-actions">        
                                <button type="submit" class="btn btn-primary btn-large">Cập nhật</button>
                                <button type="button" class="btn btn-large pull-right" onclick="history.go(-1);return false;">Hủy</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </article>
    </div>
</div>