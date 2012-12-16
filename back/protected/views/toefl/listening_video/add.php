<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening">Listening</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening_video/index/lid/<?php echo $listening['id']; ?>"><?php echo $listening['title']; ?></a> <span class="divider">/</span> </li>
    <li class="active">Add Video</li>
</ul>
<hr/>
<legend>Add Listening</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" name="title" class="input-xxlarge" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
            <input type="hidden" name="lid" value="<?php echo $listening['id']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Time</label>
        <div class="controls">
            <input type="text" name="time" value="<?php if (isset($_POST['time'])) echo $_POST['time']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Image</label>
        <div class="controls">
            <input type="file" name="file" value="">
            <p class="help-block">Hình ảnh phải lơn hơn kích thước 300x300px và dung lượng nhỏ hơn 3MB</p>
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

