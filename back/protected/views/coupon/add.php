<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/coupon/">Coupon Codes</a> <span class="divider">/</span> </li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Coupon Code</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Amount</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="money" value="<?php if (isset($_POST['money'])) echo $_POST['money']; ?>">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Quantity</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="quantity" value="<?php if (isset($_POST['quantity'])) echo $_POST['quantity'];else echo 1; ?>">
        </div>
    </div>
    
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

