<div class="span8 magu-listing" id="post">
    <div class="row-fluid">
        <div class="span2 avatar">
            <img width="70" src="<?php echo HelperApp::get_thumbnail($post['thumbnail']); ?>" class="img-polaroid"/>
            <?php /* <p><a href=""><?php echo $post['lastname']." ".$post['firstname'] ?></a></p> */ ?>
        </div>
        <div class="span10 post rate">

            <h1>
                <?php echo $post['title']; ?> 

                <?php if ($post['voted']): ?>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/vote/id/<?php echo $post['id'] ?>" class="btn btn-info hide vote">Hay</a>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/unvote/id/<?php echo $post['id'] ?>" class="btn unvote">Không Hay</a>
                <?php else: ?>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/vote/id/<?php echo $post['id'] ?>" class="btn btn-info <?php if (!UserControl::LoggedIn()) echo 'require-login';else echo "vote"; ?>">Hay</a>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/unvote/id/<?php echo $post['id'] ?>" class="btn hide unvote">Không Hay</a>
                <?php endif; ?>
            </h1>
            <div class="content-footer clearfix">
                <a href="#"><?php echo $post['lastname'] . " " . $post['firstname']; ?></a> đã gửi vào chủ đề 
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/?sid=<?php echo $post['subject_id'] ?>"><?php echo $post['subject_name'] ?></a>
                
                <?php if ($post['organization_id']): ?>
                    trong <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/?oid=<?php echo $post['organization_id'] ?>"><?php echo $post['organization_name'] ?></a>
                <?php endif; ?>

                - <?php echo DateTimeFormat::nicetime($post['date_added']); ?>
                - <i class="icon-thumbs-up"></i> <span class="total-vote"><?php echo (int) $post['total_like']; ?></span>

                <?php if (UserControl::getId() == $post['author_id']): ?>
                    <span class="pull-right report"><i class="icon-pencil"></i>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/edit/id/<?php echo $post['id'] ?>">Chỉnh sửa</a>
                    </span>
                <?php else: ?>
                    <span class="pull-right report"><i class="icon-flag"></i>
                        <a class="report-link <?php if (!UserControl::LoggedIn()) echo 'require-login'; ?>" href="<?php echo Yii::app()->request->baseUrl; ?>/post/report/type/post/id/<?php echo $post['id']; ?>">Báo cáo vi phạm</a>
                    </span>
                <?php endif; ?>
            </div>
            <div class="content clearfix">
                <?php echo Helper::wpautop($post['content']); ?>

                <a href="" class="btn btn-primary pull-right btn-reply <?php if (!UserControl::LoggedIn()) echo 'require-login'; ?>">Trả lời câu hỏi</a>
            </div>

            <div class=" reply clearfix hide">
                <form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/post/comment/post/<?php echo $post['id']; ?>">

                    <p><h4>Câu trả lời của bạn</h4></p>
                    <p><textarea rows="5" class="span12" name="content"></textarea></p>
                    <p><button class="btn cancel">Hủy</button> <button class="submit btn btn-primary">Trả lời</button></p>
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
                                    <a class="report-link <?php if (!UserControl::LoggedIn()) echo 'require-login'; ?>" href="<?php echo Yii::app()->request->baseUrl; ?>/post/report/type/comment/id/<?php echo $best_comment['id']; ?>">Báo cáo vi phạm</a>
                                </span>
                            </div>
                            <?php if(UserControl::LoggedIn()): ?>
                            <p class="vote-info">
                                <?php if ($best_comment['voted']): ?>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/vote_comment/id/<?php echo $best_comment['id']; ?>" class="btn btn-info btn-mini vote hide">Chuẩn</a>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/unvote_comment/id/<?php echo $best_comment['id']; ?>" class="btn btn-mini unvote">Không chuẩn</a>
                                <?php else: ?>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/vote_comment/id/<?php echo $best_comment['id']; ?>" class="btn btn-info btn-mini vote">Chuẩn</a>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/unvote_comment/id/<?php echo $best_comment['id']; ?>" class="btn btn-mini unvote hide">Không chuẩn</a>
                                <?php endif; ?>
                            </p>
                            <?php endif;?>
                            
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
                            <?php if(UserControl::getId() != $c['author_id']): ?>
                            <span class="pull-right report hide"><i class="icon-flag"></i>
                                <a class="report-link <?php if (!UserControl::LoggedIn()) echo 'require-login'; ?>" href="<?php echo Yii::app()->request->baseUrl; ?>/post/report/type/comment/id/<?php echo $c['id']; ?>">Báo cáo vi phạm</a>
                            </span>
                            <?php endif;?>
                        </div>
                        <?php if(UserControl::LoggedIn()): ?>
                        <p class="vote-info">
                            <?php if ($c['voted']): ?>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/vote_comment/id/<?php echo $c['id']; ?>" class="btn btn-info btn-mini vote hide">Chuẩn</a>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/unvote_comment/id/<?php echo $c['id']; ?>" class="btn btn-mini unvote">Không chuẩn</a>
                            <?php else: ?>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/vote_comment/id/<?php echo $c['id']; ?>" class="btn btn-info btn-mini vote">Chuẩn</a>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/unvote_comment/id/<?php echo $c['id']; ?>" class="btn btn-mini unvote hide">Không chuẩn</a>
                            <?php endif; ?>
                        </p>
                        <?php endif;?>
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