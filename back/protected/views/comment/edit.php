<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/4u/comment/">Comments</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active">#<?php echo $comment['id']; ?></li>
</ul>
<hr/>
<legend>Edit Comment: <?php echo $comment['id'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">   

    <div class="control-group">
        <label class="control-label">Post title</label>
        <div class="controls">
            <span style="margin-top: 5px" class="help-block">
                <?php if ($comment['ref_type'] == "post"): ?>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/4u/post/edit/id/<?php echo $comment['ref_id'] ?>"><?php echo $comment['post_title']; ?></a>
                <?php elseif ($comment['ref_type'] == "test_nt"): ?>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/edit/id/<?php echo $comment['ref_id'] ?>"><?php echo $comment['test_nt_title']; ?></a>
                <?php endif; ?>
            </span>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Type</label>
        <div class="controls">
            <span style="margin-top: 5px" class="help-block"><?php echo $comment['ref_type']; ?></span>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Author</label>
        <div class="controls">
            <span style="margin-top: 5px" class="help-block"><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/edit/id/<?php echo $comment['author_id'] ?>"><?php echo $comment['email']; ?></a></span>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label">Content</label>
        <div class="controls">
            <textarea class="input-xxlarge" name="content" rows="15"><?php if (isset($_POST['content'])) echo $_POST['content'];else echo $comment['content']; ?></textarea>
        </div>
    </div>

    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if (isset($_POST['deleted']) && $_POST['deleted']) echo 'checked';else if ($comment['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (isset($_POST['deleted']) && !$_POST['deleted']) echo 'checked';else if (!$comment['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

