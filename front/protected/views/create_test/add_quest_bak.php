

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <input type="hidden" value ="<?php echo $number ?>" name="number">
    <?php for ($i = 1; $i <= $number; $i++): ?>
        <div class="questions">
            <h4>Câu hỏi <?php echo $i ?>: </h4>
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
                    <textarea  class="span12 tinymce" name="question_<?php echo $i ?>"><?php if (isset($_POST['question'])) echo $_POST['question']; ?></textarea>
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

            <h4>Câu Trả Lời <?php echo $i ?>: </h4>
            <div class="control-group">

                <label class="control-label">Câu trả lời 1</label>
                <div class="controls">
                    <input type="text" class="span12" name="choice1_<?php echo $i ?>" >
                </div>
            </div>

            <div class="control-group">

                <label class="control-label">Câu trả lời 2</label>
                <div class="controls">
                    <input type="text" class="span12" name="choice2_<?php echo $i ?>" >
                </div>
            </div>

            <div class="control-group">

                <label class="control-label">Câu trả lời 3</label>
                <div class="controls">
                    <input type="text" class="span12" name="choice3_<?php echo $i ?>" >
                </div>
            </div>

            <div class="control-group">

                <label class="control-label">Câu trả lời 4</label>
                <div class="controls">
                    <input type="text" class="span12" name="choice4_<?php echo $i ?>" >
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Câu trả lời đúng</label>
                <div class="controls">
                    <select  class="span12" name="right_<?php echo $i ?>">
                        <option value="0">--- Chọn trả lời đúng ---</option>
                        <option value="1">Câu trả lời 1</option>
                        <option value="2">Câu trả lời 2</option>
                        <option value="3">Câu trả lời 3</option>
                        <option value="4">Câu trả lời 4</option>
                    </select>
                </div>
            </div>
        </div>
    <?php endfor; ?>
    <div class="form-actions">        
        <button type="button" class="btn btn-large" onclick="history.go(-1);return false;">Cancel</button>
        <button type="submit" class="btn btn-primary btn-large">Add</button>
        
    </div>
</form>
