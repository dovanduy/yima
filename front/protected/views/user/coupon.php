<table class="table table-striped table-bordered">
    <thead>
    <th>#ID</th>
    <th>Mã thẻ</th>
    <th>Ngày giao dịch</th>
    <th>Số tiền</th>
</thead>
<tbody>
    <?php if(count($transactions) < 1): ?>
    <tr>
        <td colspan="4">Không có kết quả nào</td>
    </tr>
    <?php endif;?>
    
    <?php foreach ($transactions as $v): ?>
        <tr>
            <td>#<?php echo $v['id'] ?></td>
            <td><?php echo $v['card_code'] ?></td>
            <td><?php echo date('d-m-Y H:i:s', $v['date_added']); ?></td>
            <td style="text-align: right">
                <span class="label label-<?php echo $v['amount'] > 0 ? "success" : "important" ?>"><?php echo $v['amount'] > 0 ? "+" . number_format($v['amount']) : number_format($v['amount']); ?>đ</span>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>