<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/keyword_searching_test/">Keyword List</a> <span class="divider">/</span> </li>
    <li>All</li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/keyword_searching_test/add/" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center keyword_searching_test">
    <thead>
        <tr>         
            <th width="25%">Category</th>
            <th width="25%">Owner</th>
            <th width="12%">Featured</th>
            <th width="12%">Status</th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($keywords) < 1): ?>
            <tr>
                <td colspan="5" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($keywords as $k): ?>
            <tr>
                <td style="text-align: left;"><a href="<?php echo Yii::app()->request->baseUrl . "/keyword_searching_test/edit/id/" . $k['id']; ?>"><?php echo $k['keyword_subject'] ?></a></td>  
                <td style="text-align: left;"><a href="<?php echo Yii::app()->request->baseUrl . "/keyword_searching_test/edit/id/" . $k['id']; ?>"><?php echo $k['keyword_owner'] ?></a></td>  
                <?php if ($k['featured']): ?>
                    <td style="text-align: center;">  <input type="checkbox" name="featured" href="<?php echo Yii::app()->request->baseUrl ?>/keyword_searching_test/set_featured/id/<?php echo $k['id']; ?>/featured/0" class="featured" checked></td>
                <?php else: ?>
                    <td style="text-align: center;">  <input type="checkbox" name="featured" href="<?php echo Yii::app()->request->baseUrl ?>/keyword_searching_test/set_featured/id/<?php echo $k['id']; ?>/featured/1" class="featured"  ></td>
                <?php endif; ?>

                <?php if ($k['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($k['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($k['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>


                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/keyword_searching_test/edit/id/" . $k['id']; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/keyword_searching_test/delete/id/" . $k['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>