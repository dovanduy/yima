<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/4u/post/">Posts</a> <span class="divider">/</span> </li>
    <li class="active">All</li>
</ul>
<hr/>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center class">
    <thead>
        <tr>          
            <th style="width:30%">Title</th>
            <th style="width:25%">Author</th>
            <th>Subject & School</th>
            <th class="row-action"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($posts) < 1): ?>
            <tr>
                <td colspan="5" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($posts as $c): ?>
            <tr>
                <td style="text-align: left;">
                    <a class="link" rel="tooltip" title="<?php echo $c['title']; ?>" href="<?php echo Yii::app()->request->baseUrl . "/4u/post/edit/id/" . $c['id']; ?>"><?php echo Helper::string_truncate($c['title'],50) ?></a><br/>
                    Date Added: <span class="label label-info"><?php echo date('d-m-Y H:i:s'); ?></span><br/>
                    Like: <a href="#" class="label label-success"><?php echo $c['total_like'] ?></a><br/>
                    Comment: <a href="<?php echo Yii::app()->request->baseUrl; ?>/comment/?rid=<?php echo $c['id'] ?>" class="label label-success"><?php echo $c['total_comment'] ?></a>
                    
                </td>    
                <td style="text-align: left">
                    <a class="link" title="<?php echo $c['email']; ?>" href="<?php echo Yii::app()->request->baseUrl . "/user/edit/id/".$c['author_id'] ?>"><?php echo $c['email']; ?></a>
                    <br/>
                    <?php echo $c['lastname']." ".$c['firstname']; ?>
                </td>
                <td style="text-align: left;">
                    <strong>Subject: </strong><a class="link" rel="tooltip" title="<?php echo $c['subject_name']; ?>" href="<?php echo Yii::app()->request->baseUrl . "/subject/edit/id/" . $c['subject_id']; ?>"><?php echo Helper::string_truncate($c['subject_name'],30) ?></a><br/>
                    <strong>School: </strong><a class="link" rel="tooltip" title="<?php echo $c['organization_name']; ?>" href="<?php echo Yii::app()->request->baseUrl . "/organization/edit/id/" . $c['organization_id']; ?>"><?php echo Helper::string_truncate($c['organization_name'],30) ?></a>
                </td>    
                
                <td>
                    <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/4u/post/edit/id/" . $c['id']; ?>">Edit</a>
                    <a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/4u/post/delete/id/" . $c['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>