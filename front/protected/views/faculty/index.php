<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">
            <aside class="sidebar span3">
                <div class="sidebar-wrap">
                    <div id="filter_date" class="filter">
                        <h3>Chủ đề</h3>
                        <ul>
                            <?php foreach ($subjects as $s): ?>
                                <li>
                                    <a href="<?php echo Yii::app()->baseUrl ?>/organization/index/slug/<?php echo $organization['slug'] ?>/subject_id/<?php echo $s['id'] ?>"><?php echo $s['title'] ?></a>

                                </li>

                            <?php endforeach; ?>

                        </ul>
                    </div>
                </div>
            </aside>


            <section class="search span9">
                <div id="search_results">
                    <div class="alert-message clearfix">
                        <strong>
                            <?php echo $organization['title'] ?>
                        </strong><br/><br/>
                        <span style="font-size: 14px;font-weight: bold"><?php echo $faculty['title']; ?></span>
                    </div>

                    <div class="list-result search-page">
                        <table class="table table-bordered table-striped table-center">
                            <tr>
                                <th>Mã số</th>
                                <th>Tên</th>
                                <th>Trường / Khoa</th>
                                <th>Giá</th>
                                <th></th>
                            </tr>
                            <?php if (count($tests) < 1): ?>
                                <tr>
                                    <td colspan="5">Không tìm thấy đề phù hợp.</td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($tests as $n): ?>
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
                                            <span class="label label-info"><?php echo number_format($n['price'], 0, '.', '.'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/view/s/<?php echo $n['slug'] ?>" class="btn btn-small">Chi tiết</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div> 
                    <div class="clearfix"></div>
                    <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
                </div>
                <?php
                /*
                  <div class="paging">
                  <span class="result-count">Showing 91 - 100 of 69322</span>
                  <div class="pagination">
                  <ul>
                  <li><a href="#">«</a></li>
                  <li class="disabled"><a href="#">...</a></li>
                  <li><a href="#">6</a></li>
                  <li><a href="#">7</a></li>
                  <li class="active"><a href="#">8</a></li>
                  <li><a href="#">9</a></li>
                  <li><a href="#">10</a></li>
                  <li class="disabled"><a href="#">...</a></li>
                  <li><a href="#">»</a></li>
                  </ul>
                  </div>
                  </div>
                  </div> */
                ?>


            </section>
        </article>
    </div>
</div>