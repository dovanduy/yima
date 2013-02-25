<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/4u/crawl_post/">Crawl Posts</a> <span class="divider">/</span> </li>
    <li class="active">Post</li>

</ul>
<hr/>

<legend>Crawl Post</legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data" id="crawl-post">   

    <div class="control-group">
        <label class="control-label">Category</label>
        <div class="controls">
            <select class="span11 category-id" name="category_id">                
                <?php foreach ($categories as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if (isset($_POST['category_id']) && $_POST['category_id'] == $o['id']) echo 'selected'; ?>><?php echo $o['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">From Page</label>
        <div class="controls">
            <input type="text" class="span11" name="from" value="<?php if (isset($_POST['from'])) echo htmlspecialchars($_POST['from']); ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">To Page</label>
        <div class="controls">
            <input type="text" class="span11" name="to" value="<?php if (isset($_POST['to'])) echo htmlspecialchars($_POST['to']); ?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <a href="<?php echo HelperUrl::baseUrl(); ?>4u/crawl_yahoo/more_detail/" class="btn btn-warning more-detail">More Detail</a>            
            <p class="help-block">Show more detail before Crawl data: Total Records, Total Pages, Total Posts in database</p>
            <div class="more hide">
                <p class="help-block category-name">Category: <strong></strong></p>
                <p class="help-block total-records">Total Records: <span class="label">0</span></p>
                <p class="help-block total-pages">Total Pages: <span class="label">0</span></p>
                <p class="help-block total-posts">Total Posts in database: <span class="label">0</span></p>
            </div>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>