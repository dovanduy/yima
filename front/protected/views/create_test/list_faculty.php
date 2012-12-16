
<label class="control-label">Khoa</label>
<div class="controls">
    <select link="<?php echo Yii::app()->baseUrl ?>/create_test/get_sub/" class="span12 list-faculty" name="faculty">
        <option value="0">--- Select Faculty ---</option>
        <?php foreach ($faculty as $f): ?>
            <option value="<?php echo $f['faculty_id']; ?>" ><?php echo $f['faculty_id'] != -1 ? $f['title'] : "(Khác)"; ?></option>
        <?php endforeach; ?>
    </select>
</div>
