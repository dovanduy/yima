<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>

    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/index/?part=<?php echo $part ?>">Reading 0<?php echo $part ?></a> <span class="divider">/</span> </li>

    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $reading['title'] ?></li>
</ul>
<hr/>
<legend>Edit Reading OQ: <?php echo $reading['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Question</label>
        <div class="controls">

            <input type="text" name="title" class="input-xxlarge" value="<?php echo $readingOQ['title']; ?>">

        </div>
    </div>



    <div class="control-group">
        <label class="control-label">Choice 1</label>


        <div class="controls">
            <input type="text" name="choice1" class="input-xxlarge" value="<?php echo $readingOQ['choice1']; ?>" >


        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 2</label>
        <div class="controls">
            <input type="text" name="choice2" class="input-xxlarge" value="<?php echo $readingOQ['choice2']; ?>" >

        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 3</label>


        <div class="controls">
            <input type="text" name="choice3" class="input-xxlarge" value="<?php echo $readingOQ['choice3']; ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Choice 4</label>


        <div class="controls">
            <input type="text" name="choice4" class="input-xxlarge" value="<?php echo $readingOQ['choice4']; ?>">

        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Reading Text</label>
        <div class="controls">

            <textarea name="content" rows="5" class="input-xxlarge tinymce"><?php echo $readingOQ['content']; ?></textarea>

        </div>
    </div>

    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$readingOQ['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($readingOQ['disabled']) echo 'checked'; ?>>
                Disabled
            </label>

        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($readingOQ['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$readingOQ['deleted']) echo 'checked'; ?>>
                No
            </label>

        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

