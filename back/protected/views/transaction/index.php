<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/transaction/">Transactions</a> <span class="divider">/</span> </li>
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
            <th style="width:20%">Description</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($transactions) < 1): ?>
            <tr>
                <td colspan="6" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php $time = 0; ?>
        <?php foreach ($transactions as $k => $v): ?>
            <?php if ($k == 0 || $time != date('d-m-Y', $v['date_added'])): ?>
                <?php $time = date('d-m-Y', $v['date_added']); ?>
                <tr>
                    <td colspan="6" class="align-left"><strong><?php echo $time; ?></strong></td>
                </tr>
            <?php endif; ?>
            <tr>

                <td>#<?php echo $v['id']; ?></td>
                <td><?php echo date('H:i', $v['date_added']); ?></td>    
                <td class="align-left">
                    <?php if ($v['ref_type'] == "card"): ?>
                        <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/card/edit/id/<?php echo $v['ref_id']; ?>"><?php echo $v['card_code'] ?></a>
                        <span class="label label-success"><?php echo $v['ref_type'] ?></span>
                    <?php elseif ($v['ref_type'] == "coupon"): ?>
                        <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/coupon/edit/id/<?php echo $v['ref_id']; ?>"><?php echo $v['coupon_code'] ?></a>
                        <span class="label label-warning"><?php echo $v['ref_type'] ?></span>
                    <?php elseif ($v['ref_type'] == "buy_nt_test"): ?>
                        <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/edit/id/<?php echo $v['ref_id']; ?>"><?php echo $v['test_title'] ?></a>
                        <span class="label"><?php echo $v['ref_type'] ?></span>
                    <?php endif; ?>
                </td>
                <td class="align-left">
                    <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/user/edit/id/<?php echo $v['user_id'] ?>"><?php echo $v['email'] ?></a><br/>
                    <?php echo $v['lastname'] . " " . $v['firstname']; ?>
                </td>
                <td><span class="label <?php echo $v['amount'] > 0 ? "label-info" : "label-important"; ?>"><?php echo number_format($v['amount']); ?>đ</span></td>

                <td><?php echo $v['description'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>