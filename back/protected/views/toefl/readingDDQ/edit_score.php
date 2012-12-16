<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/index/?part=<?php echo $part ?>">Reading 0<?php echo $part ?></a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $reading['title'] ?></li>
</ul>
<hr/>
<legend>Edit Reading DDQ: <?php echo $reading['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Number of Right Choice</label>
        <div class="controls">
            <input type="text" name="title" value="<?php echo $rddq_score['rightchoices']; ?>">
        </div>
    </div>
    <input type="hidden" value ="<?php echo $part ?>" name="part"/>

    <div class="control-group">
        <label class="control-label">Score</label>
        <div class="controls">
            <input type="text" name="score" value="<?php echo $rddq_score['score']; ?>">
        </div>
    </div>

    <legend></legend>
    <div class="control-group">
        <label class="control-label">Status</label>
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($rddq_score['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$rddq_score['disabled']) echo 'checked' ?>>
                Active
            </label>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Delete</label>
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$rddq_score['deleted']) echo 'checked'; ?>>
                No
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($rddq_score['deleted']) echo 'checked'; ?>>
                Yes
            </label>
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Edit</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

