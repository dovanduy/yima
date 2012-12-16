<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">
            <aside class="sidebar span3">
                <div class="sidebar-wrap">
                    <div id="faculty" class="filter">
                        <h3>Trường/Trung Tâm</h3>

                        <ul>
                            <?php if (count($group) < 1): ?>
                                <li><i>(Không có môn học nào)</i></li>
                            <?php endif; ?>
                            <?php foreach ($group as $g): ?>
                                <li >
                                    <a href="<?php echo Yii::app()->baseUrl ?>/subject/index/id/<?php echo $g['subject_id'] ?>/organization_id/<?php echo $g['organization_id'] ?>"> <?php echo $g['title'] ?></a>
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
                            <?php echo $subject['title'] ?>
                        </strong>
                    </div>

                    <div class="list-result">
                        <ul>
                            <?php if (count($group_view) < 1): ?>
                                <li><i>(Không có chủ đề nào)</i></li>
                            <?php endif; ?>
                            <?php foreach ($group_view as $gv): ?>
                                <li class="clearfix">
                                    <div class="date">
                                        <p><strong>SUN</strong>Aug 19</p>
                                    </div>
                                    <div class="summary">
                                        <h4><?php echo $gv['title'] ?></h4>
                                        <p><b>Khoa: </b><?php echo $gv['faculty_title'] ?><p>
                                        <p><a href="#"><?php echo $subject['title'] ?></a><p>
                                    </div>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                    <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
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