<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">            


            <section class="search span12">                

                <div id="test-nt">
                   
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">    

                        <?php foreach ($questions as $k => $q): ?>    
                        <?php $question_max = $questions[max(array_keys($questions))];?>
                            <div class="test question_<?php echo $q['id'] ?> clearfix" style="<?php if ($k == 0) echo 'display:block'; ?>">

                                <div class="btn-test">
                                    <a class="btn btn-success review pull-left review" value="<?php echo $question_max['id']?>">Duyệt lại</a>
                                    <?php if ($k > 0): ?><a class="btn back" value="<?php echo $q['id'] ?>" href="#" >&laquo; Quay lại</a><?php endif; ?>
                                    <?php if ($k < $total - 1): ?> <a style="margin-left: 15px" class="btn btn-primary next" value="<?php echo $q['id'] ?>" href="#">Tiếp tục &raquo;</a> <?php endif; ?>
                                </div>
                                <div class="row-fluid">
                                    <legend><?php echo $q['question'] ?></legend>
                                    <input type="hidden" value="<?php echo $q['id'] ?>" name="quest_<?php echo $q['id'] ?>">
                                    <ul class="choice">
                                        <?php for ($i = 1; $i < 5; $i++): ?>
                                            <li><input class="choice_status" va="<?php echo $q['id'] ?>" type="radio" name="choice_<?php echo $q['id'] ?>" value="<?php echo $i; ?>" style="margin-top: -3px"> <?php echo $q['answer']['choice_' . $i]; ?></li>
                                        <?php endfor; ?>

                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>


                        <div class="list-result clearfix" style="">
                            <legend>Danh sách các câu trả lời</legend>
                            <table class="table table-bordered table-striped table-center class">
                                <thead>
                                    <tr>          
                                        <th width="68%">Câu hỏi</th>

                                        <th width="12%">Đã trả lời</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
                                    <?php foreach ($questions as $k => $q): ?>
                                        <tr>
                                            <td><?php echo $q['question'] ?></td>
                                            <td class="status_<?php echo $q['id'] ?>" ><i class=" icon-remove"></i></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="submit clearfix">         
                             <a class="btn pull-right review-back hide pull-left">&laquo; Quay lại</a>
                           
                           
                            <input onclick="return confirm('Bạn có chắc hoàn tất bài thi này?');" class="btn hide btn-danger submit-test" type="submit" value="Hoàn tất">
                   
                        </div>
                    </form>
                </div>
            </section>
        </article>
    </div>
</div>