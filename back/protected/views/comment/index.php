<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/comment/index/type/<?php echo $type; ?>/">Comments</a> <span class="divider">/</span> </li>
    <li class="active"><?php echo $type; ?> <span class="divider">/</span> </li>
    <li class="active">All</li>
</ul>
<hr/>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center class">
    <thead>
        <tr>          
            <th style="width:30%">Post</th>
            <th>Content</th>
            <th>Like</th>
            <th class="row-date">Date Added</th>            
            <th class="row-action"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($comments) < 1): ?>
            <tr>
                <td colspan="5" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($comments as $c): ?>
            <tr>
                <td style="text-align: left;">
                    <?php if($c['ref_type'] == "post"): ?>
                    <a class="link" title="<?php echo $c['post_title']; ?>" href="<?php echo Yii::app()->request->baseUrl . "/4u/post/edit/id/" . $c['ref_id']; ?>"><?php echo Helper::string_truncate($c['post_title'],50) ?></a><br/>
                    <?php elseif($c['ref_type'] == "test_nt"): ?>
                    <a class="link" title="<?php echo $c['test_nt_title']; ?>" href="<?php echo Yii::app()->request->baseUrl . "/testNT/edit/id/" . $c['ref_id']; ?>"><?php echo Helper::string_truncate($c['test_nt_title'],50) ?></a><br/>
                    <?php endif;?>
                    Author: <a class="label" title="<?php echo $c['email']; ?>" href="<?php echo Yii::app()->request->baseUrl . "/user/edit/id/".$c['author_id'] ?>"><?php echo $c['email']; ?></a>
                </td>    
                
                <td class="align-left"><?php echo Helper::string_truncate($c['content'],130); ?></td>
                <td><?php echo (int)$c['total_like'] ?></td>
                <td>
                    <?php echo date('d-m-Y H:i:s',$c['date_added']); ?>
                </td>    
                
                <td>
                    <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/comment/edit/type/$type/id/" . $c['id']; ?>">Edit</a>
                    <a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/comment/delete/type/$type/id/" . $c['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>