<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/">Normal Test</a> <span class="divider">/</span> </li>
    <li class="active">Raw</li>
</ul>
<hr/>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<?php if (!$folder): ?>
    <legend>Raw normal test</legend>

    <form class="form-horizontal" method="get" enctype="multipart/form-data" action="">
        <div class="control-group">
            <label class="control-label">Exam folders</label>
            <div class="controls">
                <select  class="span4" name="folder">
                    <option value="0">--- Select Folder ---</option>
                    <?php foreach ($exam_folders as $v): ?>
                        <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                    <?php endforeach; ?>
                </select>
                <button style="margin-left: 10px" type="submit" class="btn btn-warning">Import images</button>
            </div>
        </div>
    </form>

<?php else : ?>
    <div id="top"></div>
    <form class="add-test clearfix" method="post" enctype="multipart/form-data">
    <div class="row-fluid">
        <div class="span4">
            <div class="affix" style="width: 310px;">
                

                    <legend>General information</legend>
                    <div class="control-group">
                        <label class="control-label">Title</label>
                        <div class="controls">
                            <input type="text" class="span11" name="title" value="<?php if (isset($_POST['title'])) echo htmlspecialchars($_POST['title']); ?>">
                        </div>
                    </div>
                    <?php /*
                      <div class="control-group">
                      <label class="control-label">Description</label>
                      <div class="controls">
                      <textarea name="description" rows="15" class="span11 tinymce"><?php if (isset($_POST['description'])) echo htmlspecialchars($_POST['description']); ?></textarea>
                      </div>
                      </div> */ ?>

                    <input type="hidden" value="<?php echo isset($_POST['faculty']) ? $_POST['faculty'] : 0; ?>" id="current_faculty_id"/>
                    <input type="hidden" value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : 0; ?>" id="current_subject_id"/>
                    <input type="hidden" value="<?php echo isset($_POST['organization']) ? $_POST['organization'] : 0; ?>" id="current_organization_id"/>

                    <div class="control-group">
                        <label class="control-label">Organization</label>
                        <div class="controls">
                            <select  class="span11 organization" name="organization">
                                <option value="0">--- Select Organization ---</option>
                                <?php foreach ($organization as $o): ?>
                                    <option value="<?php echo $o['id']; ?>" <?php if (isset($_POST['organization']) && $_POST['organization'] == $o['id']) echo 'selected'; ?>><?php echo $o['title']; ?></option>
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
                                    <option value="<?php echo $s['id']; ?>" <?php if (isset($_POST['section']) && $_POST['section'] == $s['id']) echo "selected" ?>><?php echo $s['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group input-append">
                        <label class="control-label">Price</label>
                        <div class="controls ">
                            <input type="text" class="input-medium" name="price" value="<?php if (isset($_POST['price'])) echo htmlspecialchars($_POST['price']); ?>">
                            <span class="add-on">VNĐ</span>
                        </div>
                    </div>

                    <div class="form-actions">        
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
                    </div>


                
            </div>
        </div>
        <div class="span8">
            <legend>Images</legend>
            <ul class="span12 clearfix list-images">
                <?php foreach ($images as $k => $v): ?>
                    <li class="image <?php if (!isset($_POST['images'][$k])) echo 'unused'; ?>" style="width: 268px;">
                        <a data-fancybox-group="gallery" class="fancybox" href="<?php echo Yii::app()->params['upload_url'] . $v; ?>"><img src="<?php echo Yii::app()->params['upload_url'] . $v; ?>" style="width:265px;height:265px;"/></a>
                        <input type="checkbox" name="images[<?php echo $k; ?>]" <?php if (isset($_POST['images'][$k])) echo 'checked'; ?> value="<?php echo $k; ?>" class="pick"/>
                    </li>
                <?php endforeach; ?>
            </ul>

            <p><a title="top" class="btn btn-info pull-right scroll-to">Back to top</a></p>
        </div>
    </div>
    </form>
    <?php /*
    <form class="form-horizontal add-test clearfix" method="post" enctype="multipart/form-data">

        <legend>General information</legend>
        <div class="control-group">
            <label class="control-label">Title</label>
            <div class="controls">
                <input type="text" class="span11" name="title" value="<?php if (isset($_POST['title'])) echo htmlspecialchars($_POST['title']); ?>">
            </div>
        </div>
        <?php /*
          <div class="control-group">
          <label class="control-label">Description</label>
          <div class="controls">
          <textarea name="description" rows="15" class="span11 tinymce"><?php if (isset($_POST['description'])) echo htmlspecialchars($_POST['description']); ?></textarea>
          </div>
          </div> 

        <input type="hidden" value="<?php echo isset($_POST['faculty']) ? $_POST['faculty'] : 0; ?>" id="current_faculty_id"/>
        <input type="hidden" value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : 0; ?>" id="current_subject_id"/>
        <input type="hidden" value="<?php echo isset($_POST['organization']) ? $_POST['organization'] : 0; ?>" id="current_organization_id"/>

        <div class="control-group">
            <label class="control-label">Organization</label>
            <div class="controls">
                <select  class="span11 organization" name="organization">
                    <option value="0">--- Select Organization ---</option>
                    <?php foreach ($organization as $o): ?>
                        <option value="<?php echo $o['id']; ?>" <?php if (isset($_POST['organization']) && $_POST['organization'] == $o['id']) echo 'selected'; ?>><?php echo $o['title']; ?></option>
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
                        <option value="<?php echo $s['id']; ?>" <?php if (isset($_POST['section']) && $_POST['section'] == $s['id']) echo "selected" ?>><?php echo $s['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="control-group input-append">
            <label class="control-label">Price</label>
            <div class="controls ">
                <input type="text" class="input-medium" name="price" value="<?php if (isset($_POST['price'])) echo htmlspecialchars($_POST['price']); ?>">
                <span class="add-on">VNĐ</span>
            </div>
        </div>

        <div class="form-actions">        
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
        </div>

        <legend>Images</legend>
        <ul class="span12 clearfix list-images">
            <?php foreach ($images as $k => $v): ?>
                <li class="image <?php if (!isset($_POST['images'][$k])) echo 'unused'; ?>">
                    <a data-fancybox-group="gallery" class="fancybox" href="<?php echo Yii::app()->params['upload_url'] . $v; ?>"><img src="<?php echo Yii::app()->params['upload_url'] . $v; ?>" style="width:200px;height:200px;"/></a>
                    <input type="checkbox" name="images[<?php echo $k; ?>]" <?php if (isset($_POST['images'][$k])) echo 'checked'; ?> value="<?php echo $k; ?>" class="pick"/>
                </li>
            <?php endforeach; ?>
        </ul>

        <p><a title="top" class="btn btn-info pull-right scroll-to">Back to top</a></p>
    </form>*/?>

<?php endif; ?>