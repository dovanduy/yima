<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening">Listening</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/edit/id/<?php echo $listening['id']; ?>"><?php echo $listening['title']; ?></a> <span class="divider">/</span> </li>
    <li>Video<span class="divider">/</span> </li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening_video/add/lid/<?php echo $listening['id']; ?>" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<legend><?php echo $listening['title']; ?></legend>
<table class="table table-bordered table-striped table-center listening">
    <thead>
        <tr>          
            <?php /*  <th class="row-img"></th> */ ?>
            <th width="43%">Question</th>
            <th width="12%">Status</th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($videos) < 1): ?>
            <tr>
                <td colspan="9" class="align-center">No record found</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($videos as $v): ?>
            <tr>
                <?php /* <td><img width="50" class="img-polaroid" src="<?php echo HelperApp::get_thumbnail($v['limg'], 'small') ?>" /></td> */ ?>
                <td style="text-align: left;"><a href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening_video/edit/id/" . $v['id']; ?>"><?php echo $v['title'] ?></a></td>        
                <?php if ($v['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($v['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($v['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>
                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening_video/edit/id/" . $v['id']; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening_video/delete/id/" . $v['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>