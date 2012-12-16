<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/report/index/type/<?php echo $type; ?>/">Reports</a> <span class="divider">/</span> </li>
    <li class="active"><?php echo $type; ?> <span class="divider">/</span> </li>
    <li class="active">All</li>
</ul>
<hr/>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center class">
    <thead>
        <tr>          
            <th>Reporter</th>
            <th>Report type</th>
            <th class="row-date">Date Added</th>            
            <th class="row-action" style="width:14%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($reports) < 1): ?>
            <tr>
                <td colspan="4" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($reports as $c): ?>
            <tr>               
                
                <td class="align-left">                    
                    <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/user/edit/id/<?php echo $c['author_id'] ?>"><?php echo $c['email'] ?></a><br/>
                    <?php echo $c['lastname']." ".$c['firstname'] ?>
                </td>
                <td><?php echo $c['ref_type'] ?></td>
                <td>
                    <?php echo date('d-m-Y H:i:s',$c['date_added']); ?>
                </td>    
                
                <td>
                    <?php if($c['ref_type'] == "post"): ?>
                    <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/4u/post/edit/id/" . $c['ref_id']; ?>">View</a>
                    <?php elseif($c['ref_type'] == "test_nt"): ?>
                    <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/testNT/edit/id/" . $c['ref_id']; ?>">View</a>
                    <?php endif;?>
                    <a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/report/delete/id/" . $c['ref_id']."/type/$c[ref_type]/author/$c[author_id]"; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>