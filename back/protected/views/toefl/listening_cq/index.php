<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening">Listening</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/edit/id/<?php echo $listening['id']; ?>"><?php echo $listening['title']; ?></a> <span class="divider">/</span> </li>
    <li>CQ<span class="divider">/</span> </li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening_cq/add/lid/<?php echo $listening['id']; ?>" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<legend><?php echo $listening['title']; ?></legend>
<table class="table table-bordered table-striped table-center listening">
    <thead>
        <tr>          
            <th width="43%">Question</th>
            <th width="12%">Status</th>
            <th class="row-edit"></th>
            <th class="row-edit"></th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($cqs) < 1): ?>
            <tr>
                <td colspan="6" class="align-center">No record found</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($cqs as $c): ?>
            <tr>
                <?php /* <td><img width="50" class="img-polaroid" src="<?php echo HelperApp::get_thumbnail($c['limg'], 'small') ?>" /></td> */ ?>
                <td style="text-align: left;"><?php echo $c['title'] ?></td>        
                <?php if ($c['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($c['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($c['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>
                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening_cq/configure_score/question_id/" . $c['id'] . "/lid/" . $listening['id']; ?>">Configure Score</a></td>
                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening_cq/manage/question_id/" . $c['id'] . "/lid/" . $listening['id']; ?>">Manage</a></td>
                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening_cq/edit/id/" . $c['id']; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening_cq/delete/id/" . $c['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>