
<label class="control-label">Môn</label>
<div class="controls">
    <select link="<?php echo Yii::app()->baseUrl ?>/testNT/get_sub/" class="span12 list-subject" name="subject">
        <option value="0">--- Select Subject ---</option>
        <?php foreach ($subject as $s): ?>
            <option value="<?php echo $s['subject_id']; ?>" ><?php echo $s['title'] ?></option>
        <?php endforeach; ?>
    </select>
</div>
