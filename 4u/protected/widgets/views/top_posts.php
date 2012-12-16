<div class="block aside">
    <div class="head">Câu hỏi hay nhất</div>
    <ul class="list-items">
        <?php foreach ($posts as $k=>$v): ?>
            <li>
                <?php echo $k+1; ?>. <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/view/s/<?php echo $v['slug']; ?>"><?php echo $v['title'] ?></a>
            </li>
        <?php endforeach; ?>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/type/hay/">Tất cả</a></li>
    </ul>
</div>