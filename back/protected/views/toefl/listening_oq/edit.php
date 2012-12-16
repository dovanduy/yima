<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening">Listening</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/edit/id/<?php echo $listening['id']; ?>"><?php echo $listening['title']; ?></a> <span class="divider">/</span> </li>
    <li class="active">OQ<span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
</ul>
<hr/>
<legend>Edit</legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" name="title" class="input-xxlarge" value="<?php echo $oq['title']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Question's Sound</label>
        <div class="controls">
            <input type="file" class="input-xlarge" name="question_sound">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <embed type="application/x-shockwave-flash" src="<?php echo Yii::app()->baseUrl ?>/js/3523697345-audio-player.swf" quality="best" 
                   flashvars="audioUrl=<?php echo HelperApp::get_audio_toefl($oq['lsound'], 'listening/oq'); ?>" width="545" height="22"></embed>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <div class="controls">
            <input type="text" name="choice_1" class="input-xxlarge" value="<?php echo $oq['choice1']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <div class="controls">
            <input type="text" name="choice_2" class="input-xxlarge" value="<?php echo $oq['choice2']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <div class="controls">
            <input type="text" name="choice_3" class="input-xxlarge" value="<?php echo $oq['choice3']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <div class="controls">
            <input type="text" name="choice_4" class="input-xxlarge" value="<?php echo $oq['choice4']; ?>">
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
    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$oq['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($oq['disabled']) echo 'checked'; ?>>
                Disabled
            </label>

        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($oq['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$oq['deleted']) echo 'checked'; ?>>
                No
            </label>

        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

