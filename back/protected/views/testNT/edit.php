<?php $this->renderPartial('nav', array('testnt' => $testnt, 'type' => $type)); ?>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal add-test" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="span11" name="title" value="<?php echo $testnt['title'] ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Description</label>
        <div class="controls">
            <textarea name="descrip" rows="15" class="span11 tinymce"><?php echo $testnt['description']; ?></textarea>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Scan File</label>
        <div class="controls">
            <input type="file" name="attach_file" />
            <p class="help-block"><i>Note: File's format must be PDF, max size 3MB</i></p>                         
            <?php if ($testnt['attach_file']): ?>
                <?php
                $file = new SplFileInfo($testnt['attach_file']);
                ?>
                <p class="help-block">Current file: <a href="<?php echo Yii::app()->params['upload_url'] . $testnt['attach_file'] ?>"><?php echo $file->getFilename(); ?></a></p>
            <?php endif; ?>
        </div>
    </div>

    <input type="hidden" value="<?php echo isset($_POST['faculty']) ? $_POST['faculty'] : $testnt['faculty_id']; ?>" id="current_faculty_id"/>
    <input type="hidden" value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : $testnt['subject_id']; ?>" id="current_subject_id"/>
    <input type="hidden" value="<?php echo isset($_POST['organization']) ? $_POST['organization'] : $testnt['organization_id']; ?>" id="current_organization_id"/>

    <div class="control-group">
        <label class="control-label">Organization</label>
        <div class="controls">
            <select  class="span11 organization" name="organization">
                <option value="0">--- Select Organization ---</option>
                <?php foreach ($organization as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($testnt['organization_id'] == $o['id']) echo 'selected'; ?>><?php echo $o['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="control-group faculty hide">
        <label class="control-label">Faculty</label>
        <div class="controls">
            <select  class="span11 list-faculty" name="faculty">

            </select>
        </div>
    </div>

    <div class="control-group subject hide">
        <label class="control-label">Subject</label>
        <div class="controls">
            <select class="span11 list-subject" name="subject">                                
            </select>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label">Section</label>
        <div class="controls">
            <select  class="span11" name="section">
                <option value="0">--- Select Subject ---</option>
                <?php foreach ($section as $s): ?>
                    <option value="<?php echo $s['id']; ?>" <?php if ($testnt['section_id'] == $s['id']) echo "selected" ?>><?php echo $s['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="control-group input-append">
        <label class="control-label">Price</label>
        <div class="controls">
            <input type="text" class="input-medium" name="price" value="<?php echo $testnt['price']; ?>">
            <span class="add-on">VNĐ</span>
        </div>
    </div>
    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$testnt['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($testnt['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($testnt['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$testnt['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>


