<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/index/part/<?php echo $part ?>">Listening 0<?php echo $part ?></a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listeningSCQ/index/lid/<?php echo $listeningSCQ['lid'] ?>/part/<?php echo $part ?>">SCQ</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $listeningSCQ['title'] ?></li>
</ul>
<hr/>
<legend>Edit Listening SCQ: <?php echo $listeningSCQ['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <legend>Title</legend>
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" name="title" class="input-xxlarge" value="<?php echo $listeningSCQ['title']; ?>">
        </div>
    </div>


    <div class="control-group">
        <label class="control-label">Question's Sound</label>
        <div class="controls">
            <input type="file" name="sound_1">
        </div>
    </div>
    
    <div class="control-group">
        <div class="controls">
            <embed type="application/x-shockwave-flash" src="<?php echo Yii::app()->baseUrl ?>/js/3523697345-audio-player.swf" quality="best" 
                   flashvars="audioUrl=<?php echo HelperApp::get_audio_toefl($listeningSCQ['lsound'], 'listening/scq'); ?>" width="545" height="22"></embed>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <input type="radio" name="choice" value="1" <?php if ($listeningSCQ['answer'] == 1) echo "checked" ?>/>
        <div class="controls">
            <input type="text" name="choice1" class="input-xxlarge" value="<?php echo $listeningSCQ['choice1']; ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <input type="radio" name="choice" value="2" <?php if ($listeningSCQ['answer'] == 2) echo "checked" ?>/>
        <div class="controls">
            <input type="text" name="choice2" class="input-xxlarge" value="<?php echo $listeningSCQ['choice2']; ?>"/>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <input type="radio" name="choice" value="3" <?php if ($listeningSCQ['answer'] == 3) echo "checked" ?>/>
        <div class="controls">
            <input type="text" name="choice3" class="input-xxlarge" value="<?php echo $listeningSCQ['choice3']; ?>"/>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <input type="radio" name="choice" value="4" <?php if ($listeningSCQ['answer'] == 4) echo "checked" ?>/>
        <div class="controls">
            <input type="text" name="choice4" class="input-xxlarge" value="<?php echo $listeningSCQ['choice4']; ?>"/>
        </div>
    </div>

    <legend>Replay Listening Audio</legend>
    <div class="control-group">
        <label class="control-label">Replay</label>
        <div class="controls">
            <input type="checkbox" name="replay" value="1" <?php if ($listeningSCQ['replay'] == 1) echo "checked" ?>/>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">From</label>

        <div class="controls">
            <input type="text" name="from" class="input-xxlarge" value="<?php echo $listeningSCQ['replay_from']; ?>"/> second(s)
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">To</label>

        <div class="controls">
            <input type="text" name="to" class="input-xxlarge" value="<?php echo $listeningSCQ['replay_to']; ?>"/> second(s)
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file" name="sound_2"/>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <embed type="application/x-shockwave-flash" src="<?php echo Yii::app()->baseUrl ?>/js/3523697345-audio-player.swf" quality="best" 
                   flashvars="audioUrl=<?php echo HelperApp::get_audio_toefl($listeningSCQ['replay_sound'], 'listening/scq'); ?>" width="545" height="22"></embed>
        </div>
    </div>

    <legend>Replay Sentence Audio</legend>
    <div class="control-group">
        <label class="control-label">Replay</label>
        <div class="controls">
            <input type="checkbox" name="sentence" value="1" <?php if ($listeningSCQ['sentence'] == 1) echo "checked" ?>/>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file" name="sound_3"/>
        </div>
    </div>
    
       <div class="control-group">
        <div class="controls">
            <embed type="application/x-shockwave-flash" src="<?php echo Yii::app()->baseUrl ?>/js/3523697345-audio-player.swf" quality="best" 
                   flashvars="audioUrl=<?php echo HelperApp::get_audio_toefl($listeningSCQ['sentence_sound'], 'listening/scq'); ?>" width="545" height="22"></embed>
        </div>
    </div>

    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$listeningSCQ['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($listeningSCQ['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($listeningSCQ['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$listeningSCQ['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>

    </div>
</form>

