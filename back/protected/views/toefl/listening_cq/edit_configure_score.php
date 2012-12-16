<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/">Listening</a> <span class="divider">/</span> </li>
    <li>Configure Score<span class="divider"></span> </li>
</ul>
<hr/>
<legend>Edit</legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Number of Right Choice</label>
        <div class="controls">
            <input type="text" name="title"  value="<?php echo $score['rightchoices']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Score</label>
        <div class="controls">
            <input type="text" name="title"  value="<?php echo $score['score']; ?>">
        </div>
    </div>
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

