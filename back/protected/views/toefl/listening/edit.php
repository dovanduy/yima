<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/">Listening</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $listening['title'] ?></li>
</ul>
<hr/>
<legend>Edit listening: <?php echo $listening['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php echo $listening['title'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Level</label>
        <div class="controls">
            <select id="level_id" class="input-xxlarge" name="level_id">
                <option value="0">---Select a level---</option>
                <option value="1" <?php if ($listening['level'] == 1) echo 'selected'; ?>>Elementary</option>
                <option value="2" <?php if ($listening['level'] == 2) echo 'selected'; ?>>Intermediate</option>
                <option value="3" <?php if ($listening['level'] == 3) echo 'selected'; ?>>Upper-Intermediate</option>
                <option value="4" <?php if ($listening['level'] == 4) echo 'selected'; ?>>Advanced</option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Type</label>
        <div class="controls">
            <select id="type_id" class="input-xxlarge" name="type_id">
                <option value="0">---Select a level---</option>
                <option value="1" <?php if ($listening['listening_type'] == 1) echo 'selected'; ?>>Conversation</option>
                <option value="2" <?php if ($listening['listening_type'] == 2) echo 'selected'; ?>>Discussion</option>
                <option value="3" <?php if ($listening['listening_type'] == 3) echo 'selected'; ?>>Lecture</option>
                <option value="4" <?php if ($listening['listening_type'] == 4) echo 'selected'; ?>>Talk</option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Test Time</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="test_time" value="<?php echo $listening['test_time']; ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Source</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="source" value="<?php echo $listening['source']; ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Keyword</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="keyword" value="<?php echo $listening['keyword']; ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Sound</lavel>
            <div class="controls">
                <input type="file" name="audio"/>
            </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <embed type="application/x-shockwave-flash" src="<?php echo Yii::app()->baseUrl ?>/js/3523697345-audio-player.swf" quality="best" 
                   flashvars="audioUrl=<?php echo HelperApp::get_audio_toefl($listening['lsound'], 'listening/listening_page'); ?>" width="545" height="22"></embed>
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
                <input type="radio" name="disabled" value="0" <?php if (!$listening['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($listening['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($listening['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$listening['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

