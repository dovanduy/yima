<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/categoryfaq/">Category FAQs</a> <span class="divider">/</span> </li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Category FAQs</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">    

    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Type</label>
        <div class="controls">
            <select name="type">
                <?php foreach (Helper::category_types() as $k => $v): ?>
                    <option <?php if (isset($_POST['type']) && $_POST['type'] == $k) echo 'selected'; ?> value="<?php echo $k ?>"><?php echo $v; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Image</label>
        <div class="controls">
            <input type="file" name="file"/>
          
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Description</label>
        <div class="controls">
            <textarea class="span5" rows="5" name="description"><?php if (isset($_POST['description'])) echo $_POST['description'] ?></textarea>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Status</label>
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if (isset($_POST['disabled']) && $_POST['disabled']) echo 'checked'; ?>>
                Disable
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (isset($_POST['disabled']) && !$_POST['disabled']) echo 'checked'; ?> checked>
                Enable
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>

