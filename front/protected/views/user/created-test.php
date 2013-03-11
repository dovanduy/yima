<?php $this->renderPartial('sidebar', array()); ?>
<section class="search span9">
    <div id="user-info">
        <div class="head">
            <legend>Bài kiểm tra của tôi</legend>
        </div>
        <div class="">
            <table class="table table-striped table-bordered table-center mytest">
                <thead>
                <th style="width:10%">&nbsp;</th>                    
                <th style="width:30%">Tên</th>                    
                <th style="width:30%">Trường / Khoa</th>
                <th style="width:12%">Giá</th>
                <th style="width:18%" class="row-action"></th>
                </thead>
                <tbody>
                    <?php if (count($tests) < 1): ?>
                        <tr>
                            <td colspan="5" style="text-align: center">Chưa có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($tests as $k => $v): ?>
                        <tr>
                            <td class="align-left">
                                YIMA-<?php echo Helper::_parse_id($v['id']); ?>
                            </td>
                            <td class="align-left">
                                <a title="<?php echo $v['title'] ?>" rel="tooltip" href="<?php echo Yii::app()->request->baseUrl . "/test/view/s/" . $v['slug']; ?>"><?php echo Helper::string_truncate($v['title'], 50); ?></a><br/>
                                <strong>Loại:</strong> <?php echo $v['section_title']; ?><br/>
                                <strong>Chủ đề</strong>: <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_category/c/<?php echo $v['subject_id']; ?>" rel="tooltip" title="<?php echo $v['subject_title'] ?>"><?php echo Helper::string_truncate($v['subject_title'], 50); ?></a><br/>
                            </td>

                            <td class="align-left">
                                Trường: <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_organization/org/<?php echo $v['organization_id']; ?>" rel="tooltip" title="<?php echo $v['org_title'] ?>"><?php echo Helper::string_truncate($v['org_title'], 50); ?></a><br/>
                                <?php if ($v['faculty_id']): ?>
                                    Khoa: <a href="#" rel="tooltip" title="<?php echo $v['faculty_name'] ?>"><?php echo Helper::string_truncate($v['faculty_name'], 50); ?></a><br/>
                                <?php endif; ?>
                                
                            </td>
                            <td>
                                <?php if ($v['price'] == 0) echo '<span class="label label-success">miễn phí</span>'; else echo '<span class="label label-info">' . number_format($v['price'], 0, '.', '.') . ' đ</span>'; ?>                            </td>
                            <td>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/create_test/edit/id/<?php echo $v['id'] ?>" class="btn">Sửa</a>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/delete/id/<?php echo $v['id'] ?>" class="btn btn-danger delete-test">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
        </div>
    </div>
</section>