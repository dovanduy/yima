<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/">Organization List</a> <span class="divider">/</span> </li>
    <li class="active" ><?php echo $organization['title'] ?><span class="divider">/</span></li>
     <li class="active">Subject </li>
   
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/add_sub/id/<?php echo $organization['id']?>" class="btn btn-primary pull-right">Add Subject</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center class">
    <thead>
        <tr>          
            <th width="68%">Title</th>
           
            <th width="12%">Status</th>
    
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($organization_subject) < 1): ?>
            <tr>
                <td colspan="4" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($organization_subject as $s): ?>
            <tr>
                <td style="text-align: left;"><?php echo $s['subject_title'] ?></td>    
  
                <?php if ($s['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($s['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($s['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>
          


                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/organization/edit_sub/id/" . $s['os_id']; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/subject/delete/id/" . $s['os_id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>