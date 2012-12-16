<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/">Organizations</a> <span class="divider">/</span> </li>
    <li class="active"><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/edit/id/<?php echo $organization['id'] ?>"><?php echo $organization['title']; ?></a> <span class="divider">/</span> </li>
    <li class="active">Group </li>
</ul>
<hr/>
<legend>Add group</legend>
<?php echo Helper::print_success($message); ?>
<form class="form-inline" action="" method="post">
    <select class="span4" name="faculty">
        <option value="0">-- Faculty --</option>
        <?php foreach ($faculties as $k => $v): ?>
            <option value="<?php echo $v['id']; ?>"><?php echo $v['title'] ?></option>
        <?php endforeach; ?>
    </select>
    <select class="span4" name="subject">
        <option value="0">-- Subject --</option>
        <?php foreach ($subjects as $k => $v): ?>
            <option value="<?php echo $v['id']; ?>"><?php echo $v['title'] ?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" name="sub_number" placeholder="Subject number" class="input-large" />
    <button type="submit" class="btn btn-primary">Add group</button>
</form>

<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center organization">
    <thead>
        <tr>         
            <th>Faculty</th>
            <th>Subject</th>
            <th class="row-edit"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($groups) < 1): ?>
            <tr>
                <td colspan="3" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($groups as $v): ?>
            <tr>
                <td><a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/faculty/edit/id/<?php echo $v['faculty_id']; ?>"><?php echo $v['faculty_title'] ?></a></td>
                <td><a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/subject/edit/id/<?php echo $v['subject_id']; ?>"><?php echo $v['subject_title'] ?></a></td>
                <td>
                    <a class="btn btn-danger btn-small delete-row" href="<?php echo Yii::app()->request->baseUrl; ?>/organization/delete_group/id/<?php echo $v['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>