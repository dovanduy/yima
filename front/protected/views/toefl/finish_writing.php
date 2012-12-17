<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">            
            <section class="search span12">                

                <div id="test-nt">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Trang chủ</a> <span class="divider">/</span></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/test/">Bài kiểm tra</a> <span class="divider">/</span></li>
                        <li class="active"><?php echo $finish['title']; ?> <span class="divider">/</span></li>
                        <li class="active">Kết quả</li>
                    </ul>

                    <legend>Kết quả</legend>

                    <?php if (isset($_GET['s']) && $_GET['s']): ?>
                        <div class="alert alert-success">
                            <strong>Chúc mừng!</strong><br/>
                            Bạn đã hoàn thành bài kiểm tra <strong><?php echo $finish['title']; ?></strong>
                        </div>
                    <?php endif; ?>

                    <ul>
                        <li><strong>Bài kiểm tra:</strong> <?php echo $finish['title'] ?></li>
                        <li><strong>Ngày hoàn thành:</strong> <?php echo date('d-m-Y H:i:s', $finish['date_added']); ?></li>                                   
                    </ul>

                    <table style="margin-top: 20px" class="table table-striped table-bordered table-center clearfix">
                        <thead>
                            <tr>
                                <th style="">Writing 1</th>                              
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <?php $information = unserialize($finish['information']);?>
                            <td><?php echo $information['writing1']  ?></td>
                            </tr>
                        </tbody>
                        
                        <thead>
                            <tr>
                                <th style="">Writing 2</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              
                            <td><?php echo $information['writing2']  ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </article>
    </div>
</div>