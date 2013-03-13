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
                        <li><strong>Câu hỏi:</strong> <span class="label label-info"><?php echo $finish['total_question']; ?></span> câu</li>
                        <li><strong>Trả lời đúng:</strong> <span class="label label-success"><?php echo $finish['total_right'] ?></span> câu</li>                        
                    </ul>

                    <table style="margin-top: 20px" class="table table-striped table-bordered table-center clearfix">
                        <thead>
                            <tr>
                                <th style="width:40%">Câu hỏi</th>
                                <th style="width:10%">KQ</th>
                                <th style="width:40%">Câu hỏi</th>
                                <th style="width:10%">KQ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $information = unserialize($finish['information']);
                            $questions = array_values($information['right_choices']['scq']);
                            //$question_scq = array_values($questions['scq']);

                            $user_choices = $information['user_choices']['scq'];
                            $ceil = ceil(count($questions) / 2);
                            //print_r($user_choices);die;
                            ?>

                            <?php for ($i = 0; $i < $ceil; $i++): ?>
                                <?php
                                $q1 = $questions[$i * 2];
                                $q2 = isset($questions[($i * 2) + 1]) ? $questions[($i * 2) + 1] : null;
                                //print_r($q1);die;
                                ?>

                                <tr>
                                    <td class="align-left"><?php echo $q1['title']; ?></td>
                                    <td><i class="<?php echo $q1['answer'] == $user_choices[$q1['id']] ? "icon-ok" : "icon-remove"; ?>"></i></td>
                                    <?php if ($q2): ?>
                                        <td class="align-left"><?php echo $q2['title']; ?></td>
                                        <td><i class="<?php echo $q2['answer'] == $user_choices[$q2['id']] ? "icon-ok" : "icon-remove"; ?>"></i></td>
                                    <?php else: ?>
                                        <td colspan="2"></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endfor; ?>

                            <?php
                            $questions_mcq = array_values($information['right_choices']['mcq']);
                            $user_choices_mcq = $information['user_choices']['mcq'];
                            $ceil_mcq = ceil(count($questions_mcq) / 2);
                            //print_r(count($questions_mcq));die;
                            ?>

                            <?php for ($i = 0; $i < $ceil_mcq; $i++): ?>
                                <?php
                                $q1_mcq = $questions_mcq[$i * 2];
                                $q2_mcq = isset($questions_mcq[($i * 2) + 1]) ? $questions_mcq[($i * 2) + 1] : null;
                                if ($q1_mcq['title'] != ""):
                                    ?>

                                    <tr>
                                        <td class="align-left"><?php echo $q1_mcq['title']; ?></td>
                                        <td><i class="<?php echo $q1_mcq['answer'] == $user_choices_mcq[$q1_mcq['id']] ? "icon-ok" : "icon-remove"; ?>"></i></td>
                                        <?php if ($q2_mcq): ?>
                                            <td class="align-left"><?php echo $q2_mcq['title']; ?></td>
                                            <td><i class="<?php echo $q2_mcq['answer'] == $user_choices_mcq[$q2_mcq['id']] ? "icon-ok" : "icon-remove"; ?>"></i></td>
                                        <?php else: ?>
                                            <td colspan="2"></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php
                            $questions_iq = array_values($information['right_choices']['iq']);
                            $user_choices_iq = $information['user_choices']['iq'];
                            $ceil_iq = ceil(count($questions_iq) / 2);
                            //print_r(count($questions_mcq));die;
                            ?>

                            <?php for ($i = 0; $i < $ceil_iq; $i++): ?>
                                <?php
                                $q1_iq = $questions_iq[$i * 2];
                                $q2_iq = isset($questions_iq[($i * 2) + 1]) ? $questions_iq[($i * 2) + 1] : null;
                                if ($q1_iq['title'] != ""):
                                    ?>

                                    <tr>
                                        <td class="align-left"><?php echo $q1_iq['title']; ?></td>
                                        <td><i class="<?php echo $q1_iq['answer'] == $user_choices_iq[$q1_iq['id']] ? "icon-ok" : "icon-remove"; ?>"></i></td>
                                        <?php if ($q2_iq): ?>
                                            <td class="align-left"><?php echo $q2_iq['title']; ?></td>
                                            <td><i class="<?php echo $q2_iq['answer'] == $user_choices_iq[$q2_iq['id']] ? "icon-ok" : "icon-remove"; ?>"></i></td>
                                        <?php else: ?>
                                            <td colspan="2"></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php
                            $questions_ddq = array_values($information['right_choices']['ddq']);
                            $user_choices_ddq = $information['user_choices']['ddq'];
                            $ceil_ddq = ceil(count($questions_ddq) / 2);
                           // print_r(count($questions_ddq));die;
                            //print_r(count($questions_mcq));die;
                            ?>

                            <?php for ($i = 0; $i < $ceil_ddq; $i++): ?>
                                <?php
                                $q1_ddq = $questions_ddq[$i * 2];
                                $q2_ddq = isset($questions_ddq[($i * 2) + 1]) ? $questions_ddq[($i * 2) + 1] : null;
                                if ($q1_ddq['sub_title'] != ""):
                                    ?>

                                    <tr>
                                        <td class="align-left"><?php echo $q1_ddq['sub_title']; ?></td>
                                        <td><i class="<?php echo $q1_ddq['ans_id'] == $user_choices_ddq[$q1_ddq['ans_id']] ? "icon-ok" : "icon-remove"; ?>"></i></td>
                                        <?php if ($q2_ddq): ?>
                                            <td class="align-left"><?php echo $q2_ddq['sub_title']; ?></td>
                                            <td><i class="<?php echo $q2_ddq['ans_id'] == $user_choices_ddq[$q2_ddq['ans_id']] ? "icon-ok" : "icon-remove"; ?>"></i></td>
                                        <?php else: ?>
                                            <td colspan="2"></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>



                        </tbody>
                    </table>
                </div>
            </section>
        </article>
    </div>
</div>