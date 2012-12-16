<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/reading/">TOEIC Reading</a></li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/reading/add/" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center reading">
    <thead>
        <tr>          
            <th width="30%">Title</th>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="12%">Status</th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($readings) < 1): ?>
            <tr>
                <td colspan="7" reading="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($readings as $l): ?>
            <tr>  
                <td style="text-align: left;"><a href="<?php echo Yii::app()->request->baseUrl . "/toeic/reading/edit/id/" . $l['id']; ?>"><?php echo $l['title'] ?></a></td>    
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toeic/reading_part5/index/rid/" . $l['id']; ?>">Part 5</a></td> 
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toeic/reading_part6/index/rid/" . $l['id']; ?>">Part 6</a></td> 
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toeic/reading_part7/index/rid/" . $l['id']; ?>">Part 7</a></td> 
                <?php if ($l['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($l['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($l['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>
                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/toeic/reading/edit/id/" . $l['id']; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/toeic/reading/delete/id/" . $l['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>