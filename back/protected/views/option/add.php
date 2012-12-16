<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/option/">Options</a> <span class="divider">/</span> </li>
    <li class="active">Thêm mới</li>
</ul>
<hr/>
<legend>Add Option</legend>

<?php echo Helper::print_error($message); ?>

<?php if (!isset($_GET['meta_type']) || isset($_GET['meta_type']) && array_search($_GET['meta_type'], Helper::option_types()) === false): ?>
    <form class="form-horizontal" method="get" enctype="multipart/form-data">
        <div class="control-group">
            <label class="control-label">Meta Type</label>
            <div class="controls">            
                <select class="input-xxlarge" name="meta_type">
                    <?php foreach (Helper::option_types() as $k => $v): ?>
                        <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-actions">        
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
        </div>
    </form>

<?php else: ?>

    <form class="form-horizontal" method="post" enctype="multipart/form-data">

        <div class="control-group">
            <label class="control-label">Meta Label</label>
            <div class="controls">            
                <input type="text" class="input-xxlarge" name="meta_label" value="<?php if (isset($_POST['meta_label'])) echo htmlspecialchars($_POST['meta_label']); ?>">            
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Meta Key</label>
            <div class="controls">            
                <input type="text" class="input-xxlarge" name="meta_key" value="<?php if (isset($_POST['meta_key'])) echo htmlspecialchars($_POST['meta_key']); ?>">            
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Meta Value</label>
            <div class="controls">            
                <?php if ($_GET['meta_type'] == "textarea"): ?>
                    <textarea class="input-xxlarge" name="meta_value" rows="5"><?php if (isset($_POST['meta_value'])) echo $_POST['meta_value'] ?></textarea>
                <?php else: ?>
                    <input type="text" class="input-xxlarge" name="meta_value" value="<?php if (isset($_POST['meta_value'])) echo htmlspecialchars($_POST['meta_value']); ?>">            
                <?php endif; ?>
            </div>
        </div>

        <div class="form-actions">        
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
        </div>
    </form>

<?php endif; ?>