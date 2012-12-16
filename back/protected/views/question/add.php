<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/question/">Question</a> <span class="divider">/</span> </li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Question</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Test</label>
        <div class="controls">
            <select class="input-xxlarge" name="test">
                <option value="0">--- Select Test ---</option>
                <?php foreach ($test as $o): ?>
                    <option value="<?php echo $o['id']; ?>"><?php echo $o['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="question" value="<?php if (isset($_POST['question'])) echo $_POST['question']; ?>">
        </div>
    </div>


    <div class="control-group">
        <label class="control-label">Question Type</label>
        <div class="controls">
            <select  class="input-xxlarge" name="type">
                <option value="0">--- Select Type ---</option>
                <option value="1">Type 1</option>
                <option value="2">Type 2</option>
                <option value="3">Type 3</option>
            </select>
        </div>
    </div>


    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

