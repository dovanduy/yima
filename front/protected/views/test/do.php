<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">            


            <section class="search span12">                

                <div id="test-nt">

                    <form class="form-horizontal" method="post" enctype="multipart/form-data">    

                        <?php foreach ($questions as $k => $q): ?>    
                            <?php $question_max = $questions[max(array_keys($questions))]; ?>
                            <div class="test question_<?php echo $q['id'] ?> clearfix" style="<?php if ($k == 0) echo 'display:block'; ?>">


                                <div class="row-fluid">                                    
                                    <h4 class="test-heading"><?php echo $q['question'] ?></h4>
                                    <input type="hidden" value="<?php echo $q['id'] ?>" name="quest_<?php echo $q['id'] ?>">
                                    <ul class="choice">
                                        <?php for ($i = 1; $i < 5; $i++): ?>
                                        <li><input class="choice_status" va="<?php echo $q['id'] ?>" type="radio" name="choice_<?php echo $q['id'] ?>" value="<?php echo $i; ?>" style="margin-top: -3px"> &nbsp;&nbsp;&nbsp; <?php echo $q['answer']['choice_' . $i]; ?></li>
                                        <?php endfor; ?>

                                    </ul>

                                    <div class="btn-test">
                                        <a class="btn btn-success review pull-left review" value="<?php echo $question_max['id'] ?>"><i class="icon-tasks icon-white"></i> Duyệt lại</a>
                                        <?php if ($k > 0): ?><a class="btn back" value="<?php echo $q['id'] ?>" href="#" ><i class="icon-arrow-left "></i> Quay lại</a><?php endif; ?>
                                        <?php if ($k < $total - 1): ?> <a class="btn btn-primary next" value="<?php echo $q['id'] ?>" href="#">Tiếp tục <i class="icon-arrow-right icon-white"></i></a> <?php endif; ?>
                                        
                                        <button onclick="return confirm('Bạn có chắc hoàn tất bài thi này?');" class="btn btn-danger submit-test hide" type="submit"><i class="icon-ok icon-white"></i> Hoàn tất</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>


                        <div class="list-result clearfix" style="">
                            <legend class="clearfix">Danh sách các câu trả lời <a class="btn pull-right review-back hide"><i class="icon-arrow-left "></i> Quay lại</a></legend>
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
                            <button onclick="return confirm('Bạn có chắc hoàn tất bài thi này?');" class="btn btn-danger submit-test pull-right hide" type="submit" style="margin-left: 15px;"><i class="icon-ok icon-white"></i> Hoàn tất</button>
                            <a class="btn pull-right review-back hide "><i class="icon-arrow-left "></i> Quay lại</a>
                        </div>
                    </form>
                </div>
            </section>
        </article>
    </div>
</div>