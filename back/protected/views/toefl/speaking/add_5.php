<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/speaking/index/part/5">Integrated Task (L) 05</a> <span class="divider">/</span> </li>

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
            <input type="text" name="title"  class="input-xxlarge" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
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
            <input type="text" name="source" class="input-xxlarge" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Keyword</label>
        <div class="controls">
            <input type="text" name="keyword" class="input-xxlarge" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>

    <legend>Subject</legend>
    <div class="control-group">
        <label class="control-label">Subject</label>
        <div class="controls">
            <input type="text" name="subject" class="input-xxlarge" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file" name="sound_1">
        </div>
    </div>

    <legend>Listening</legend>
    <div class="control-group">
        <label class="control-label">Image</label>
        <div class="controls">
            <input type="file" name="image" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file" name="sound_2" >
        </div>
    </div>


    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

