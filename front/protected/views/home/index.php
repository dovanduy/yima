<div class="row-fluid home">
    <div class="container">
        <?php /*
          <div class="row-fluid">
          <div class="span12 featured">
          <div class="info">
          <h3>Chủ Đề Kiểm Tra Online</h3>
          <p>Tìm kiếm các bài kiểm tra trên Yima.vn. Hoặc tạo bài thi của riêng bạn và bắt đầu bán tại đây</p>
          <a href="<?php echo Yii::app()->request->baseUrl; ?>/create_test" class="btn btn-large btn-primary">Tạo bài kiểm tra</a> (miễn phí)
          </div>
          <div class="banner">
          <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/banner.png" alt=""/>
          </div>
          </div>
          </div> */ ?>
        <div class="row-fluid magu-home">
            
            <div class="span12 magu-listing">
                <div class="span4"><a href="<?php echo Yii::app()->baseUrl?>/toefl"><img src="<?php echo Yii::app()->baseUrl?>/images/menu/toefl.jpg"></a></div>
                <div class="span4"><a href="<?php echo Yii::app()->baseUrl?>/toeic/test"><img src="<?php echo Yii::app()->baseUrl?>/images/menu/toeic.jpg"></a></div>
                <div class="span4"><a><img src="<?php echo Yii::app()->baseUrl?>/images/menu/toefl.jpg"></a></div>
                <?php /*
                  <h2>Tìm bài kiểm tra</h2>
                  <form class="form-search home-search" action="<?php echo Yii::app()->request->baseUrl; ?>/test/">
                  <input type="text" class="input-xlarge search-query" name="cate" placeholder="Nhập tên bài kiểm tra bạn cần tìm vào đây">
                  <button type="submit" class="btn btn-success">Tìm kiếm</button>
                  </form>
                 */ ?>
                <div class="list-result">
                    <ul>
                        <?php foreach ($nt_test as $n): ?>
                            <li>
                                <a class="book-cover" href="<?php echo Yii::app()->baseUrl ?>/test/view/s/<?php echo $n['slug'] ?>">
                                    <span class="inner">
                                        <?php echo $n['subject_title'] ?>
                                    </span>
                                </a>
                                <div class="summary">
                                    <div class="title"><a href="<?php echo Yii::app()->baseUrl ?>/test/view/s/<?php echo $n['slug'] ?>"><?php echo $n['title']; ?></a></div>
                                    <div class="price">Giá: <?php if ($n['price'] == 0) echo '<span class="label label-success">miễn phí</span>'; else echo '<span class="label label-info">' . number_format($n['price'], 0, '.', '.') . ' đ</span>'; ?></div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/test" class="pull-right">Xem thêm bài kiểm tra <i class="icon-circle-arrow-right"></i></a>
            </div>   
            <?php /*
              <div class="span4 hot-magu">
              <ul>
              <?php foreach ($subject as $v): ?>

              <li>
              <div class="img"><img src="<?php echo HelperApp::get_thumbnail($v['thumbnail']) ?>" alt=""/></div>
              <div class="overlay"></div>
              <div class="overlayContent">
              <div class="category"><?php echo $v['title'] ?></div>

              </div>

              </li>
              <?php endforeach; ?>
              </ul>
              </div>
             */ ?>
        </div>


    </div> <!-- /container -->
</div>