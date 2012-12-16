<div class="block aside">
    <div class="head">Chủ đề</div>
    <ul class="list-items">
        <?php foreach ($subjects as $k=>$v): ?>
            <li>
                <?php echo $k+1; ?>. <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/?sid=<?php echo $v['id']; ?>"><?php echo $v['title'] ?></a>
            </li>
        <?php endforeach; ?>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/">Xem tất cả</a></li>
    </ul>
</div>