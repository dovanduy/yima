<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/card/">Cards</a> <span class="divider">/</span> </li>
    <li class="active">All</li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/card/add/" class="btn btn-primary pull-left">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center class">
    <thead>
        <tr>          
            <th style="width:25%">Title</th>
            <th>Card Types</th>
            <th class="row-date">Date Add</th>
            <th class="row-date">Date Exp</th>            
            <th class="row-action"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($cards) < 1): ?>
            <tr>
                <td colspan="5" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($cards as $s): ?>
            <tr>
                <td class="align-left">
                    <a href="<?php echo Yii::app()->request->baseUrl . "/card/edit/id/" . $s['id']; ?>"><?php echo $s['title'] ?></a>
                    <?php if($s['is_sold']): ?>
                    <span class="label label-info">Sold</span>
                    <?php endif;?>
                    <?php if($s['is_used']): ?>
                    <span class="label label-success">Used</span>
                    <?php endif;?>
                    <?php if(!$s['is_used'] && $s['date_expired'] < time()): ?>
                    <span class="label label-important">Expired</span>
                    <?php endif;?>
                    
                    <?php if($s['is_used']): ?>
                    <br/><a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/user/edit/id/<?php echo $s['user_id']; ?>" title="<?php echo $s['email'] ?>"><?php echo Helper::string_truncate($s['email']); ?></a>
                    <?php endif;?>
                </td>  
                <td>
                    Name: <?php echo $s['card_type_name'] ?><br/>
                    Amount: <?php echo number_format($s['amount']); ?>đ
                </td>                
                <td><?php echo date('d-m-Y', $s['date_added']); ?></td>  
                <td><?php echo date('d-m-Y', $s['date_expired']); ?></td>  

                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/card/edit/id/" . $s['id']; ?>">Edit</a>
                    <a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/card/delete/id/" . $s['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>