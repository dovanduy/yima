<?php for ($i = $next; $i < $number; $i++): ?>

    <div class="questions hide clearfix" id="question-<?php echo $i; ?>">
        <legend>Câu hỏi <?php echo $i + 1; ?></legend>
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
                <textarea  class="span12 tinymce" name="question[<?php echo $i; ?>]"></textarea>
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
            <input type="text" class="span12" name="choice1[<?php echo $i; ?>]" >
        </div>
    </div>

    <div class="control-group">

        <label class="control-label">Câu trả lời 2</label>
        <div class="controls">
            <input type="text" class="span12" name="choice2[<?php echo $i; ?>]" >
        </div>
    </div>

    <div class="control-group">

        <label class="control-label">Câu trả lời 3</label>
        <div class="controls">
            <input type="text" class="span12" name="choice3[<?php echo $i; ?>]" >
        </div>
    </div>

    <div class="control-group">

        <label class="control-label">Câu trả lời 4</label>
        <div class="controls">
            <input type="text" class="span12" name="choice4[<?php echo $i; ?>]" >
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Câu trả lời đúng</label>
        <div class="controls">
            <select  class="span12" name="right[<?php echo $i; ?>]">
                <option value="0">--- Chọn trả lời đúng ---</option>
                <option value="1">Câu trả lời 1</option>
                <option value="2">Câu trả lời 2</option>
                <option value="3">Câu trả lời 3</option>
                <option value="4">Câu trả lời 4</option>
            </select>
        </div>
    </div>
    <div class="control-group">

        <label class="control-label">Phân tích đáp án</label>
        <div class="controls">
            <textarea class="span12" name="note[<?php echo $i; ?>]" ></textarea>
        </div>
    </div>
    <p class="pull-right"><a href ="#" class="btn btn-danger delete-question">Xóa câu hỏi</a></p>
    </div>
<?php endfor; ?>
