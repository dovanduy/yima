<div class="span4 sidebar" style="margin-top: 33px">
    <div class="row-fluid">
        <div class="box">
            <h4>Khoa</h4>
            <ul>
                <?php foreach ($faculties as $k => $v): ?>
                    <li><a href="#"><?php echo $k + 1; ?>. &nbsp;<?php echo $v['title']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="row-fluid">
        <div class="box">
            <h4>Đề tương tự</h4>
            <ul>
                <?php foreach ($tests as $k => $v): ?>
                    <li><a href="#"><?php echo $k + 1; ?>. &nbsp;<?php echo $v['title']; ?></a></li>
                <?php endforeach; ?>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/index/slug/<?php echo $test['organization_slug'] ?>/subject_id/<?php echo $test['subject_id'] ?>">Tất cả</a></li>
            </ul>
        </div>
    </div>
    <div class="row-fluid">
        <div class="box">
            <h4>Đã mua gần đây</h4>
            <ul>
                <?php foreach ($transactions as $k => $v): ?>
                    <li>
                        <a href="#"><?php echo $k + 1; ?>. &nbsp;<?php echo $v['lastname'] . " " . $v['firstname']; ?></a> <br/>
                        <span class="time"><?php echo DateTimeFormat::nicetime($v['date_added']); ?></span>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>

    <div class="row-fluid">
        <div class="box">
            <h4>Đã làm bài gần đây</h4>
            <ul>
                <?php foreach ($latest_test_users as $k => $v): ?>
                    <li>
                        <a href="#"><?php echo $k + 1; ?>. &nbsp;<?php echo $v['lastname'] . " " . $v['firstname']; ?></a> <br/>
                        <span class="time"><?php echo DateTimeFormat::nicetime($v['date_added']); ?></span>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
</div>               