<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/writing/index/part/1">Integrated Writing</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $writing['title'] ?></li>
</ul>
<hr/>
<legend>Edit speaking: <?php echo $writing['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <legend>Title</legend>
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" name="title" class="input-xxlarge" value="<?php echo $writing['title'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Level</label>
        <div class="controls">
            <select id="level" class="input-xxlarge" name="level">
                <option value="0">--- Select Level ---</option>
                <option value="1" <?php if ($writing['level'] == 1) echo "selected" ?>>Elementary</option>
                <option value="2" <?php if ($writing['level'] == 2) echo "selected" ?>>Intermediate</option>
                <option value="3" <?php if ($writing['level'] == 3) echo "selected" ?>>Upper-Intermediate</option>
                <option value="4" <?php if ($writing['level'] == 4) echo "selected" ?>>Advance</option>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Source</label>
        <div class="controls">
            <input type="text" name="source" class="input-xxlarge" value="<?php echo $writing['source'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Keyword</label>
        <div class="controls">
            <input type="text" name="keyword" class="input-xxlarge" value="<?php echo $writing['keyword'] ?>">
        </div>
    </div>

    <legend>Subject</legend>
    <div class="control-group">
        <label class="control-label">Subject</label>
        <div class="controls">
            <input type="text" name="subject" class="input-xxlarge" value="<?php echo $writing['subject'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file" name="sound_1">
        </div>
    </div>
      <div class="control-group">
        <div class="controls">
            <embed type="application/x-shockwave-flash" src="<?php echo Yii::app()->baseUrl ?>/js/3523697345-audio-player.swf" quality="best" 
                   flashvars="audioUrl=<?php echo HelperApp::get_audio_toefl($writing['ssound'], 'writing'); ?>" width="545" height="22"></embed>
        </div>
    </div>


    <legend>Listening</legend>
    <div class="control-group">
        <label class="control-label">Image</label>
        <div class="controls">
            <input type="file" name="image" >
        </div>
    </div>
   <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <img src="<?php echo HelperApp::get_thumbnail($writing['thumbnail']) ?>" alt="" />
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file" name="sound_2" >
        </div>
    </div>
      <div class="control-group">
        <div class="controls">
            <embed type="application/x-shockwave-flash" src="<?php echo Yii::app()->baseUrl ?>/js/3523697345-audio-player.swf" quality="best" 
                   flashvars="audioUrl=<?php echo HelperApp::get_audio_toefl($writing['lsound'], 'writing'); ?>" width="545" height="22"></embed>
        </div>
    </div>

    <legend>Direction</legend>
    <div class="control-group">
        <label class="control-label">Direction</label>
        <div class="controls">
            <input type="text" name="direction" class="input-xxlarge" value="<?php echo $writing['direction'] ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file" name="sound_3">
        </div>
    </div>
      <div class="control-group">
        <div class="controls">
            <embed type="application/x-shockwave-flash" src="<?php echo Yii::app()->baseUrl ?>/js/3523697345-audio-player.swf" quality="best" 
                   flashvars="audioUrl=<?php echo HelperApp::get_audio_toefl($writing['dsound'], 'writing'); ?>" width="545" height="22"></embed>
        </div>
    </div>

    <legend>Reading Text</legend>
    <div class="control-group">
        <label class="control-label">Reading Text</label>
        <div class="controls">
            <textarea name="content" class="tinymce"><?php echo $writing['content'] ?></textarea>
        </div>
    </div>
    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$writing['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($writing['disabled']) echo 'checked'; ?>>
                Disabled
            </label>

        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($writing['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$writing['deleted']) echo 'checked'; ?>>
                No
            </label>

        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

