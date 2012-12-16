<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/writing/index/part/1">Integrated Writing</a> <span class="divider">/</span> </li>

    <li class="active">Add Speaking</li>
</ul>
<hr/>
<legend>Add Speaking</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <legend>Title</legend>
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text"  class="input-xxlarge" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
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
        <label class="control-label">Source</label>
        <div class="controls">
            <input type="text" name="source" class="input-xxlarge" value="<?php if (isset($_POST['source'])) echo $_POST['source']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Keyword</label>
        <div class="controls">
            <input type="text" name="keyword"  class="input-xxlarge" value="<?php if (isset($_POST['keyword'])) echo $_POST['keyword']; ?>">
        </div>
    </div>

    <legend>Subject</legend>
    <div class="control-group">
        <label class="control-label">Subject</label>
        <div class="controls">
            <input type="text" name="subject" class="input-xxlarge" value="<?php if (isset($_POST['subject'])) echo $_POST['subject']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file"  name="sound_1">
        </div>
    </div>

    <legend>Listening</legend>
    <div class="control-group">
        <label class="control-label">Image</label>
        <div class="controls">
            <input type="file" name="image" >
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file" name="sound_2" >
        </div>
    </div>

    <legend>Direction</legend>
    <div class="control-group">
        <label class="control-label">Direction</label>
        <div class="controls">
            <input type="text" name="direction" class="input-xxlarge" value="<?php if (isset($_POST['direction'])) echo $_POST['direction']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file" name="sound_3">
        </div>
    </div>

    <legend>Reading Text</legend>
    <div class="control-group">
        <label class="control-label">Reading Text</label>
        <div class="controls">
            <textarea name="content" class="input-xxlarge tinymce"><?php if (isset($_POST['content'])) echo $_POST['content']; ?></textarea>
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

