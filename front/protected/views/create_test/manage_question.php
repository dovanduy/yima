<p><a href="<?php echo Yii::app()->request->baseUrl."/create_test/add_question/id/$test[id]" ?>" class="btn btn-primary">Thêm câu hỏi</a></p>

<table class="table table-center table-bordered table-striped">
    <thead>
        <th class="align-left">Câu hỏi</th>
        <th>Loại</th>
        <th>Ngày tạo</th>
        <th class="row-action"></th>
    </thead>
<tbody>
    <?php if(count($questions) < 1): ?>
    <tr>
        <td colspan="4">Chưa có câu hỏi nào.</td>
    </tr>
    <?php endif;?>
    
    <?php foreach($questions as $k=>$v): ?>
    <tr>
        <td class="align-left"><a href="<?php echo Yii::app()->request->baseUrl."/create_test/question/id/$v[id]" ?>"><?php echo $v['question'] ?></a></td>
        <td><?php echo $v['question_type']; ?></td>
        <td><?php echo date('d-m-Y H:i:s',$v['date_added']); ?></td>
        <td>
            <a href="<?php echo Yii::app()->request->baseUrl."/create_test/question/id/$v[id]" ?>" class="btn">Sửa</a>
            <a href="<?php echo Yii::app()->request->baseUrl."/create_test/delete_question/id/$v[id]"; ?>" class="btn btn-danger delete-row">Xóa</a>
        </td>
    </tr>
    <?php endforeach;?>
</tbody>
</table>