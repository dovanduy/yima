<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/">User List</a> <span class="divider">/</span> </li>
</ul>
<hr/>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center user">
    <thead>
        <tr>          
            <th class="row-img">Thumbnail</th>
            <th>Email</th>       
            <th>Full name</th>
            <th>Amount</th>
            <th class="row-date">Date Added</th>
            <th class="row-action"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($users) < 1): ?>
            <tr>
                <td colspan="6" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($users as $u): ?>
            <tr>
                <td>
                    <a href="<?php echo Yii::app()->request->baseUrl . "/user/overview/id/" . $u['id']; ?>"><img width="50" class="img-polaroid" src="<?php echo HelperApp::get_thumbnail($u['thumbnail'], 'small') ?>" /></a>

                </td>
                <td class="align-left">
                    <a class="link" href="<?php echo Yii::app()->request->baseUrl . "/user/overview/id/" . $u['id']; ?>"><?php echo $u['email'] ?></a>
                    <?php if ($u['deleted']): ?>
                        <span class="label label-important">Suspend</span>
                    <?php endif; ?>
                    <?php if ($u['disabled']): ?>
                        <span class="label">Disabled</span>
                    <?php endif; ?>
                    <br/>

                    Tests created: <span class="label label-success"><?php echo (int) $u['total_test'] ?></span><br/>
                    Posts created: <span class="label label-success"><?php echo (int) $u['total_post'] ?></span><br/>
                    Cards used: <span class="label"><?php echo (int) $u['total_card'] ?></span><br/>
                    Coupons used: <span class="label"><?php echo (int) $u['total_coupon'] ?></span><br/>
                </td>      
                <td class="align-left"><?php echo $u['lastname'] . " " . $u['firstname']; ?></td>
                <td><span class="label label-info"><?php echo number_format($u['amount']); ?>đ</span></td>
                <td><?php echo date('d-m-Y H:i:s', $u['date_added']); ?></td>
                <td>
                    <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/user/edit/id/" . $u['id']; ?>">Edit</a>
                    <a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/user/delete/id/" . $u['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>