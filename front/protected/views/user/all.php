<table class="table table-striped table-bordered">
    <thead>
    <th>#ID</th>
    <th>Loại</th>
    <th>Mô tả</th>
    <th>Ngày giao dịch</th>
    <th>Số tiền</th>
</thead>
<tbody>
    <?php foreach ($transactions as $v): ?>
        <tr>
            <td>#<?php echo $v['id'] ?></td>
            <td><?php echo $v['ref_type'] ?></td>
            <td><?php echo $v['description'] ?></td>
            <td><?php echo date('d-m-Y H:i:s', $v['date_added']); ?></td>
            <td style="text-align: right">
                <span class="label label-<?php echo $v['amount'] >= 0 ? "success" : "important" ?>"><?php echo $v['amount'] > 0 ? "+" . number_format($v['amount']) : number_format($v['amount']); ?>đ</span>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>