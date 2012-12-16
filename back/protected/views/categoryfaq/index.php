<?php $category_types = Helper::category_types(); ?>
<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/categoryfaq/">Category FAQs</a> <span class="divider">/</span> </li>
    <li class="active">All</li>
</ul>
<hr/>
<p><a href="<?php echo Yii::app()->request->baseUrl; ?>/categoryfaq/add/" class="btn btn-primary">Add</a></p>
<br/>
<p>
    <span>Category FAQs:</span>
    <select class="span2 category-type" style="margin: 0">
        <option value="all">All</option>
        <?php foreach (Helper::category_types() as $k => $v): ?>
            <option <?php if ($k == $type) echo 'selected'; ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
        <?php endforeach; ?>
    </select>
</p>

<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center category">
    <thead>
        <tr>          
            <th class="row-img"></th>
            <th>Title</th>
            <th>Category</th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($categories) < 1): ?>
            <tr>
                <td colspan="3" class="align-center">No result</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($categories as $v): ?>
            <tr>
                <td><img width="50" class="img-polaroid" src="<?php echo HelperApp::get_thumbnail($v['thumbnail'], 'small') ?>" /></td>
                <td>
                    <a href="<?php echo Yii::app()->request->baseUrl . "/categoryfaq/edit/id/" . $v['id']; ?>"><?php echo $v['title'] ?></a>
                    <?php if ($v['featured']): ?>
                        <span class="label label-important">Feature</span>
                    <?php endif; ?>
                </td>    
                <td><?php echo $category_types[$v['type']]; ?></td>
                <td>
                    <a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/categoryfaq/edit/id/" . $v['id']; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/categoryfaq/delete/id/" . $v['id']; ?>">Delete</a>
                </td>
                <?php /*
                  <td>
                  <div class="btn-group">
                  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                  Thao tác
                  <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                  <li><a href="<?php echo Yii::app()->request->baseUrl."/categoryfaq/edit/id/".$v['id']; ?>">Sửa</a></li>
                  <li><a class="delete-row" href="<?php echo Yii::app()->request->baseUrl."/categoryfaq/delete/id/".$v['id']; ?>">Xóa</a></li>
                  </ul>
                  </div>
                  </td> */ ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>