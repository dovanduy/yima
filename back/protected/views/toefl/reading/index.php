<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/index/?part=<?php echo $part ?>">Reading 0<?php echo $part ?></a> <span class="divider">/</span> </li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/add/part/<?php echo $part ?>" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center reading">
    <thead>
        <tr>          
            <th width="43%">Title</th>
            <th width="5%">SCQ</th>
            <th width="5%">MCQ</th>
            <th width="5%">IQ</th>
            <th width="5%">DDQ</th>
            <th width="5%">OQ</th>
            <th width="12%">Status</th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($readings) < 1): ?>
            <tr>
                <td colspan="4" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($readings as $g): ?>
            <tr>
                <td style="text-align: left;"><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/reading/edit/id/" . $g['id']; ?>"><?php echo $g['title'] ?></a></td>    
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingSCQ/index/?part=" . $part . "&rid=" . $g['id']; ?>">SCQ</a></td> 
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingMCQ/index/?part=" . $part . "&rid=" . $g['id']; ?>">MCQ</a></td> 
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingIQ/index/?part=" . $part . "&rid=" . $g['id']; ?>">IQ</a></td> 
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingDDQ/index/?part=" . $part . "&rid=" . $g['id']; ?>">DDQ</a></td> 
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/readingOQ/index/?part=" . $part . "&rid=" . $g['id']; ?>">OQ</a></td> 
                <?php if ($g['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($g['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($g['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>
                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/toefl/reading/edit/id/" . $g['id']; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/toefl/reading/delete/id/" . $g['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>