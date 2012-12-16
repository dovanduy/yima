<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/index/part/<?php echo $part ?>">Listening 0<?php echo $part ?></a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listeningSCQ/index/lid/<?php echo $lid ?>/part/<?php echo $part ?>">SCQ</a> <span class="divider">/</span> </li>
    <li class="active">Add Listening</li>
</ul>
<hr/>
<legend>Add Listening SCQ</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">

    <legend>Title</legend>
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <input type="hidden" value ="<?php echo $part ?>" name="part"/>

    <div class="control-group">
        <label class="control-label">Question's Sound</label>
        <div class="controls">
            <input type="file"  name="sound_1">
        </div>
    </div>


    <div class="control-group">
        <label class="control-label">Choice 1</label>
        <input type="radio" name="choice" value="1"/>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice1" >
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <input type="radio" name="choice" value="2"/>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice2" >
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 3</label>
        <input type="radio" name="choice" value="3"/>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice3" >
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 4</label>
        <input type="radio" name="choice" value="4"/>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="choice4" >
        </div>
    </div>

    <legend>Replay Listening Audio</legend>
    <div class="control-group">
        <label class="control-label">Replay</label>
        <div class="controls">
            <input type="checkbox" name="replay" value="1"/>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">From</label>

        <div class="controls">
            <input type="text" class="input-xxlarge" name="from" /> second(s)
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">To</label>

        <div class="controls">
            <input type="text" class="input-xxlarge" name="to" /> second(s)
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file" name="sound_2"/>
        </div>
    </div>

    <legend>Replay Sentence Audio</legend>
    <div class="control-group">
        <label class="control-label">Replay</label>
        <div class="controls">
            <input type="checkbox" name="sentence" value="1"/>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Sound</label>
        <div class="controls">
            <input type="file" name="sound_3"/>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

