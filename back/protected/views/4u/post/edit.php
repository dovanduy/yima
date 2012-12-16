<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/4u/post/">Posts</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $post['title']; ?></li>
</ul>
<hr/>
<legend>Edit Post: <?php echo $post['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">   
    
    <div class="control-group">
        <label class="control-label">Subject</label>
        <div class="controls">
            <select class="input-xxlarge" name="subject_id">
                <?php foreach ($subjects as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if (isset($_POST['subject_id']) && $_POST['subject_id'] == $o['id']) echo 'selected';else if ($o['id'] == $post['subject_id']) echo 'selected'; ?>><?php echo $o['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Organization</label>
        <div class="controls">
            <select class="input-xxlarge" name="organization_id">
                <option value="0">--- Select Organization ---</option>
                <?php foreach ($organizations as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if (isset($_POST['organization_id']) && $_POST['organization_id'] == $o['id']) echo 'selected';else if ($o['id'] == $post['organization_id']) echo 'selected'; ?>><?php echo $o['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php if(isset($_POST['title'])) echo htmlspecialchars($_POST['title']);else echo htmlspecialchars($post['title']); ?>">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Content</label>
        <div class="controls">
            <textarea class="input-xxlarge" name="content" rows="15"><?php if(isset($_POST['content'])) echo $_POST['content'];else echo $post['content']; ?></textarea>
        </div>
    </div>

    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if(isset($_POST['deleted']) && $_POST['deleted']) echo 'checked';else if ($post['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if(isset($_POST['deleted']) && !$_POST['deleted']) echo 'checked';else if (!$post['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

