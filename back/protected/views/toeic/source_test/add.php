<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/source_test/">Source Test</a> <span class="divider">/</span> </li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Source Test</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label"><strong>Title</strong></label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title">
        </div>
    </div>
    <legend>Listening</legend>
    <div class="control-group">
        <label class="control-label">Listening</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="listening">
                <option value="0">--- Select Listening ---</option>
                <?php foreach ($listenings as $o): ?>
                    <option value="<?php echo $o['id']; ?>"><?php echo $o['title']; ?></option>
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
                    <option value="<?php echo $o['id']; ?>"><?php echo $o['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <legend>Organization</legend>
    <div class="control-group">
        <label class="control-label">Organization</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="organization">
                <option value="0">--- Select Organization ---</option>
                <?php foreach ($organizations as $o): ?>
                    <option value="<?php echo $o['id']; ?>"><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <legend>Author</legend>
    <div class="control-group">
        <label class="control-label">Author</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="author">
                <option value="0">--- Select Author ---</option>
                <?php foreach ($users as $o): ?>
                    <option value="<?php echo $o['id']; ?>"><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

