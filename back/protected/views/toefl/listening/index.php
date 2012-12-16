<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/">Listening List</a> <span class="divider">/</span> </li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/add/part/<?php echo $part?>/" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center listening">
    <thead>
        <tr>          
            <th width="43%">Title</th>
            <th width="5%">Video</th>
            <th width="5%">SCQ</th>
            <th width="5%">MCQ</th>
            <th width="5%">CQ</th>
            <th width="5%">OQ</th>
            <th width="12%">Status</th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($listenings) < 1): ?>
            <tr>
                <td colspan="9" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($listenings as $l): ?>
            <tr>
                <td style="text-align: left;">
                    <a href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening/edit/id/" . $l['id']; ?>"><?php echo $l['title'] ?></a><br/>
                    <strong>Video:</strong> <?php if (!$l['count_video']) echo 0; else echo $l['count_video']; ?></a> -
                    <strong>SCQ:</strong> <?php if (!$l['count_scq']) echo 0; else echo $l['count_scq']; ?></a> -
                    <strong>MCQ:</strong> <?php if (!$l['count_mcq']) echo 0; else echo $l['count_mcq']; ?></a> -
                    <strong>CQ:</strong> <?php if (!$l['count_cq']) echo 0; else echo $l['count_cq']; ?></a> -
                    <strong>OQ:</strong> <?php if (!$l['count_oq']) echo 0; else echo $l['count_oq']; ?></a>
                </td>    
                <td><a class="type-quest" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening_video/index/lid/" . $l['id']; ?>">Video</a></td>
                <td><a class="type-quest" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listeningSCQ/index/lid/" . $l['id'] . "/part/" . $part; ?>">SCQ</a></td>
                <td><a class="type-quest" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listeningMCQ/index/lid/" . $l['id'] . "/part/" . $part; ?>">MCQ</a></td>
                <td><a class="type-quest" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening_cq/index/lid/" . $l['id']; ?>">CQ</a></td>
                <td><a class="type-quest" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening_oq/index/lid/" . $l['id']; ?>">OQ</a></td>
                <?php if ($l['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($l['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($l['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>
                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening/edit/id/" . $l['id']; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/toefl/listening/delete/id/" . $l['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>