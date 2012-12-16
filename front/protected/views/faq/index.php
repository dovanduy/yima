<div class="row-fluid articles">
    <article class="container">
        <section class="wrap radius-body">
            <div class="row-fluid">
                <div class="span8 main">
                    <?php $this->renderPartial('help'); ?>
                    <section id="welcome">
                        <?php $this->renderPartial('search'); ?>

                        <?php /*
                        <div id="intro">
                            <h3>Lần đầu tiên sử dụng Yima.vn?</h3>
                            <section class="row-fluid">
                                <div class="span5">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb_feature_tutorial.jpg" alt="">
                                </div>
                                <article class="span7">
                                    <p>
                                        Đây là trang thông tin hướng dẫn dành cho người mới bắt đầu sử dụng Yima.vn. Nếu vé tham gia sự kiện của bạn miễn phí, thì chúng tôi cung cấp dịch vụ hoàn toàn miễn phí cho bạn và cả khách hàng của bạn.
                                    </p>
                                    <p>
                                        Bạn có thể nhập chủ đề bạn cần tìm vào ô <strong>Tìm kiếm</strong> phía trên. Hoặc bạn có thể tìm hiểu về các chủ đề thường được hỏi ở danh sách bên dưới.
                                    </p>
                                    <nav>
                                        <a href="#">Dành cho người mới bắt đầu</a>
                                        <a href="#">Xem video hướng dẫn</a>
                                    </nav>
                                </article>
                            </section>
                        </div>*/?>
                    </section>

                    <section class="main-content">
                        <?php $total_categories = count($categories); ?>
                        <?php for($i = 0;$i < ceil($total_categories / 2); $i++): ?>
                        <?php 
                        $cate_1 = $categories[($i * 2)];
                        $cate_2 = isset($categories[($i * 2) + 1])  ? $categories[($i * 2) + 1] : null;
                        ?>
                        <div class="row-fluid list">
                            <div class="span6">
                                <h3> <?php echo $cate_1['title'] ?></h3>
                                <ul>
                                    <?php foreach($cate_1['faqs'] as $f): ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->request->baseUrl ?>/faq/view/s/<?php echo $f['slug'] ?>"><?php echo $f['title'] ?></a>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                                <a href="<?php echo Yii::app()->request->baseUrl."/faq/category/c/".$cate_1['slug']."/"; ?>" class="view-all">Xem tất cả</a>
                            </div>
                            <?php if($cate_2): ?>
                            <div class="span6">
                                <h3> <?php echo $cate_2['title'] ?></h3>
                                <ul>
                                    <?php foreach($cate_2['faqs'] as $f): ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->request->baseUrl ?>/faq/view/s/<?php echo $f['slug'] ?>"><?php echo $f['title'] ?></a>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                                <a href="<?php echo Yii::app()->request->baseUrl."/faq/category/c/".$cate_2['slug']."/"; ?>" class="view-all">Xem tất cả</a>
                            </div>
                            <?php endif;?>
                        </div>
                        <?php endfor;?>
                    </section>

                </div>
                <div class="span4 sidebar right">
                    Sidebar
                </div>
            </div>
        </section>
    </article>
</div>