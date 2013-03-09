<?php $this->renderPartial('sidebar', array()); ?>
<section class="search span9">
    <div id="user-info">
        <div class="head">
            <legend>Bài kiểm tra đã làm</legend>
        </div>
        <div class="">
            <table class="table table-center table-striped table-bordered">
                <thead>
                    <th style="width:30%">Tên</th>                    
                    <th>Thông tin khác</th>
                    <th>Giá</th>
                    <th>Đúng</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php if(count($tests) < 1):  ?>
                    <tr>
                        <td colspan="5" style="text-align: center">Chưa có dữ liệu</td>
                    </tr>
                    <?php endif;?>
                    <?php foreach($tests as $k=>$v): ?>
                    <tr>
                        <td class="align-left">
                            <a title="<?php echo $v['title'] ?>" rel="tooltip" href="<?php echo Yii::app()->request->baseUrl."/test/view/s/".$v['slug']; ?>"><?php echo Helper::string_truncate($v['title'],50); ?></a><br/>
                            <strong>Loại:</strong> <?php echo $v['section_title']; ?><br/>
                            <strong>Ngày:</strong> <span class="label"><?php echo date('d-m-Y H:i:s',$v['date_completed']); ?></span>
                        </td>
                        
                        <td class="align-left">
                            Trường: <a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/index/slug/<?php echo $v['organization_slug']; ?>" rel="tooltip" title="<?php echo $v['org_title'] ?>"><?php echo Helper::string_truncate($v['org_title'],50); ?></a><br/>
                            <?php if($v['faculty_id']): ?>
                            Khoa: <a href="#" rel="tooltip" title="<?php echo $v['faculty_name'] ?>"><?php echo Helper::string_truncate($v['faculty_name'],50); ?></a><br/>
                            <?php endif;?>
                            Chủ đề: <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/?cid=<?php echo $v['subject_id']; ?>" rel="tooltip" title="<?php echo $v['subject_title'] ?>"><?php echo Helper::string_truncate($v['subject_title'],50); ?></a><br/>
                        </td>
                        <td>
                            <?php echo !$v['price'] ? '<span class="label label-success">miễn phí</span>' : '<span class="label label-info">' . number_format($v['price'], 0, '.', '.') . ' đ</span>' ?>
                        </td>
                        <td><span class="label label-success"><?php echo $v['total_right'] ?>/<?php echo $v['total_question'] ?></span> câu</td>
                        <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/test/finished/id/<?php echo $v['relationship_id'] ?>" class="btn btn-warning">Chi tiết</a></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
        </div>
    </div>
</section>