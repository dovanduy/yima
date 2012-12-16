<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/card/">Cards</a> <span class="divider">/</span> </li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Coupon Code</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Type</label>
        <div class="controls">
            <select class="input-large" name="type">
                <?php foreach ($types as $v): ?>
                    <option value="<?php echo $v['id'] ?>"><?php echo $v['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Quantity</label>
        <div class="controls">
            <input type="text" class="input-large" name="quantity" value="<?php if (isset($_POST['quantity'])) echo $_POST['quantity'];else echo 1; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Date expired</label>
        <div class="controls">
            <input type="text" class="input-large datetimepicker" name="date_expired" value="<?php if (isset($_POST['date_expired'])) echo $_POST['date_expired']; ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Is sold</label>
        <div class="controls radio-question">
            <label class="radio">
                <input type="radio" name="is_sold" id="optionsRadios1" value="1" <?php if(isset($_POST['is_sold']) && $_POST['is_sold']) echo 'checked'; ?> checked>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="is_sold" id="optionsRadios1" value="0" <?php if(isset($_POST['is_sold']) && !$_POST['is_sold']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

