<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/">Add</a> <span class="divider">/</span> </li>
    <li class="active">Add Listening</li>
</ul>
<hr/>
<legend>Add Listening</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php if (isset($_POST['title'])) echo htmlspecialchars($_POST['title']); ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Level</label>
        <div class="controls">
            <select id="level_id" class="input-xxlarge" name="level_id">
                <option value="0">---Select a level---</option>
                <option value="1" >Elementary</option>
                <option value="2" >Intermediate</option>
                <option value="3" >Upper-Intermediate</option>
                <option value="4" >Advanced</option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Type</label>
        <div class="controls">
            <select id="type_id" class="input-xxlarge" name="type_id">
                <option value="0">---Select a level---</option>
                <option value="1" >Conversation</option>
                <option value="2" >Discussion</option>
                <option value="3" >Lecture</option>
                <option value="4" >Talk</option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Test Time</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="test_time" value="<?php if (isset($_POST['test_time'])) echo htmlspecialchars($_POST['test_time']); ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Source</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="source" value="<?php if (isset($_POST['source'])) echo htmlspecialchars($_POST['source']); ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Keyword</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="keyword" value="<?php if (isset($_POST['keyword'])) echo htmlspecialchars($_POST['keyword']); ?>"/>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Sound</lavel>
            <div class="controls">
                <input type="file" name="audio"/>
            </div>
    </div>
 

    
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

