<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/card/type/">Card types</a> <span class="divider">/</span> </li>
    <li class="active">Add</li>
</ul>
<hr/>
<legend>Add Coupon Code</legend>

<?php echo Helper::print_error($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php if (isset($_POST['title'])) echo htmlspecialchars ($_POST['title']); ?>">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Description</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="description" value="<?php if (isset($_POST['description'])) echo htmlspecialchars ($_POST['description']); ?>">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Amount</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="amount" value="<?php if (isset($_POST['amount'])) echo $_POST['amount']; ?>">
        </div>
    </div>
    
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

