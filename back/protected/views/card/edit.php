<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/card/">Cards</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $card['title'] ?></li>
</ul>
<hr/>
<legend>Edit Card: <?php echo $card['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-large" name="title" disabled="" value="<?php echo $card['title'] ?>">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Type</label>
        <div class="controls">
            <select class="input-large" name="type">
                <?php foreach($types as $v): ?>
                <option <?php if(isset($_POST['type']) && $_POST['type'] == $v['id']) echo 'selected';else if($card['card_type_id'] == $v['id']) echo 'selected'; ?> value="<?php echo $v['id'] ?>"><?php echo $v['title'] ?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Date expired</label>
        <div class="controls">
            <input type="text" class="input-large datetimepicker" name="date_expired" value="<?php if (isset($_POST['date_expired'])) echo $_POST['date_expired'];else echo date('d-m-Y',  $card['date_expired']); ?>">
        </div>
    </div>
    
    <legend>Is sold</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="is_sold" value="1" <?php if ($card['is_sold']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="is_sold" value="0" <?php if (!$card['is_sold']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>
    
    <legend>Is used</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="is_used" value="1" <?php if ($card['is_used']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="is_used" value="0" <?php if (!$card['is_used']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($card['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$card['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

