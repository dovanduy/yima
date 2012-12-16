<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/tracking/">Trackings</a> <span class="divider">/</span> </li>
    <li class="active">All</li>
</ul>
<hr/>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center user">
    <thead>
        <tr>
            <th class="row-id">#</th>
            <th class="row-edit">Time</th>
            <th>Type</th>
            <th>User</th>
            <th>Amount</th>
            <th>Card info</th>
            <th>Total</th>
            <th>Ip</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($trackings) < 1): ?>
            <tr>
                <td colspan="8" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php $time =  0; ?>
        <?php foreach ($trackings as $k=>$v): ?>
            <?php if($k == 0 || $time != date('d-m-Y',$v['date_added'])): ?>
            <?php $time = date('d-m-Y',$v['date_added']); ?>
            <tr>
                <td colspan="8" class="align-left"><strong><?php echo $time; ?></strong></td>
            </tr>
            <?php endif;?>
            <tr>
                <td>#<?php echo $v['id'] ?></td>
                <td><?php echo date('H:i',$v['date_added']); ?></td>     
                <td>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/paypal/"><?php echo $v['payment_type']; ?></a>
                    <?php if($v['completed']): ?>
                    <span class="label label-success">Completed</span>
                    <?php endif;?>
                </td>
                <td class="align-left">
                    <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/user/edit/id/<?php echo $v['user_id'] ?>"><?php echo $v['email'] ?></a><br/>
                    <?php echo $v['lastname']. " ".$v['firstname']; ?>
                </td>
                <td class="align-left">
                    VNĐ: <span class="label label-info"><?php echo number_format($v['amount_vnd']); ?>đ</span><br/>
                    USD: <span class="label label-important">$<?php echo number_format($v['amount'],2); ?></span>                    
                </td>
                <td class="align-left">
                    <?php 
                    $total_card = 0;
                    $card_ids = unserialize($v['card_ids']);
                    $card_info = unserialize($v['card_info']);
                    ?>
                    <?php foreach($card_ids as $ck=>$cv): ?>
                    <?php echo $card_info[$ck]['description'].": "; ?><span class="label label-warning"><?php echo $cv; ?></span><br/>
                    <?php $total_card+= $cv; ?>
                    <?php endforeach;?>
                </td>
                <td>
                    <?php if($v['completed']): ?>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/card/?tid=<?php echo $v['id']; ?>" class="link"><?php echo $total_card; ?></a>
                    <?php endif;?>
                </td>
                <td><?php echo $v['user_ip'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>