<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">
            <?php $this->renderPartial('sidebar'); ?>

            <section class="search span9">
                <div id="search_results">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Trang chủ</a> <span class="divider">/</span></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl."/user/test/type/created/" ?>">Bài kiểm tra</a> <span class="divider">/</span></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/create_test/edit/id/<?php echo $question['id'] ?>"><?php echo $question['title'] ?></a> <span class="divider">/</span></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/create_test/edit/id/<?php echo $question['id'] ?>/type/question">Câu hỏi</a> <span class="divider">/</span></li>
                        <li class="active">Thêm</li>
                    </ul>
                    <legend>Thêm câu hỏi đề thi: <?php echo $question['title']; ?></legend>
                    <div class="add-quest">           
                        <p>Có <a href="<?php echo Yii::app()->request->baseUrl . "/create_test/edit/id/$question[id]/type/question/" ?>" class="label label-info"><?php echo $total_question; ?></a> câu hỏi thuộc đề thi này.</p>
                        <p style="margin-bottom:20px">Số lượng câu hỏi: 

                            <select style="margin-bottom: 0;margin-left: 10px;margin-right: 10px" link="<?php echo Yii::app()->baseUrl ?>/create_test/get_number_question"  class="input-mini number-question" name="number-question">
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>

                            <a class="btn get-number btn-info">Thêm câu hỏi</a></p>
                        <?php echo Helper::print_error($message); ?>
                        <?php echo Helper::print_success($message); ?>
                    </div>

                    <div class="list-question <?php if (!isset($_POST['question'])) echo 'hide'; ?>">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            <?php if (isset($_POST['question'])): ?>
                                <?php foreach ($_POST['question'] as $k => $v): ?>

                                    <div class="questions clearfix" id="question-<?php echo $k; ?>">                                            
                                        <legend>Câu hỏi <?php echo $k + 1; ?></legend>
                                        <?php /*
                                          <div class="control-group">
                                          <label class="control-label">Tên câu hỏi</label>
                                          <div class="controls">
                                          <textarea class="input-xxlarge tinymce" name="title_<?php echo $i ?>" ><?php if (isset($_POST['title'])) echo $_POST['title']; ?></textarea>
                                          </div>
                                          </div> */ ?>

                                        <div class="control-group">
                                            <label class="control-label">Câu hỏi</label>
                                            <div class="controls">
                                                <textarea  class="span12 tinymce" name="question[<?php echo $k; ?>]"><?php if (isset($_POST['question'][$k])) echo htmlspecialchars ($_POST['question'][$k]); ?></textarea>
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
                                                <input type="text" class="span12" name="choice1[<?php echo $k; ?>]" value="<?php if (isset($_POST['choice1'][$k])) echo htmlspecialchars($_POST['choice1'][$k]); ?>" >
                                            </div>
                                        </div>

                                        <div class="control-group">

                                            <label class="control-label">Câu trả lời 2</label>
                                            <div class="controls">
                                                <input type="text" class="span12" name="choice2[<?php echo $k; ?>]" value="<?php if (isset($_POST['choice2'][$k])) echo htmlspecialchars($_POST['choice2'][$k]); ?>">
                                            </div>
                                        </div>

                                        <div class="control-group">

                                            <label class="control-label">Câu trả lời 3</label>
                                            <div class="controls">
                                                <input type="text" class="span12" name="choice3[<?php echo $k; ?>]" value="<?php if (isset($_POST['choice3'][$k])) echo htmlspecialchars($_POST['choice3'][$k]); ?>">
                                            </div>
                                        </div>

                                        <div class="control-group">

                                            <label class="control-label">Câu trả lời 4</label>
                                            <div class="controls">
                                                <input type="text" class="span12" name="choice4[<?php echo $k; ?>]" value="<?php if (isset($_POST['choice4'][$k])) echo htmlspecialchars($_POST['choice4'][$k]); ?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Câu trả lời đúng</label>
                                            <div class="controls">
                                                <select  class="span12" name="right[<?php echo $k; ?>]">
                                                    <option value="0">--- Chọn trả lời đúng ---</option>
                                                    <?php for ($i = 1; $i < 5; $i++): ?>
                                                        <option value="<?php echo $i; ?>" <?php if (isset($_POST['right'][$k]) && $_POST['right'][$k] == $i) echo 'selected'; ?>>Câu trả lời <?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <p class="pull-right"><a href ="#" class="btn btn-danger delete-question">Xóa câu hỏi</a></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="form-actions">        
                                <button type="button" class="btn btn-large pull-right" onclick="history.go(-1)">Hủy</button>
                                <button type="submit" class="btn btn-primary btn-large">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>                
            </section>
        </article>
    </div>
</div>