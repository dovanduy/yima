<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>    
    <li class="active">Change Password</li>
</ul>
<hr/>
<legend>Change Password</legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post">
    <div class="control-group">
        <label class="control-label">Old Password</label>
        <div class="controls">
            <input type="password" name="oldpwd" value="" />
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">New Password</label>
        <div class="controls">
            <input type="password" name="newpwd1" value="" />
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Confirm New Password</label>
        <div class="controls">
            <input type="password" name="newpwd2" value="" />
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

