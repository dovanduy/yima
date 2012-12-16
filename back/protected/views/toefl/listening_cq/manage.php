<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening">Listening</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening/edit/id/<?php echo $listening['id']; ?>"><?php echo $listening['title']; ?></a> <span class="divider">/</span> </li>
    <li class="active">CQ<span class="divider">/</span> </li>
    <li class="active">Manage<span class="divider">/</span> </li>
</ul>
<hr/>
<legend>Manage</legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>


<table class="table table-bordered table-striped table-center listening-manage">
    <thead>
        <tr>          
            <th style="width:300px;"></th>
            <?php foreach ($columns as $c): ?>
                <th class="row-edit"><?php echo $c['title']; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $r): ?>
            <tr id="row-<?php echo $r['id'] ?>">
                <td><?php echo $r['title']; ?></td>
                <?php foreach ($columns as $c): ?>
                    <td> <input type="radio" name="disabled[<?php echo $r['id'] ?>]" value="1" <?php if ($r['col'] == $c['id']) echo 'checked'; ?>></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div>
    <div class="span6 cq-rows">
        <form class=" add-new-row" method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening_cq/addrow">
            <div class="control-group">
                <div class="controls title-row">
                    <input type="text" name="title_row">
                </div>
                <div class="controls">
                    <input type="hidden" name="question_id"value="<?php echo $cq['id']; ?>">
                </div>
            </div>
            <div class="">  
                <button class="btn update-row" style="display:none;">Update</button>
                <button type="submit" class="btn btn-primary">Add Row</button>
            </div>
        </form>

        <?php foreach ($rows as $r): ?>
            <form class="form-horizontal row-content clearfix">
                <div class="control-group">
                    <div class="content"><?php echo $r['title'] ?></div>
                </div>
                <div class="control-group pull-right">
                    <button class="btn btn-danger">Delete</button>
                    <button class="btn edit-row" id="edit_row_<?php echo $r['id']; ?>">Edit</button>
                </div>
            </form>
        <?php endforeach; ?>
    </div>
    <div class="span6">
        <form class=" add-new-col" method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->request->baseUrl; ?>/toefl/listening_cq/addcolumn">
            <div class="control-group">
                <div class="controls">
                    <input type="text" name="title_column">
                </div>
                <div class="controls">
                    <input type="hidden" name="question_id"value="<?php echo $cq['id']; ?>">
                </div>
            </div>
            <div class="">        
                <button type="submit" class="btn btn-primary">Add Column</button>
            </div>
        </form>
    </div>
</div>