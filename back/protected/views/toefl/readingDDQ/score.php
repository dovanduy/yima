<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/index/?part=<?php echo $part ?>">Reading 0<?php echo $part ?></a> <span class="divider">/</span> </li>
    <li>DDQ </li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/readingDDQ/add_score/rddq_id/<?php echo $rddq_id ?>/part/<?php echo $part ?>" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center reading">
    <thead>
        <tr>          
            <th>Number of Right Choice</th>            
            <th>Score</th>
            <th class="row-edit"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($rddq_score) < 1): ?>
            <tr>
                <td colspan="6" class="align-center">No record found</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($rddq_score as $g): ?>
            <tr>
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingDDQ/edit/id/" . $g['id']; ?>"><?php echo $g['rightchoices'] ?></a></td>
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingDDQ/edit/id/" . $g['id']; ?>"><?php echo $g['score'] ?></a></td>

                <?php if ($g['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($g['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($g['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>

                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingDDQ/edit_score/id/" . $g['id'] . "/?part=" . $part; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingDDQ/delete/id/" . $g['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>