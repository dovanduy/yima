<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/option/">Options</a> <span class="divider">/</span> </li>
    <li class="active">All</li>
</ul>
<hr/>
<p><a class="btn btn-primary" href="<?php echo Yii::app()->request->baseUrl; ?>/option/add/">Thêm mới</a></p>
<legend>Manage Options</legend>

<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <?php foreach ($options as $k => $v): ?>
        <div class="control-group">
            <label class="control-label"><?php echo $v['meta_label']; ?></label>
            <div class="controls">
                <?php if ($v['meta_type'] == "input"): ?>
                    <input type="text" class="input-xxlarge" name="<?php echo $v['meta_key']; ?>" value="<?php echo $v['meta_value'] ?>">
                <?php elseif ($v['meta_type'] == "textarea"): ?>
                    <textarea class="input-xxlarge" rows="5" name="<?php echo $v['meta_key']; ?>"><?php echo $v['meta_value']; ?></textarea>
                <?php endif; ?>

                    <a class="delete-option" href="<?php echo Yii::app()->request->baseUrl; ?>/option/delete/<?php echo $v['id'] ?>"><i class=" icon-remove-sign"></i></a>

            </div>
        </div>
    <?php endforeach; ?>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

