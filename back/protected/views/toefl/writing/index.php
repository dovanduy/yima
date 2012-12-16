<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/writing/">Writing List</a> <span class="divider">/</span> </li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/writing/add/part/<?php echo $part ?>" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center writing">
    <thead>
        <tr>          
            <th width="43%">Title</th>
            <th width="12%">Status</th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($writings) < 1): ?>
            <tr>
                <td colspan="4" class="align-center">No record found</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($writings as $g): ?>
            <tr>
                <td style="text-align: left;"><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/writing/edit/id/" . $g['id'] . "/part/" . $part; ?>"><?php echo $g['title'] ?></a></td>    
                <?php if ($g['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($g['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($g['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>
                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/toefl/writing/edit/id/" . $g['id'] . "/part/" . $part;
            ; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/toefl/writing/delete/id/" . $g['id']; ?>">Delete</a></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>