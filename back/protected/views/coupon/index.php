<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/coupon/">Coupon Codes</a> <span class="divider">/</span> </li>
    <li class="active">All</li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/coupon/add/" class="btn btn-primary pull-left">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center class">
    <thead>
        <tr>          
            <th>Title</th>
            <th>Money</th>
            <th class="row-edit">Users</th>
            <th class="row-datetime">Date Added</th>            
            <th class="row-action"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($coupons) < 1): ?>
            <tr>
                <td colspan="4" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($coupons as $s): ?>
            <tr>
                <td><a class=link href="<?php echo Yii::app()->request->baseUrl . "/coupon/edit/id/" . $s['id']; ?>"><?php echo $s['title'] ?></a></td>  
                <td><span class="label label-info"><?php echo number_format($s['amount']); ?>đ</span></td>
                <td><a class=link href="#"><?php echo (int) $s['total'] ?></a></td>
                <td><?php echo date('d-m-Y H:i:s', $s['date_added']); ?></td>  

                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/coupon/edit/id/" . $s['id']; ?>">Edit</a>
                    <a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/coupon/delete/id/" . $s['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>