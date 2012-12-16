<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening">Listening</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/edit/id/<?php echo $listening['id']; ?>"><?php echo $listening['title']; ?></a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $video['title'] ?></li>
</ul>
<hr/>
<legend>Edit video: <?php echo $video['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" name="title" class="input-xxlarge" value="<?php echo $video['title'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Time</label>
        <div class="controls">
            <input type="text" name="time" value="<?php echo $video['time'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Image</label>
        <div class="controls">
            <input type="file" name="file" value="<?php echo $video['title'] ?>">
            <p class="help-block">Hình ảnh phải lơn hơn kích thước 300x300px và dung lượng nhỏ hơn 3MB</p>
        </div>
    </div>
     <?php if ($video['limg'] != ""): ?>
        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <img src="<?php echo HelperApp::get_thumbnail($video['thumbnail']) ?>" alt="" />
            </div>
        </div>
    <?php endif; ?>
    <?php /*
      <div class="control-group">
      <div class="controls">
      <audio controls="controls">
      <source src="<?php echo HelperApp::get_audio($video['lsound']); ?>" type="audio/mpeg">
      </audio>
      </div>
      </div> */ ?>
    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$video['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($video['disabled']) echo 'checked'; ?>>
                Disabled
            </label>

        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($video['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$video['deleted']) echo 'checked'; ?>>
                No
            </label>

        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

