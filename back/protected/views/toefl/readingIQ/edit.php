<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/index/?part=<?php echo $part ?>">Reading 0<?php echo $part ?></a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $reading['title'] ?></li>
</ul>
<hr/>
<legend>Edit Reading IQ: <?php echo $reading['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">
            <input type="text" name="title" value="<?php echo $readingIQ['title'] ?>">
        </div>
    </div>
    <div class="control-group">

        <div class="controls">
            <input type="radio" name="choice" value="1" <?php if ($readingIQ['answer'] == 1) echo "checked" ?>/> Position 1
            <input type="radio" name="choice" value="2" <?php if ($readingIQ['answer'] == 2) echo "checked" ?>/> Position 2
            <input type="radio" name="choice" value="3" <?php if ($readingIQ['answer'] == 3) echo "checked" ?>/> Position 3
            <input type="radio" name="choice" value="4" <?php if ($readingIQ['answer'] == 4) echo "checked" ?>/> Position 4
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
            <textarea name="content" rows="5" class="input-xxlarge tinymce"><?php echo $readingIQ['content'] ?></textarea>
        </div>
    </div>

    <legend>Status</legend>
    <div class="control-group">

        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$readingIQ['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($readingIQ['disabled']) echo 'checked'; ?>>
                Disabled
            </label>

        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">

        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($readingIQ['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$readingIQ['deleted']) echo 'checked'; ?>>
                No
            </label>

        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

