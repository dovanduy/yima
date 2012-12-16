<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening">Listening</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/edit/id/<?php echo $listening['id']; ?>"><?php echo $listening['title']; ?></a> <span class="divider">/</span> </li>
    <li class="active">CQ<span class="divider">/</span> </li>
    <li class="active">Add<span class="divider">/</span> </li>
</ul>
<hr/>
<legend>Add</legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" name="title" class="input-xxlarge" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Direction</label>
        <div class="controls">
            <textarea name="direction" class="input-xxlarge tinymce"><?php if (isset($_POST['direction'])) echo $_POST['direction']; ?></textarea>
        </div>
        <div class="controls">    
            <input type="hidden" name="lid" value="<?php echo $listening['id']; ?>"  >
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Direction's Sound</label>
        <div class="controls">
            <input type="file" name="direction_sound">
        </div>
    </div>

    <?php /*
      <div class="control-group">
      <div class="controls">
      <audio controls="controls">
      <source src="<?php echo HelperApp::get_audio($listening['lsound']); ?>" type="audio/mpeg">
      </audio>
      </div>
      </div> */ ?>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

