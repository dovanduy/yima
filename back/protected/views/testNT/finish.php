<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/">Normal Test</a> <span class="divider">/</span> </li>
    <li>Finished <span class="divider">/</span> All</li>
</ul>
<hr/>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center class">
    <thead>
        <tr>          
            <th width="">Title</th>
            <th>Sub & School</th>
            <th>Completor</th>
            <th class="row-edit">Result</th>
            <th class="row-date">Date</th>
            <th class="row-edit"></th>

        </tr>
    </thead>
    <tbody>
        <?php if (count($testnt) < 1): ?>
            <tr>
                <td colspan="6" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($testnt as $s): ?>
            <tr>
                <td class="align-left">
                    <a class="link" rel="tooltip" title="<?php echo $s['title'] ?>" href="<?php echo Yii::app()->request->baseUrl . "/testNT/edit/id/" . $s['id']; ?>"><?php echo Helper::string_truncate($s['title'], 100); ?></a>
                    <?php if ($s['disabled']): ?>
                        <span class="label label-warning">Disabled</span>
                    <?php endif; ?>

                    <br/>Section: <?php echo $s['section_title']; ?><br/>
                    Author: <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/user/overview/id/<?php echo $s['author_id']; ?>"><?php echo $s['author_title'] ?></a>
                </td>    
                <td class="align-left">
                    School: <a rel="tooltip" title="<?php echo $s['org_title']; ?>" class="link" href=""><?php echo Helper::string_truncate($s['org_title'], 50) ?></a> <br/>
                    Faculty: <a rel="tooltip" title="<?php echo $s['faculty_name']; ?>" class="link" href=""><?php echo Helper::string_truncate($s['faculty_name'], 50) ?></a> <br/>
                    Sub: <a rel="tooltip" title="<?php echo $s['subject_title']; ?>" class="link" href=""><?php echo Helper::string_truncate($s['subject_title'], 50) ?></a>
                </td> 
                <td class="align-left">
                    <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/user/overview/id/<?php echo $s['user_id']; ?>"><?php echo $s['email_completor']; ?></a><br/>
                    <?php echo $s['lastname_completor'] . " " . $s['firstname_completor']; ?>
                </td>


                <td>
                    <span class="label label-success"><?php echo $s['total_right'] . "/" . $s['total_question']; ?></span>
                </td>
                <td><?php echo date('d-m-Y H:i:s', $s['date_completed']); ?></td>
                <td>
                    <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/testNT/view_finished/id/" . $s['relationship_id']; ?>">View</a>                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>