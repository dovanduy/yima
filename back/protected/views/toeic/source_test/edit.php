<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/source_test/">Source Test</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $source_test['title'] ?></li>
</ul>
<hr/>
<legend>Edit Source Test: <?php echo $source_test['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label"><strong>Title</strong></label>
        <div class="controls">
            <input type="text"  class="input-xxlarge" name="title" value="<?php echo $source_test['title'] ?>">
        </div>
    </div>

    <legend>Listening</legend>
    <div class="control-group">
        <label class="control-label">Listening</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="listening">
                <option value="0">--- Select Listening ---</option>
                <?php foreach ($listenings as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['listening']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <legend>Reading</legend>
    <div class="control-group">
        <label class="control-label">Reading</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="reading">
                <option value="0">--- Select Reading ---</option>
                <?php foreach ($readings as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['reading']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <legend>Organization</legend>
    <div class="control-group">
        <label class="control-label">Organization</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="organization">
                <option value="0">--- Selec Organization ---</option>
                <?php foreach ($organizations as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['organization_id']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <legend>Autho</legend>
    <div class="control-group">
        <label class="control-label">Author</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="author">
                <option value="0">--- Select Author ---</option>
                <?php foreach ($users as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['author']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$source_test['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($source_test['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($source_test['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$source_test['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

