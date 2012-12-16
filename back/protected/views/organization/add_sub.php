<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/">Organization</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/add_subject/id/<?php echo $organization['id'] ?>"><?php echo $organization['title'] ?></a><span class="divider">/</span></li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Organization</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">

    <div class="control-group">
        <label class="control-label">Subject</label>
        <div class="controls">
            <select id="grade_id" class="input-xxlarge" name="subject_id">
                <option value="0">-- Select Subject ---</option>
                <?php foreach ($subject as $g): ?>
                    <option value="<?php echo $g['id']; ?>" <?php if (isset($_POST['subject_id']) && $_POST['subject_id'] == $g['id']) echo 'selected'; ?>><?php echo $g['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Subject Number</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="sub_num" value="<?php if (isset($_POST['sub_num'])) echo $_POST['sub_num']; ?>">
        </div>
    </div>
    
    
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

