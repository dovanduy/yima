<div class="home">
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
            <div class="row-fluid">
                <div class="span12 magu-listing clearfix">
                    <legend>TOEFL</legend>
                    <?php /*
                      <div class="span4"><a href="<?php echo Yii::app()->baseUrl?>/toefl"><img src="<?php echo Yii::app()->baseUrl?>/images/menu/toefl.jpg"></a></div>
                      <div class="span4"><a href="<?php echo Yii::app()->baseUrl?>/toeic/test"><img src="<?php echo Yii::app()->baseUrl?>/images/menu/toeic.jpg"></a></div>
                      <div class="span4"><a><img src="<?php echo Yii::app()->baseUrl?>/images/menu/toefl.jpg"></a></div>
                     */ ?>
                    <?php /*
                      <h2>Tìm bài kiểm tra</h2>
                      <form class="form-search home-search" action="<?php echo Yii::app()->request->baseUrl; ?>/test/">
                      <input type="text" class="input-xlarge search-query" name="cate" placeholder="Nhập tên bài kiểm tra bạn cần tìm vào đây">
                      <button type="submit" class="btn btn-success">Tìm kiếm</button>
                      </form>
                     */ ?>
                    <div class="list-result">
                        <table class="table table-bordered table-striped table-center">
                            <tr>
                                <th>Mã số</th>
                                <th>Tên</th>

                                <th></th>
                            </tr>
                            <?php if (count($toefl) < 1): ?>
                                <tr>
                                    <td colspan="3">Không tìm thấy đề phù hợp.</td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($toefl as $n): ?>
                                <tr>
                                    <td>TOEFL-<?php echo Helper::_parse_id($n['id']) ?></td>
                                    <td class="align-left">
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/view/id/<?php echo $n['id'] ?>"><?php echo $n['title']; ?></a><br/>

                                    </td>
                                    <td>
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/view/id/<?php echo $n['id'] ?>" class="btn btn-small">Chi tiết</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                    </div>

                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl" class="pull-right">Xem thêm bài Toefls <i class="icon-circle-arrow-right"></i></a>
                </div>  
            </div>
            <div class="row-fluid">
                <div class="span12 magu-listing clearfix">
                    <legend>Bài kiểm tra</legend>
                    <?php /*
                      <div class="span4"><a href="<?php echo Yii::app()->baseUrl?>/toefl"><img src="<?php echo Yii::app()->baseUrl?>/images/menu/toefl.jpg"></a></div>
                      <div class="span4"><a href="<?php echo Yii::app()->baseUrl?>/toeic/test"><img src="<?php echo Yii::app()->baseUrl?>/images/menu/toeic.jpg"></a></div>
                      <div class="span4"><a><img src="<?php echo Yii::app()->baseUrl?>/images/menu/toefl.jpg"></a></div>
                     */ ?>
                    <?php /*
                      <h2>Tìm bài kiểm tra</h2>
                      <form class="form-search home-search" action="<?php echo Yii::app()->request->baseUrl; ?>/test/">
                      <input type="text" class="input-xlarge search-query" name="cate" placeholder="Nhập tên bài kiểm tra bạn cần tìm vào đây">
                      <button type="submit" class="btn btn-success">Tìm kiếm</button>
                      </form>
                     */ ?>
                    <div class="list-result">
                        <table class="table table-bordered table-striped table-center">
                            <tr>
                                <th>Mã số</th>
                                <th>Tên</th>
                                <th>Trường / Khoa</th>
                                <th>Giá</th>
                                <th></th>
                            </tr>
                            <?php if (count($nt_test) < 1): ?>
                                <tr>
                                    <td colspan="5">Không tìm thấy đề phù hợp.</td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($nt_test as $n): ?>
                                <tr>
                                    <td>YIMA-<?php echo Helper::_parse_id($n['id']) ?></td>
                                    <td class="align-left">
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/view/s/<?php echo $n['slug'] ?>"><?php echo $n['title']; ?></a><br/>
                                        Loại: <?php echo $n['section_title'] ?><br/>
                                        Chủ đề: <a rel="tooltip" title="<?php echo $n['subject_title']; ?>" href="<?php echo Yii::app()->request->baseUrl ?>/organization/index/slug/<?php echo $n['organization_slug'] ?>/subject_id/<?php echo $n['subject_id']; ?>"><?php echo Helper::string_truncate($n['subject_title']); ?></a>
                                    </td>
                                    <td class="align-left">
                                        <a rel="tooltip" title="<?php echo $n['org_title']; ?>" href="<?php echo Yii::app()->request->baseUrl; ?>/organization/index/slug/<?php echo $n['organization_slug'] ?>"><?php echo $n['org_title']; ?></a><br/>
                                        Khoa: <a rel="tooltip" title="<?php echo $n['faculty_name']; ?>" href="<?php echo Yii::app()->request->baseUrl; ?>/faculty/index/id/<?php echo $n['faculty_id']; ?>/oid/<?php echo $n['organization_id']; ?>"><?php echo $n['faculty_name']; ?></a>
                                    </td>
                                    <td>
                                        <?php if ($n['price'] == 0): ?>
                                            <span class="label label-success">Miễn phí</span>
                                        <?php else: ?>
                                            <span class="label label-info"><?php echo number_format($n['price'], 0, '.', '.'); ?> đ</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/view/s/<?php echo $n['slug'] ?>" class="btn btn-small">Chi tiết</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                    </div>

                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/test" class="pull-right">Xem thêm bài kiểm tra <i class="icon-circle-arrow-right"></i></a>
                </div>   
            </div>
        </div>


    </div> <!-- /container -->
</div>