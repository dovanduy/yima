<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/subject/mod/">Subject Mods</a> <span class="divider">/</span> </li>
    <li class="active">All</li>
</ul>
<hr/>
<form class="form-inline" action="<?php echo Yii::app()->request->baseUrl; ?>/subject/add_mod/" method="post">
  <input type="hidden" name="user_id" value=""/>
  <input autocomplete="off" type="text" class="input-medium" name="email" placeholder="Email" id="search_mod">
  <select class="input-large" name="subject_id">
      <option value="0">-- Choose subject --</option>
      <?php foreach($subjects as $v): ?>
      <option value="<?php echo $v['id'] ?>"><?php echo $v['title'] ?></option>
      <?php endforeach;?>
  </select>
  <button type="submit" class="btn btn-primary">Add Mod</button>
</form>

<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<table class="table table-bordered table-striped table-center class">
    <thead>
        <tr>          
            <th>Subject</th>
            <th>User</th>
            <th class="row-date">Date added</th>
            <th class="row-edit"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($mods) < 1): ?>
            <tr>
                <td colspan="4" class="align-center">No record</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($mods as $s): ?>
            <tr>
                <td class="align-left"><a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/subject/edit/id/<?php echo $s['subject_id'] ?>"><?php echo $s['subject_name'] ?></a></td>
                <td class="align-left">
                    <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/user/edit/id/<?php echo $s['user_id'] ?>"><?php echo $s['email'] ?></a><br/>
                    <?php echo $s['lastname']. " " . $s['firstname']; ?>
                </td>
                <td><?php echo date('d-m-Y H:i:s',$s['date_added']); ?></td>
                <td>
                    <a class="btn btn-small btn-danger delete-row" href="<?php echo Yii::app()->request->baseUrl . "/subject/delete_mod/sid/$s[subject_id]/uid/$s[user_id]/"; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>