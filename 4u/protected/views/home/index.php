
<div class="span8 magu-listing">
    <!--<h2>Tìm câu hỏi</h2> -->
    <form class="form-search home-search" method="get" action="<?php echo Yii::app()->request->baseUrl; ?>/post/search/">
        <input type="text" class="input-xlarge search-query" placeholder="Tìm kiếm câu hỏi ..." name="keyword">
        <button type="submit" class="btn btn-primary btn-large">Tìm</button>
    </form>

    <ul class="nav nav-tabs">
        <li class="<?php if (Yii::app()->params['page'] == "hay") echo 'active'; ?>">
            <a href="<?php if (Yii::app()->params['page'] == "hay") echo "#";else echo Yii::app()->request->baseUrl."/home/" ?>">Chuẩn</a>
        </li>
        <li class="<?php if (Yii::app()->params['page'] == "new") echo 'active'; ?>"><a href="<?php if (Yii::app()->params['page'] == "new") echo "#";else echo Yii::app()->request->baseUrl."/home/new/" ?>">Mới</a></li>
    </ul>

    <?php foreach ($posts as $k => $v): ?>
        <div class="row-fluid magu">
            <div class="span2">
                <a href=""><img class="img-polaroid" width="70" src="<?php echo HelperApp::get_thumbnail($v['thumbnail']); ?>" /></a>
            </div>
            <div class="span10">
                <div class="title"><a href="<?php echo Yii::app()->request->baseUrl; ?>/post/view/s/<?php echo $v['slug'] ?>"><?php echo $v['title'] ?></a></div>
                <div class="category sub-info">
                    <a class="link" href="#"><?php echo $v['email'] ?></a> đã gửi vào chủ đề 
                    <a class="link" href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/?sid=<?php echo $v['subject_id'] ?>"><?php echo $v['subject_name'] ?></a>
                    
                    <?php  if ($v['organization_id']): ?>
                    trong <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/?oid=<?php echo $v['organization_id'] ?>" class="link"><?php echo $v['organization_name']; ?></a>
                    <?php endif;  ?>                    
                    
                    - <?php echo DateTimeFormat::nicetime($v['date_added']); ?>
                    - <span class="total-vote"><a href="<?php echo Yii::app()->request->baseUrl; ?>/post/view/s/<?php echo $v['slug'] ?>"><i class="icon-comment"></i> <?php echo $v['total_comment'] ?></a></span>
                    - <span class="total-vote"><a href="<?php echo Yii::app()->request->baseUrl; ?>/post/view/s/<?php echo $v['slug'] ?>"><i class="icon-thumbs-up"></i> <?php echo $v['total_like'] ?></a></span>
                </div>
                <?php /* if ($v['organization_id']): ?>
                    <div class="location"><strong>Trường/Trung tâm:</strong> <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/?oid=<?php echo $v['organization_id'] ?>" class="subject-location"><?php echo $v['organization_name']; ?></a></div>
                <?php endif; */ ?>
            </div>
        </div>
    <?php endforeach; ?>
    <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
</div>                    
