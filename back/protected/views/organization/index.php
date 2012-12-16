<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/">Organization List</a> <span class="divider">/</span> </li>
</ul>
<hr/>
<p class="clearfix"><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/add/" class="btn btn-primary pull-right">Add New</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center organization">
    <thead>
        <tr>         
            <th width="58%">Title</th>
            <th width="20%">Grade</th>
            <th width="12%">Priority</th>
            <th width="12%">Status</th>
            <th width="12%">Search</th>
            <th width="12%">Featured</th>
            <th width="15%">Add Group</th>
            <th width="10%"></th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($organizations) < 1): ?>
            <tr>
                <td colspan="5" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($organizations as $sc): ?>
            <tr>
                <td style="text-align: left;"><a href="<?php echo Yii::app()->request->baseUrl . "/organization/edit/id/" . $sc['id']; ?>"><?php echo $sc['title'] ?></a></td>  
                <td style="text-align: left;"><a href="<?php echo Yii::app()->request->baseUrl . "/grade/edit/id/" . $sc['id']; ?>"><?php echo $sc['grade_title'] ?></a></td>
                <td style="text-align: left;"><?php echo $sc['priority'] ?></td>  
                <?php if ($sc['disabled']): ?>
                    <td><span class="label btn-inverse"> Disabled</span>&nbsp; <?php if ($sc['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php else: ?>
                    <td><span class="label btn-primary"> Active </span>&nbsp; <?php if ($sc['deleted']): ?><span class="label btn-warning"> Deleted</span><?php endif; ?></td>
                <?php endif; ?>
                <td style="text-align: center;"><input type="checkbox" value="<?php echo $sc['search'] ?>" <?php if ($sc['search'] != 0) echo "checked" ?> 
                                                       onchange="changeOrgSearch(<?php echo $sc['id'] ?>)" id="search_<?php echo $sc['id'] ?>"
                                                       linkSearch="<?php echo Yii::app()->request->baseUrl . "/organization/editSearch/id/" . $sc['id'] . "/search/" . $sc['search']; ?>"
                                                       ></td>  
                <td style="text-align: center;"><input type="checkbox" value="<?php echo $sc['featured'] ?>" <?php if ($sc['featured'] != 0) echo "checked" ?> 
                                                       onchange="changeFeatured(<?php echo $sc['id'] ?>)" id="featured_<?php echo $sc['id'] ?>"
                                                       linkFeatured="<?php echo Yii::app()->request->baseUrl . "/organization/editFeatured/id/" . $sc['id'] . "/featured/" . $sc['featured']; ?>"
                                                       ></td>
                <td><a class="btn btn-info btn-small" href="<?php echo Yii::app()->request->baseUrl . "/organization/group/id/" . $sc['id']; ?>">Group</a></td>
                <td><a class="btn btn-small" href="<?php echo Yii::app()->request->baseUrl . "/organization/edit/id/" . $sc['id']; ?>">Edit</a></td>
                <td><a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/organization/delete/id/" . $sc['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>