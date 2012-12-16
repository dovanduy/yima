<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/index/?part=<?php echo $part?>">Reading 0<?php echo $part ?></a> <span class="divider">/</span> </li>
    <li class="active">Add Reading</li>
</ul>
<hr/>
<legend>Add Reading</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <input type="hidden" value ="<?php echo $part?>" name="part"/>
    <div class="control-group">
        <label class="control-label">Level</label>
        <div class="controls">
            <select id="level" class="input-xxlarge" name="level">
                <option value="0">--- Select Level ---</option>
                <option value="1">Elementary</option>
                <option value="2">Intermediate</option>
                <option value="3">Upper-Intermediate</option>
                <option value="4">Advance</option>
            </select>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Test Time</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="time" value="<?php if (isset($_POST['time'])) echo $_POST['time']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Source</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="source" value="<?php if (isset($_POST['source'])) echo $_POST['source']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Keyword</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="keyword" value="<?php if (isset($_POST['keyword'])) echo $_POST['keyword']; ?>">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Reading Text</label>
        <div class="controls">
            <textarea name="content" rows="30" class="tinymce input-xxlarge"><?php if (isset($_POST['content'])) echo $_POST['content']; ?></textarea>
        </div>
    </div>
    
    

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

