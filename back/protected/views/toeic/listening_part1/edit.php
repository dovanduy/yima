<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening/">TOEIC Listening</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening_part1/index/lid/<?php echo $listening_part1['lid']; ?>">TOEIC Listening Part 1</a> <span class="divider">/</span> </li>
    <li class="active">Edit</li>
</ul>
<hr/>
<legend>Edit: <?php echo $listening_part1['title']?></legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php echo $listening_part1['title'] ?>">
        </div>
    </div>
    <?php if ($listening_part1['img'] != ""): ?>
        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <img src="<?php echo HelperApp::get_thumbnail($listening_part1['thumbnail'],'full') ?>" alt="" />
            </div>
        </div>
    <?php endif; ?>
    <div class="control-group">
        <label class="control-label">Image</label>
        <div class="controls">
            <input type="file"  name="image">
        </div>
    </div>


    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file"  name="sound">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <embed type="application/x-shockwave-flash" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" quality="best" flashvars="audioUrl=<?php echo HelperApp::get_audio($listening_part1['lsound']); ?>" width="545" height="22"></embed>
        </div>
    </div>
   
        
    <div class="control-group">
        <label class="control-label">Answer</label>
        <div class="controls">
            <select  class="input-xxlarge" name="answer">
                <option value="0">--- Select Answer ---</option>
                <option <?php if ($listening_part1['answer'] == 1) echo "selected" ?> value="1">A</option>
                <option value="2" <?php if ($listening_part1['answer'] == 2) echo "selected" ?>>B</option>
                <option value="3" <?php if ($listening_part1['answer'] == 3) echo "selected" ?>>C</option>
                <option value="4" <?php if ($listening_part1['answer'] == 4) echo "selected" ?>>D</option>
            </select>
        </div>
    </div>
    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$listening_part1['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($listening_part1['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($listening_part1['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$listening_part1['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

