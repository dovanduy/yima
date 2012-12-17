<?php $this->renderPartial('sidebar', array()); ?>
<section class="search span9">
    <div id="user-info">
        <div class="head">
            <legend>Bài Toefl đã làm</legend>
        </div>
        <div class="">
            <table class="table table-center table-striped table-bordered">
                <thead>
                <th style="width:30%">Tên</th>                    
                <th>Thông Tin Chi Tiết</th>
                <th>Giá</th>

                <th></th>
                </thead>
                <tbody>
                    <?php if (count($toefl) < 1): ?>
                        <tr>
                            <td colspan="5" style="text-align: center">Chưa có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($toefl as $k => $v): ?>

                        <tr>
                            <td class="align-left">
                                <a title="<?php echo $v['title'] ?>" rel="tooltip" href="<?php //echo Yii::app()->request->baseUrl."/test/view/s/".$v['slug'];        ?>"><?php echo Helper::string_truncate($v['title'], 50); ?></a><br/>

                            </td>

                            <td class="align-left">
                                <strong>Level: <strong><?php echo $v['level'] ?><br/>
                                        <strong>Ngày:</strong> <span class="label"><?php echo date('d-m-Y H:i:s', $v['date_added']); ?></span>
                                        </td>

                                        <td>
                                            <?php // echo !$v['price'] ? '<span class="label label-success">miễn phí</span>' : '<span class="label label-info">' . number_format($v['price'], 0, '.', '.') . ' đ</span>' ?>
                                        </td>

                                        <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/toefl_details/id/<?php echo $v['id'] ?>" class="btn btn-warning">Chi tiết</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                    </table>
                                    <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
                                    </div>
                                    </div>
                                    </section>