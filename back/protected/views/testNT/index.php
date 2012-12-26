<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/">Normal Test</a> <span class="divider">/</span> </li>
    <li>All</li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/add/" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center class">
    <thead>
        <tr>          
            <th width="">Title</th>
            <th>Sub & School</th>
            <th>Price</th>
            <th class="row-date">Date</th>
            <th class="row-action"></th>

        </tr>
    </thead>
    <tbody>
        <?php if (count($testnt) < 1): ?>
            <tr>
                <td colspan="5" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($testnt as $s): ?>
            <tr>
                <td class="align-left">
                    <a class="link" rel="tooltip" title="<?php echo $s['title'] ?>" href="<?php echo Yii::app()->request->baseUrl . "/testNT/edit/id/" . $s['id']; ?>"><?php echo Helper::string_truncate($s['title'], 100); ?></a>
                    <?php if ($s['disabled']): ?>
                        <span class="label label-warning">Disabled</span>
                    <?php endif; ?>


                    <br/>
                    Comments: <a href="<?php echo Yii::app()->request->baseUrl; ?>/comment/index/type/test_nt/?rid=<?php echo $s['id']; ?>" class="label label-success"><?php echo $s['total_comment']; ?></a>
                    <br/>
                    Questions: <a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/question/id/<?php echo $s['id']; ?>" class="label label-warning"><?php echo (int) $s['total_question']; ?></a>
                    <br/>
                    Images: <a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/image/id/<?php echo $s['id']; ?>" class="label label-info"><?php echo (int) $s['total_image']; ?></a>
                    <br/>
                    Author: <a class="link" href=""><?php echo $s['author_title'] ?></a>
                </td>    
                <td class="align-left">
                    School: <a rel="tooltip" title="<?php echo $s['org_title']; ?>" class="link" href=""><?php echo Helper::string_truncate($s['org_title'], 50) ?></a> <br/>
                    Faculty: <a rel="tooltip" title="<?php echo $s['faculty_name']; ?>" class="link" href=""><?php echo Helper::string_truncate($s['faculty_name'], 50) ?></a> <br/>
                    Sub: <a rel="tooltip" title="<?php echo $s['subject_title']; ?>" class="link" href=""><?php echo Helper::string_truncate($s['subject_title'], 50) ?></a>
                </td>
                <td>
                    <?php if ($s['price'] == 0): ?>
                    <span class="label label-success">Free</span>
                    <?php else: ?>
                        <?php echo number_format($s['price']) . "đ"; ?>
                    <?php endif; ?>
                </td>
                <td><?php echo date('d-m-Y H:i:s', $s['date_added']); ?></td>
                <td>
                    <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/testNT/edit/id/" . $s['id']; ?>">Edit</a>
                    <a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/testNT/delete/id/" . $s['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>