<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/">Normal Test</a> <span class="divider">/</span> </li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Test</legend>

<?php echo Helper::print_error($message); ?>                       
<div class="add-test"> 
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="control-group">
            <label class="control-label">Title</label>
            <div class="controls">
                <input type="text" class="span11" name="title" value="<?php if (isset($_POST['title'])) echo htmlspecialchars($_POST['title']); ?>">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
                <textarea name="description" rows="12" class="span11"><?php if (isset($_POST['description'])) echo $_POST['description']; ?></textarea>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Scan file</label>
            <div class="controls">
                <input type="file" name="attach_file" />
                <p class="help-block"><i>Note: File's format must be PDF, max size 3MB</i></p>                                    
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Organization</label>
            <div class="controls">
                <select link="<?php echo Yii::app()->baseUrl ?>/create_test/get_faculty_by_organizaiton/"  class="span11 organization" name="organization">
                    <option value="0">--- Organization ---</option>
                    <?php foreach ($organization as $o): ?>
                        <option <?php if (isset($_POST['organization']) && $_POST['organization'] == $o['id']) echo 'selected'; ?> value="<?php echo $o['id']; ?>"><?php echo $o['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <input type="hidden" value="<?php echo isset($_POST['faculty']) ? $_POST['faculty'] : 0; ?>" id="current_faculty_id"/>
        <input type="hidden" value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : 0; ?>" id="current_subject_id"/>
        <input type="hidden" value="<?php echo isset($_POST['organization']) ? $_POST['organization'] : 0; ?>" id="current_organization_id"/>
        <div class="control-group faculty hide">
            <label class="control-label">Faculty</label>
            <div class="controls">
                <select class="span11 list-faculty" name="faculty">

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
                    <option value="0">--- Loại ---</option>
                    <?php foreach ($section as $s): ?>
                        <option <?php if (isset($_POST['section']) && $_POST['section'] == $s['id']) echo 'selected'; ?> value="<?php echo $s['id']; ?>"><?php echo $s['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>



        <div class="control-group">
            <label class="control-label">Price</label>
            <div class="controls">
                <div class="input-append">
                    <input type="text" class="input-medium" name="price" value="<?php if (isset($_POST['price'])) echo htmlspecialchars($_POST['price']); ?>">
                    <span class="add-on" style="margin-left: -4px">VNĐ</span>
                </div>

                <p class="help-block"><i>Note: Price must divisible to 500</i></p>
            </div>
        </div>


        <div class="form-actions">        
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn " onclick="history.go(-1);return false;">Cancel</button>
        </div>
    </form>

