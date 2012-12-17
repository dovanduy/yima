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
                <th>Thông Tin Chi Tiết</th>
               

                <th></th>
                </thead>
                <tbody>
                    <?php if (count($finish) < 1): ?>
                        <tr>
                            <td colspan="5" style="text-align: center">Chưa có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($finish as $k => $v): ?>

                        <tr>
                            <td class="align-left">
                                <a title="<?php echo $v['ref_type'] ?>" rel="tooltip" href="<?php //echo Yii::app()->request->baseUrl."/test/view/s/".$v['slug'];       ?>"><?php echo Helper::string_truncate($v['ref_type'], 50); ?></a><br/>
                                
                                       
                                        </td>

                                        <td class="align-left">
                                            <strong>Ngày:</strong> <span class="label"><?php echo date('d-m-Y H:i:s', $v['date_added']); ?></span>
                                        </td>
                                        <td><a href="<?php echo Yii::app()->baseUrl ?>/toefl/finished/id/<?php echo $v['id'] ?>/part/<?php echo $v['type'] ?>" class="btn btn-warning">Chi tiết</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                    </table>
                                    <?php //$this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
                                    </div>
                                    </div>
                                    </section>