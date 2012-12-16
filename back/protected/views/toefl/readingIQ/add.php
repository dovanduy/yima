<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/index/?part=<?php echo $part ?>">Reading 0<?php echo $part ?></a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/readingIQ/index/?rid=<?php echo $rid ?>&part=<?php echo $part ?>">IQ</a> <span class="divider">/</span> </li>
    <li class="active">Add Reading</li>
</ul>
<hr/>
<legend>Add Reading IQ</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" name="title" class="input-xxlarge" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>">
        </div>
    </div>
    <div class="control-group">

        <div class="controls">
            <input type="radio" name="choice" value="1"/> Position 1
            <input type="radio" name="choice" value="2"/> Position 2
            <input type="radio" name="choice" value="3"/> Position 3
            <input type="radio" name="choice" value="4"/> Position 4
        </div>
    </div>


    <div class="control-group">
        <div class="controls">
            Click <button class="insert_box btn btn-danger" type="button" onclick="insert_box()">Insert</button> to put code <span style="font-weight: bold; background: #ccc;">[box]</span>
            in place you want to insert sentence
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Reading Text</label>
        <div class="controls">
            <textarea name="content" rows="5" class=" input-xxlarge tinymce"><?php echo $reading['content'] ?></textarea>
        </div>
    </div>


    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

