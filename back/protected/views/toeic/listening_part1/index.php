<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening/">TOEIC Listening</a><span class="divider">/</span></li>
    <li><?php echo $listening['title']; ?><span class="divider">/</span></li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening_part1/index/lid/<?php echo $listening['id']; ?>">Part 1</a><span class="divider">/</span></li>
    <li class="active">All</li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/listening_part1/add/lid/<?php echo $listening['id']; ?>" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center listening">
    <thead>
        <tr>          
            <th width="48%">Title</th>
            <th width="12%">Image</th>
            <th width="12%">Status</th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($listening_part1) < 1): ?>
            <tr>
                <td colspan="5" listening="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($listening_part1 as $l): ?>
            <tr>  
                <td style="text-align: left;"><?php echo $l['title'] ?></td>    
                <td><img width="50" class="img-polaroid" src="<?php echo HelperApp::get_thumbnail($l['thumbnail'], 'small') ?>" /></td>   
                <?php if ($l['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($l['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($l['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>
                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/toeic/listening_part1/edit/lid/" . $listening['id'] . "/id/" . $l['id']; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/toeic/listening_part1/delete/lid/" . $listening['id'] . "/id/" . $l['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>