<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/card/type/">Card Types</a> <span class="divider">/</span> </li>
    <li class="active">All</li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/card/add_type/" class="btn btn-primary pull-left">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center class">
    <thead>
        <tr>          
            <th>Title</th>
            <th>Description</th>
            <th>Amount</th>
            <th class="row-date">Date added</th>
            <th class="row-action"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($types) < 1): ?>
            <tr>
                <td colspan="5" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($types as $s): ?>
            <tr>
                <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/card/edit_type/id/<?php echo $s['id'] ?>"><?php echo $s['title'] ?></a></td>
                <td><?php echo $s['description'] ?></td>
                <td><?php echo number_format($s['amount']); ?></td>
                <td><?php echo date('d-m-Y H:i:s',$s['date_added']); ?></td>
                <td>
                    <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/card/edit_type/id/$s[id]/"; ?>">Edit</a>
                    <a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/subject/delete_type/id/$s[id]/"; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>