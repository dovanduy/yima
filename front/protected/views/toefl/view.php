<div class="span8 magu-listing" id="post">
    <div class="row-fluid">
        <div class="span3 avatar">
            <a class="book-cover" href="<?php echo Yii::app()->baseUrl ?>/test/view/s/<?php echo $post['id'] ?>">
                <span class="inner">
                    <?php echo $post['title'] ?>
                </span>
            </a>
        </div>
        <div class="span7 post rate">
            <h1>
                <?php echo $post['title']; ?> 

                <?php if (isset($post['voted'])): ?>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/vote/id/<?php echo $post['id'] ?>" class="btn btn-info hide vote">Hay</a>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/unvote/id/<?php echo $post['id'] ?>" class="btn unvote">Không Hay</a>
                <?php else: ?>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/vote/id/<?php echo $post['id'] ?>" class="btn btn-info <?php if (!UserControl::LoggedIn()) echo 'require-login';else echo "vote"; ?>">Hay</a>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/unvote/id/<?php echo $post['id'] ?>" class="btn hide unvote">Không Hay</a>
                <?php endif; ?>
            </h1>
            <div class="content-footer clearfix">



                - Môn: Toefl<br/>





            </div>
            <div class="content clearfix">
                <p><h4>Nội dung tóm tắt</h4></p>
                <?php echo 'Toefl' ?>

                <br/>

            </div>

            

            <div class=" reply clearfix hide">
                <form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/test/comment/tid/<?php echo $post['id']; ?>">

                    <p><h4>Câu trả lời của bạn</h4></p>
                    <p><textarea rows="5" class="span12" name="content"></textarea></p>
                    <p><button class="btn cancel">Hủy</button> <button class="submit btn btn-primary">Trả lời</button></p>
                </form>
            </div>
        </div>
        <div class ="toefl-test" id="toefl_<?php echo $post['id'] ?>">
                <ul>
                    <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/reading/index/<?php echo $post['reading1'] ?>/1/<?php echo $c_id?>"> Reading 1</a></li>
                    <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/reading/index/<?php echo $post['reading2'] ?>/2/<?php echo $c_id?>"> Reading 2</a></li>
                    <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/reading/index/<?php echo $post['reading3'] ?>/3/<?php echo $c_id?>"> Reading 3</a></li>
                </ul>
                <ul>
                    <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/listening/index/<?php echo $post['listening1'] ?>/1/<?php echo $c_id?>"> Listening 1</a></li>
                    <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/listening/index/<?php echo $post['listening2'] ?>/2/<?php echo $c_id?>"> Listening 2</a></li>
                    <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/listening/index/<?php echo $post['listening3'] ?>/3/<?php echo $c_id?>"> Listening 3</a></li>
                    <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/listening/index/<?php echo $post['listening4'] ?>/4/<?php echo $c_id?>"> Listening 4</a></li>
                    <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/listening/index/<?php echo $post['listening5'] ?>/5/<?php echo $c_id?>"> Listening 5</a></li>
                    <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/listening/index/<?php echo $post['listening6'] ?>/6/<?php echo $c_id?>"> Listening 6</a></li>
                </ul>
                <ul>
                    <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/speaking/index/<?php echo $post['speaking1'] ?>/<?php echo $post['speaking2'] ?>/<?php echo $post['speaking3'] ?>/<?php echo $post['speaking4'] ?>/<?php echo $post['speaking5'] ?>/<?php echo $post['speaking6'] ?>/<?php echo $c_id?>"> Speaking</a></li>
                </ul>
                <ul>
                    <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/writing/index/<?php echo $post['writing1'] ?>/<?php echo $post['writing2'] ?>/<?php echo $c_id?>"> Writing</a></li>
                </ul>
            </div>
    </div>
</div>


<div class="modal hide fade" id="modal-buy-test">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Làm bài thi</h3>
    </div>
    <form action="<?php echo Yii::app()->request->baseUrl; ?>/test/buy/id/<?php echo $post['id'] ?>/" method="post">
        <div class="modal-body">        
            <p>Bạn muốn mua và làm bài thi này với giá <span class="label label-success"><?php echo "Miễn phí"; ?></span></p>
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