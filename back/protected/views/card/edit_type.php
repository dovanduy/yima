<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/card/type/">Card Types</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $type['title'] ?></li>
</ul>
<hr/>
<legend>Edit Card Type: <?php echo $type['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" value="<?php if (isset($_POST['title'])) echo htmlspecialchars ($_POST['title']);else echo htmlspecialchars($type['title']) ?>">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Description</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="description" value="<?php if (isset($_POST['description'])) echo htmlspecialchars ($_POST['description']);else echo htmlspecialchars($type['description']); ?>">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Amount</label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="amount" value="<?php if (isset($_POST['amount'])) echo $_POST['amount'];else echo $type['amount'] ?>">
        </div>
    </div>

    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($type['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$type['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

