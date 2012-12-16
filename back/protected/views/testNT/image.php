<div id="top" class="clearfix"></div>
<?php $this->renderPartial('nav', array('testnt' => $testnt, 'type' => $type)); ?>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>


<?php if (count($images) > 0 && !$folder): ?>
    <form class="form-horizontal add-test" method="post" enctype="multipart/form-data">

        <ul class="span12 clearfix list-images">
            <?php foreach ($images as $k => $v): ?>
                <li class="image">
                    <a data-fancybox-group="gallery" class="fancybox" href="<?php echo Yii::app()->params['upload_url'] . $v['full_link']; ?>"><img src="<?php echo Yii::app()->params['upload_url'] . $v['full_link']; ?>" style="width:200px;height:200px;"/></a>
                    <input type="checkbox" name="images[<?php echo $v['image_id']; ?>]" value="<?php echo $v['image_id']; ?>" checked class="pick"/>
                </li>
            <?php endforeach; ?>

            <?php foreach ($other_images as $k => $v): ?>
                <li class="image unused">
                    <a data-fancybox-group="gallery" class="fancybox" href="<?php echo Yii::app()->params['upload_url'] . $v['full_link']; ?>"><img src="<?php echo Yii::app()->params['upload_url'] . $v['full_link']; ?>" style="width:200px;height:200px;"/></a>
                    <input type="checkbox" name="images[<?php echo $v['id']; ?>]" value="<?php echo $v['id']; ?>" class="pick"/>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="clearfix">
            <input type="hidden" name="tmp" value=""/>
        </div>
        <div class="form-actions">        
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
            <button class="pull-right btn btn-info scroll-to" title="top">Back to top</button>
        </div>
    </form>
<?php endif; ?>

<?php if (count($images) < 1 && !$folder): ?>

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

<?php endif; ?>

<?php if (count($images) > 0 && $folder): ?>
    <form class="form-horizontal add-test" method="post" enctype="multipart/form-data">

        <ul class="span12 clearfix list-images">
            <?php foreach ($images as $k => $v): ?>
                <li class="image <?php if (!isset($_POST['images'][$k])) echo 'unused'; ?>">
                    <a data-fancybox-group="gallery" class="fancybox" href="<?php echo Yii::app()->params['upload_url'] . $v; ?>"><img src="<?php echo Yii::app()->params['upload_url'] . $v; ?>" style="width:200px;height:200px;"/></a>
                    <input type="checkbox" name="images[<?php echo $k; ?>]" <?php if (isset($_POST['images'][$k])) echo 'checked'; ?> value="<?php echo $k; ?>" class="pick"/>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="clearfix">
            <input type="hidden" name="tmp" value=""/>
        </div>
        <div class="form-actions">        
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
            <button class="pull-right btn btn-info scroll-to" title="top">Back to top</button>
        </div>
    </form>
<?php endif; ?>

