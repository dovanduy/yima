<div class="span8 magu-listing" id="post">
    <div class="row-fluid">
        <div class="span3 avatar">
            <a class="book-cover books" href="<?php echo Yii::app()->baseUrl ?>/test/view/s/<?php echo $post['slug'] ?>">
                <span class="inner">
                    <?php echo $post['subject_title'] ?>
                </span>
            </a>
        </div>
        <div class="span9 post rate">
            <h1>
                <?php echo $post['title']; ?> 

                <?php if ($post['voted']): ?>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/vote/id/<?php echo $post['id'] ?>" class="btn btn-info hide vote"><i class="icon-white icon-thumbs-up"></i> Hay</a>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/unvote/id/<?php echo $post['id'] ?>" class="btn unvote"><i class="icon-thumbs-down"></i> Không Hay</a>
                <?php else: ?>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/vote/id/<?php echo $post['id'] ?>" class="btn btn-info <?php if (!UserControl::LoggedIn()) echo 'require-login';else echo "vote"; ?>"><i class="icon-white icon-thumbs-up"></i> Hay</a>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/unvote/id/<?php echo $post['id'] ?>" class="btn hide unvote"><i class="icon-thumbs-down"></i> Không Hay</a>
                <?php endif; ?>
            </h1>
            <div class="content-footer clearfix">
                <div>Mã đề: <strong>YIMA-<?php echo Helper::_parse_id($post['id']); ?></strong></div>
                
                <div>Trường: <a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/index/slug/<?php echo $post['organization_slug'] ?>"><?php echo $post['organization_title'] ?></a></div>


                <div>Khoa: <a href="#"><?php echo $post['faculty_title'] ?></a></div>
                <div>Môn: <a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/index/slug/<?php echo $post['organization_slug'] ?>/subject_id/<?php echo $post['subject_id']; ?>"><?php echo $post['subject_title'] ?></a></div>


                <div>Người tạo: <a href="#"><?php echo $post['lastname'] . " " . $post['firstname']; ?></a> 
                - <?php echo DateTimeFormat::nicetime($post['date_added']); ?>
                - <i class="icon-thumbs-up"></i> <span class="total-vote"><?php echo $post['total_like']; ?></span>
                </div>

                Giá: <span class="label label-success"><?php echo $post['price'] ? number_format($post['price']) . "đ" : "Miễn phí"; ?></span>
                - Câu hỏi: <span class="label"><?php echo (int) $post['total_question'] ?></span>

                <?php if (UserControl::getId() == $post['author_id']): ?>
                    <span class="pull-right report"><i class="icon-pencil"></i>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/create_test/edit/id/<?php echo $post['id'] ?>">Chỉnh sửa</a>
                    </span>
                <?php else: ?>
                    <span class="pull-right report"><i class="icon-flag"></i>
                        <a class="report-link <?php if (!UserControl::LoggedIn()) echo 'require-login'; ?>" href="<?php echo Yii::app()->request->baseUrl; ?>/test/report/type/post/id/<?php echo $post['id']; ?>">Báo cáo vi phạm</a>
                    </span>
                <?php endif; ?>
            </div>
            <div class="content clearfix">
                <p><h4>Nội dung tóm tắt</h4></p>
                <?php echo Helper::wpautop($post['description']); ?>

                <br/>
                <p class="clearfix">
                    <?php if (!$has_buy && $post['price'] > 0): ?>
                    <a data-toggle="modal" href="#<?php if (UserControl::LoggedIn()) echo 'modal-buy-test'; ?>" class="btn btn-warning pull-left <?php if (!UserControl::LoggedIn()) echo 'require-login'; ?>"><i class="icon-white icon-hand-right"></i>Làm bài thi</a>
                    <?php elseif (!$has_buy && $post['price'] == 0): ?>
                        <a href="#" class="btn btn-warning pull-left free-test <?php if (!UserControl::LoggedIn()) echo 'require-login'; ?>"><i class="icon-white icon-hand-right"></i> Làm bài thi</a>
                    <?php else: ?>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/do/id/<?php echo $post['id']; ?>" class="btn btn-warning pull-left"><i class="icon-white icon-hand-right"></i> Làm bài thi</a>
                    <?php endif; ?>
                        <a class="btn btn-primary pull-right btn-reply <?php if (!UserControl::LoggedIn()) echo 'require-login'; ?>"><i class="icon-white icon-comment"></i> Bình luận</a>
                </p>
            </div>

            <div class=" reply clearfix hide">
                <form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/test/comment/tid/<?php echo $post['id']; ?>">

                    <p><h4>Câu trả lời của bạn</h4></p>
                    <p><textarea rows="5" class="span12" name="content"></textarea></p>
                    <p><button class="btn cancel"><i class="icon-remove"></i> Hủy</button> <button class="submit btn btn-primary"><i class="icon-white icon-edit"></i> Trả lời</button></p>
                </form>
            </div>
        </div>
    </div>
    <div class="row-fluid" id="list-comments">
        <h3>Trả lời (<?php echo $total; ?>)</h3>
        <?php if (count($comments) < 1): ?>
            <p>Chưa có câu trả lời nào. Bấm vào <a href="#" class="no-comment-reply">đây</a> để là người đầu tiên trả lời cho câu hỏi này.</p>
        <?php endif; ?>
        <ul class="comments">
            <?php if ($best_comment): ?>
                <li class="clearfix comment rate best-comment">
                    <div class="row-fluid" style="margin-bottom: 20px">
                        <h4>Câu trả lời chuẩn nhất</h4>
                    </div>
                    <div class="row-fluid">
                        <div class="span2 avatar">
                            <img width="50" src="<?php echo HelperApp::get_thumbnail($best_comment['thumbnail']); ?>" class="img-polaroid"/>
                        </div>
                        <div class="span10">
                            <div class="content clearfix">
                                <?php echo Helper::wpautop($best_comment['content']); ?>
                            </div>
                            <div class="content-footer clearfix">
                                <span class="pull-left">Người gửi: <a href="#"><?php echo $best_comment['lastname'] . " " . $best_comment['firstname']; ?></a>
                                    - <?php echo DateTimeFormat::nicetime($best_comment['date_added']); ?>
                                    - <i class="icon-thumbs-up"></i> <span class="total-vote"><?php echo (int) $best_comment['total_like']; ?></span>
                                </span>
                                <span class="pull-right report hide"><i class="icon-flag"></i>
                                    <a class="report-link <?php if (!UserControl::LoggedIn()) echo 'require-login'; ?>" href="<?php echo Yii::app()->request->baseUrl; ?>/test/report/type/comment/id/<?php echo $best_comment['id']; ?>">Báo cáo vi phạm</a>
                                </span>
                            </div>
                            <?php if (UserControl::LoggedIn()): ?>
                                <p class="vote-info">
                                    <?php if ($best_comment['voted']): ?>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/vote_comment/id/<?php echo $best_comment['id']; ?>" class="btn btn-info btn-mini vote hide"><i class="icon-white icon-ok-circle"></i> Chuẩn</a>
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/unvote_comment/id/<?php echo $best_comment['id']; ?>" class="btn btn-mini btn-inverse unvote"><i class="icon-white icon-ban-circle"></i> Không chuẩn</a>
                                    <?php else: ?>
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/vote_comment/id/<?php echo $best_comment['id']; ?>" class="btn btn-info btn-mini vote"><i class="icon-white icon-ok-circle"></i> Chuẩn</a>
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/unvote_comment/id/<?php echo $best_comment['id']; ?>" class="btn btn-mini btn-inverse unvote hide"><i class="icon-white icon-ban-circle"></i> Không chuẩn</a>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>

                            <?php if (!UserControl::LoggedIn()): ?>
                                <p class="vote-info btn"><i class="icon-thumbs-up"></i> <?php echo $best_comment['total_like']; ?> người đánh giá câu trả lời này là <strong>chuẩn</strong></p>
                            <?php endif; ?>
                        </div>
                    </div>

                </li>
            <?php endif; ?>
            <?php foreach ($comments as $c): ?>
                <li class="clearfix comment rate" id="comment-<?php echo $c['id'] ?>">
                    <div class="span2 avatar">
                        <img width="50" src="<?php echo HelperApp::get_thumbnail($c['thumbnail']); ?>" class="img-polaroid"/>
                    </div>
                    <div class="span10">
                        <div class="content clearfix">
                            <?php echo Helper::wpautop($c['content']); ?>
                        </div>
                        <div class="content-footer clearfix">
                            <span class="pull-left">Người gửi: <a href="#"><?php echo $c['lastname'] . " " . $c['firstname']; ?></a>
                                - <?php echo DateTimeFormat::nicetime($c['date_added']); ?>
                                - <i class="icon-thumbs-up"></i> <span class="total-vote"><?php echo (int) $c['total_like']; ?></span>
                            </span>
                            <?php if (UserControl::getId() != $c['author_id']): ?>
                                <span class="pull-right report hide"><i class="icon-flag"></i>
                                    <a class="report-link <?php if (!UserControl::LoggedIn()) echo 'require-login'; ?>" href="<?php echo Yii::app()->request->baseUrl; ?>/test/report/type/comment/id/<?php echo $c['id']; ?>">Báo cáo vi phạm</a>
                                </span>
                            <?php endif; ?>
                        </div>

                        <?php if (UserControl::LoggedIn()): ?>
                            <p class="vote-info">
                                <?php if ($c['voted']): ?>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/vote_comment/id/<?php echo $c['id']; ?>" class="btn btn-info btn-mini vote hide"><i class="icon-white icon-ok-circle"></i> Chuẩn</a>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/unvote_comment/id/<?php echo $c['id']; ?>" class="btn btn-mini btn-inverse unvote"><i class="icon-white icon-ban-circle"></i> Không chuẩn</a>
                                <?php else: ?>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/vote_comment/id/<?php echo $c['id']; ?>" class="btn btn-info btn-mini vote"><i class="icon-white icon-ok-circle"></i> Chuẩn</a>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/unvote_comment/id/<?php echo $c['id']; ?>" class="btn btn-mini btn-inverse unvote hide"><i class="icon-white icon-ban-circle"></i> Không chuẩn</a>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!UserControl::LoggedIn()): ?>
                            <p class="vote-info btn"><i class="icon-thumbs-up"></i> <?php echo $c['total_like']; ?> người đánh giá câu trả lời này là <strong>chuẩn</strong></p>
                        <?php endif; ?>
                    </div>

                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>

</div>

<div class="modal hide fade" id="modal-buy-test">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Làm bài thi</h3>
    </div>
    <form action="<?php echo Yii::app()->request->baseUrl; ?>/test/buy/id/<?php echo $post['id'] ?>/" method="post">
        <div class="modal-body">        
            <p>Bạn muốn mua và làm bài thi này với giá <span class="label label-success"><?php echo $post['price'] ? number_format($post['price']) . "đ" : "Miễn phí"; ?></span></p>
        </div>
        <div class="modal-footer">
            <button href="#" class="btn btn-primary modal-submit">Làm bài</button>
            <button href="#" class="btn" data-dismiss="modal">Đóng</button>
        </div>
    </form>
</div>

<a id="modal-report" href="#modal-report-success" role="button" class="btn hide" data-toggle="modal"></a>
<div class="modal hide fade" id="modal-report-success">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Báo cáo vi phạm</h3>
    </div>
    <div class="modal-body">
        <p>Cảm ơn bạn đã báo cáo vi phạm cho chúng tôi. Chúc bạn một ngày tốt lành</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary modal-close">Đóng</a>
    </div>
</div>