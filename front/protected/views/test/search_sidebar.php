
<aside class="sidebar span3">
    <div class="sidebar-wrap">
        <div id="filter_price" class="filter">
            <h3>Tìm theo giá</h3>
            <ul>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/?price=all&<?php echo Helper::array_querystring_truncate($query_string, 'price'); ?>">Tất cả</a>
                </li>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/?price=paid&<?php echo Helper::array_querystring_truncate($query_string, 'price'); ?>">Tính phí</a>
                </li>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/?price=free&<?php echo Helper::array_querystring_truncate($query_string, 'price'); ?>">Miễn phí</a>
                </li>
            </ul>
        </div>




        <div id="filter_category" class="filter">
            <h3>Chủ đề</h3>
            <ul>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/?cid=all&<?php echo Helper::array_querystring_truncate($query_string, 'cid'); ?>">Tất cả các Chủ đề</a>
                </li>
                <?php foreach ($test_categories as $tc): ?>
                    <li class="">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/?cid=<?php echo $tc['subject_id']; ?>&<?php echo Helper::array_querystring_truncate($query_string, 'cid'); ?>"><?php echo $tc['subject_title']; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>




        <div id="filter_city" class="filter">
            <h3>Trường / Trung tâm</h3>
            <ul>
                <li class="">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/?oid=all&<?php echo Helper::array_querystring_truncate($query_string, 'oid'); ?>">Tất cả các Trường / Trung tâm</a>
                </li>
                <?php foreach ($test_organizations as $to): ?>
                    <li class="">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/?oid=<?php echo $to['org_id']; ?>&<?php echo Helper::array_querystring_truncate($query_string, 'oid'); ?>"><?php echo $to['org_title']; ?></a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>

        <?php if (count($query_string) > 0): ?>
            <form method="get" action="">
                <div id="filter_date" class="filter">

                    <h3>Nội dung đang tìm</h3>
                    <ul>

                        <?php
                        $key = array('cate' => 'Nội dung', 'oid' => 'Trường/ Trung tâm', 'own' => 'Tác giả', 'cid' => 'Chủ đề', 'price' => 'Giá');
                        ?>

                        <?php foreach ($query_string as $k => $v): ?>
                            <li class="">
                                <a class="query-search" href="#"><i class="icon-remove"></i></a>
                                <a ><?php echo $key[$k]; ?></a>: <?php echo $v; ?>
                                <input type="hidden" name="<?php echo $k; ?>" value="<?php echo urldecode($v); ?>" />
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </form>
        <?php endif; ?>

    </div>
</aside>