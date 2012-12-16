<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/">Admin</a> <span class="divider">/</span> </li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/add/" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center">
    <thead>
        <tr>
            <th width="5%">#</th>            
            <th width="23%">Username</th>
            <th width="20%">Date Join</th>
            <th width="20%">Role</th>
            <th width="12%">Status</th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($admins) < 1): ?>
            <tr>
                <td colspan="7" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($admins as $v): ?>
            <tr>
                <td><?php echo $v['id'] ?></td>
                <td><a href="#"><?php echo $v['title'] ?></a></td>
                <td><?php echo date("d-m-Y", $v['date_added']); ?></td>
                <td><?php echo $v['role'] ?></td>
                <?php if ($v['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($v['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span> &nbsp; <?php if ($v['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/admin/edit/id/" . $v['id']; ?>" class="btn btn-small">Edit</a></td>
                <td><a href="<?php echo Yii::app()->request->baseUrl . "/admin/delete/id/" . $v['id']; ?>" class="btn btn-small btn-danger delete-row">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>