<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening/">TOEIC Listening</a></li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening/add/" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>


<table class="table table-bordered table-striped table-center listening">
    <thead>
        <tr>          
            <th width="30%">Title</th>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="12%">Status</th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($listenings) < 1): ?>
            <tr>
                <td colspan="8" listening="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($listenings as $l): ?>
            <tr>  
                <td style="text-align: left;"><a href="<?php echo Yii::app()->request->baseUrl . "/toeic/listening/edit/id/" . $l['id']; ?>"><?php echo $l['title'] ?></a></td>    
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toeic/listening_part1/index/lid/" . $l['id']; ?>">Part 1</a></td> 
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toeic/listening_part2/index/lid/" . $l['id']; ?>">Part 2</a></td> 
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toeic/listening_part3/index/lid/" . $l['id']; ?>">Part 3</a></td> 
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toeic/listening_part4/index/lid/" . $l['id']; ?>">Part 4</a></td> 
                <?php if ($l['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($l['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($l['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>
                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/toeic/listening/edit/id/" . $l['id']; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/toeic/listening/delete/id/" . $l['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>