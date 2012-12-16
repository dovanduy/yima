
<aside class="sidebar span3">
    <div class="sidebar-wrap">
        <div id="filter_date" class="filter">
            <h3>Tìm theo ngày</h3>
            <ul>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_time/t/all">Tất cả</a>
                </li>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_time/t/today">Hôm nay</a>
                </li>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_time/t/tomorrow">Ngày mai</a>
                </li>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_time/t/week">Trong tuần</a>
                </li>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_time/t/weekend">Cuối tuần</a>
                </li>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_time/t/month">Trong tháng</a>
                </li>
            </ul>
        </div>




        <div id="filter_price" class="filter">
            <h3>Tìm theo giá</h3>
            <ul>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_price/pr/all">Tất cả</a>
                </li>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_price/pr/purchase">Tính phí</a>
                </li>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_price/pr/free">Miễn phí</a>
                </li>
            </ul>
        </div>




        <div id="filter_category" class="filter">
            <h3>Chủ đề</h3>
            <ul>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_category/c/all">Tất cả các Chủ đề</a>
                </li>
                <?php /*foreach ($test_categories as $tc): ?>
                    <li class="">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_category/c/<?php echo $tc['subject_id']; ?>"><?php echo $tc['subject_title']; ?></a>
                    </li>
                <?php endforeach;*/ ?>
            </ul>
        </div>




        <div id="filter_city" class="filter">
            <h3>Trường / Trung tâm</h3>
            <ul>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_organization/org/all">Tất cả các Trường / Trung tâm</a>
                </li>
                <?php /*foreach ($test_organizations as $to): ?>
                    <li class="">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/search_by_organization/org/<?php echo $to['org_id']; ?>"><?php echo $to['org_title']; ?></a>
                    </li>
                <?php endforeach;*/ ?>

            </ul>
        </div>
    </div>
</aside>