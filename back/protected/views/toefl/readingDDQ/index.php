<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/index/?part=<?php echo $part ?>">Reading 0<?php echo $part ?></a> <span class="divider">/</span> </li>
    <li>DDQ <span class="divider">/</span> </li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/readingDDQ/add/rid/<?php echo $rid ?>/part/<?php echo $part?>" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center reading">
    <thead>
        <tr>          
            <th width="43%">Question</th>            
            <th  class="row-edit" ></th>
            <th class="row-edit"></th>
            <th class="row-edit" width="12%">Status</th>
            <th class="row-edit" width="10%"></th>
            <th class="row-edit" width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($readingddq) < 1): ?>
            <tr>
                <td colspan="4" class="align-center">No record found</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($readingddq as $g): ?>
            <tr>
                <td style="text-align: left;"><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingDDQ/edit/id/" . $g['id']; ?>"><?php echo $g['title'] ?></a></td>
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingDDQ/score/?part=".$part."&id=" . $g['id']; ?>">Configure Score</a></td>  
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingDDQ/subs/ddq_id/" . $g['id']."/?part=".$part."&rid=".$rid; ?>">Manage</a></td>  
                <?php if ($g['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($g['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($g['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>

                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingDDQ/edit/id/" . $g['id']."/?part=".$part; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingDDQ/delete/id/" . $g['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>