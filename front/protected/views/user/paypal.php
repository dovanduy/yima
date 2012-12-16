<table class="table table-striped table-bordered">
    <thead>
    <th>#ID</th>
    <th style="text-align: left">Thông tin</th>
    <th>Ngày nạp</th>
    <th style="text-align: left">Số tiền</th>
</thead>
<tbody>
    
    <?php if(count($transactions) < 1): ?>
    <tr>
        <td colspan="4">Không có kết quả nào</td>
    </tr>
    <?php endif;?>
    
    <?php foreach ($transactions as $v): ?>
        <?php
        $ids = unserialize($v['card_ids']);
        $info = unserialize($v['card_info']);
        ?>
        <tr>
            <td>#<?php echo $v['id'] ?></td>
            <td style="text-align: left">
                <?php foreach($ids as $ik=>$iv): ?>
                <?php echo $info[$ik]['description'].": "; ?> <span class="label label-info"><?php echo $iv; ?></span> - <?php echo number_format($info[$ik]['amount']). "đ/1" ?><br/>
                <?php endforeach;?>
            </td>
            <td><?php echo date('d-m-Y H:i:s', $v['date_added']); ?></td>
            <td style="text-align: left">
                VNĐ: <span class="label label-success"><?php echo number_format($v['amount_vnd']); ?>đ</span><br/>
                <?php echo $v['currency'] ?>: <span class="label label-important">$<?php echo number_format($v['amount'],2) ?></span>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>