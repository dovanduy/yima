<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/subject/">Subject List</a> <span class="divider">/</span> </li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/subject/add/" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center class">
    <thead>
        <tr>          
            <th width="68%">Title</th>
            <th width="12%">Priority</th>
            <th width="12%">Status</th>
            <th width="12%">Search</th>
            <th width="12%">Featured</th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($subjects) < 1): ?>
            <tr>
                <td colspan="4" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($subjects as $s): ?>
            <tr>
                <td style="text-align: left;"><a href="<?php echo Yii::app()->request->baseUrl . "/subject/edit/id/" . $s['id']; ?>"><?php echo $s['title'] ?></a></td>    
                <td style="text-align: left;"><?php echo $s['priority'] ?></td>  
                <?php if ($s['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($s['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($s['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>
                <td style="text-align: center;"><input type="checkbox" value="<?php echo $s['search'] ?>" <?php if ($s['search'] != 0) echo "checked" ?> 
                                                       onchange="changeSubSearch(<?php echo $s['id'] ?>)" id="search_<?php echo $s['id'] ?>"
                                                       linkSearch="<?php echo Yii::app()->request->baseUrl . "/subject/editSearch/id/" . $s['id'] . "/search/" . $s['search']; ?>"
                                                       ></td> 
                <td style="text-align: center;"><input type="checkbox" value="<?php echo $s['featured'] ?>" <?php if ($s['featured'] != 0) echo "checked" ?> 
                                                       onchange="changeSubFeatured(<?php echo $s['id'] ?>)" id="featured_<?php echo $s['id'] ?>"
                                                       linkFeatured="<?php echo Yii::app()->request->baseUrl . "/subject/editFeatured/id/" . $s['id'] . "/featured/" . $s['featured']; ?>"
                                                       ></td>
                    
                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/subject/edit/id/" . $s['id']; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/subject/delete/id/" . $s['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>