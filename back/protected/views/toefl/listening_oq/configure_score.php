<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/">Listening</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/edit/id/<?php echo $listening['id']; ?>"><?php echo $listening['title']; ?></a> <span class="divider">/</span> </li>
    <li><?php echo $question['title']; ?><span class="divider">/</span></li>
    <li>Configure Score<span class="divider"></span> </li>
</ul>
<hr/>
<p><div class="btn btn-primary configure-score">Add New Score</div></p>
<div class="add-new-score" style="display: none;">
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="control-group">
            <div class="control-label">Number of Right Choice</div>
            <div class="controls">
                <input type="text"  name="right_choice">
            </div>
        </div>
        <div class="control-group">
            <div class="control-label">Score</div>
            <div class="controls">
                <input type="text" name="score">
            </div>
        </div>
        <div class="form-actions">        
            <a href="" class="btn">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>
<table class="table table-bordered table-striped table-center listening">
    <thead>
        <tr>          
            <th>Number of Right Choice</th>
            <th>Score</th>
            <th class="row-edit"></th>
            <th class="row-edit"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 1; $i < 5; $i++) {
            ;
            ?>
            <tr>
                <td><?php echo $i; ?></td>        
                <td><?php if (isset($choices[$i])) echo $choices[$i]; else echo '0'; ?></td>        
                <td><a class="btn btn-small configure-score" href="#">Edit</a></td>
                <?php if (isset($score_id[$i]) && isset($choices[$i]) && $choices[$i] > 0): ?>
                    <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening_oq/delete_score/score_id/" . $score_id[$i]; ?>">Delete</a></td>
                <?php else: ?>
                    <td><a class="btn btn-small btn-danger delete-row" href="">Delete</a></td>
                <?php endif; ?>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php
//$this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>