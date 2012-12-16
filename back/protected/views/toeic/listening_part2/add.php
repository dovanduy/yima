<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening/">TOEIC Listening</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening_part2/index/lid/<?php echo $li;?>">TOEIC Listening Part 2</a> <span class="divider">/</span> </li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Listening Part 1 Test</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
   


    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file"  name="sound">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Answer</label>
        <div class="controls">
            <select  class="input-xxlarge" name="answer">
                <option value="0">--- Select Answer ---</option>
                <option value="1">A</option>
                <option value="2">B</option>
                <option value="3">C</option>
                <option value="4">D</option>
            </select>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

