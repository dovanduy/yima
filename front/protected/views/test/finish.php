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
                    
                    <?php if(isset($_GET['s']) && $_GET['s']): ?>
                    <div class="alert alert-success">
                        <strong>Chúc mừng!</strong><br/>
                        Bạn đã hoàn thành bài kiểm tra <strong><?php echo $finish['title']; ?></strong>
                    </div>
                    <?php endif;?>

                    <ul>
                        <li><strong>Bài kiểm tra:</strong> <?php echo $finish['title'] ?></li>
                        <li><strong>Ngày hoàn thành:</strong> <?php echo date('d-m-Y H:i:s', $finish['date_added']); ?></li>
                        <li><strong>Câu hỏi:</strong> <span class="label label-info"><?php echo $finish['total_question']; ?></span> câu</li>
                        <li><strong>Trả lời đúng:</strong> <span class="label label-success"><?php echo $finish['total_right'] ?></span> câu</li>                        
                    </ul>

                    <table style="margin-top: 20px" class="table table-striped table-bordered table-center clearfix">
                        
                        <tbody>
                            <tr>
                                <th style="width:40%">Câu hỏi</th>
                                <th style="width:10%">KQ</th>
                                <th style="width:40%">Câu hỏi</th>
                                <th style="width:10%">KQ</th>
                            </tr>
                            <?php
                            $information = unserialize($finish['information']);
                            $questions = array_values($information['right_choices']);
                            $user_choices = $information['user_choices'];
                            $ceil = ceil(count($questions) / 2);
                            ?>

                            <?php for ($i = 0; $i < $ceil; $i++): ?>
                                <?php
                                $q1 = $questions[$i * 2];
                                $q2 = isset($questions[($i * 2) + 1]) ? $questions[($i * 2) + 1] : null;
                                
                                ?>
                               
                                <tr>
                                    <td class="align-left"><?php echo $q1['title']; ?></td>
                                    <td><i class="<?php echo $q1['choice'] == $user_choices[$q1['id']] ? "icon-ok" : "icon-remove"; ?>"></i></td>
                                    <?php if ($q2): ?>
                                        <td class="align-left"><?php echo $q2['title']; ?></td>
                                        <td><i class="<?php echo $q2['choice'] == $user_choices[$q2['id']] ? "icon-ok" : "icon-remove"; ?>"></i></td>
                                    <?php else: ?>
                                        <td colspan="2"></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </article>
    </div>
</div>