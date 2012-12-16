<?php $this->renderPartial('nav',array('testnt'=>$testnt,'type'=>$type)); ?>

<p><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/add_question/id/<?php echo $testnt['id'] ?>" class="btn btn-primary">Add Question</a></p>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
<?php echo Helper::print_success($message); ?>
<table class="table table-bordered table-striped table-center">
    <thead>
        <tr>
            <th class="align-left">Câu hỏi</th>
            <th class="row-date">Ngày</th>
            <th class="row-action"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($questions) < 1): ?>
            <tr>
                <td colspan="3">No records</td>
            </tr>
        <?php endif; ?>

        <?php foreach ($questions as $v): ?>
            <tr>
                <td class="align-left"><a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/question/edit/id/<?php echo $v['id']; ?>"><?php echo $v['question']; ?></a></td>
                <td><?php echo date('d-m-Y H:i:s', $v['date_added']); ?></td>
                <td>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/question/edit/id/<?php echo $v['id'] ?>" class="btn btn-small">Edit</a>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/question/delete/id/<?php echo $v['id'] ?>" class="btn btn-danger btn-small delete-row">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
