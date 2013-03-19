<aside class="sidebar span3 list-test recent-tests">
    <div class="sidebar-wrap">
        <div class="filter">
            <h3><i class="icon-list-alt"></i> Bài đã tạo gần đây</h3>
            <div class="list-result latest">
                <ul>
                    <?php foreach (HelperGlobal::get_recent_tests() as $k => $n): ?>
                        <li>                            
                            <div class="summary">
                                <div class="title">YIMA-<?php echo Helper::_parse_id($n['id']); ?></div>
                                <div class="title">
                                    <a href="<?php echo Yii::app()->baseUrl ?>/test/view/s/<?php echo $n['slug'] ?>"><?php echo $n['title'] ?></a>
                                    <?php if ($n['disabled'] == 1): ?>
                                        <span class="label">Chờ duyệt</span>
                                    <?php endif; ?>
                                </div>
                                <div class="sub-title">Loại: <?php echo $n['section_title']; ?></div>
                                <div class="sub-title"><?php echo $n['subject_title']; ?></div>


                                <div class="price"><span class="time"><a href="#" rel="tooltip" title="<?php echo date('d-m-Y H:i:s', $n['date_added']); ?>"><?php echo DateTimeFormat::nicetime($n['date_added']); ?></a></span> Giá: <?php if ($n['price'] == 0) echo '<span class="label label-success">miễn phí</span>'; else echo '<span class="label label-info">' . number_format($n['price'], 0, '.', '.') . ' đ</span>'; ?></div>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    <?php endforeach; ?>
                    <li><a class="btn pull-right btn-info" href="<?php echo Yii::app()->request->baseUrl . "/user/test/type/created/" ?>">Xem tất cả</a></li>
                </ul>
            </div> 
            <div class="clearfix"></div>
            <?php /*
              <ul>
              <?php foreach (HelperGlobal::get_recent_tests() as $k => $v): ?>
              <li class="clearfix">
              <a rel="tooltip" title="<?php echo $v['title'] ?>" href="<?php echo Yii::app()->request->baseUrl . "/create_test/edit/id/" . $v['id'] ?>"><?php echo Helper::string_truncate($v['title'], 38); ?></a><br/>
              <span class="time pull-right"><a href="#" rel="tooltip" title="<?php echo date('d-m-Y H:i:s', $v['date_added']); ?>"><?php echo DateTimeFormat::nicetime($v['date_added']); ?></a></span>
              </li>
              <?php endforeach; ?>

              <li><a href="<?php echo Yii::app()->request->baseUrl . "/user/test/type/created/" ?>">Xem tất cả</a></li>
              </ul>
             */ ?>
        </div>
    </div>
</aside>