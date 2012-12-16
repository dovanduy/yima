<div class="block aside">
    <div class="head">Trường/Trung tâm</div>
    <ul class="list-items">
        <?php foreach ($organizations as $k=>$v): ?>
            <li>
                <?php echo $k+1; ?>. <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/?oid=<?php echo $v['id']; ?>"><?php echo $v['title'] ?></a>
            </li>
        <?php endforeach; ?>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/">Xem tất cả</a></li>
    </ul>
</div>