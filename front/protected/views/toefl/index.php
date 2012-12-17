<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">
            <aside class="sidebar span3">
                <?php $this->renderPartial('course_sidebar', array()); ?>
            </aside>
            <section class="search span9">
                <div id="search_bar">

                </div>


                <div id="search_results">
                    <div class="alert-message clearfix">
                        <strong>
                            Danh sách bài thi TOEFL
                        </strong>
                        <div id="sort_results">
                            <form action="?">
                                Sắp xếp: 
                                <select>
                                    <option value="#">
                                        Ngày tháng
                                    </option>
                                    <option selected="" value="#">
                                        Hợp lý
                                    </option>
                                </select>
                            </form>
                        </div> 
                    </div>
                    <div class="toefl-course list-result">
                        <ul>
                            <?php foreach ($course as $c): ?>
                                <li class="clearfix">
                                    <div class="summary">
                                        <h4><a href="<?php echo Yii::app()->baseUrl?>/toefl/view/id/<?php echo $c['id']?>" value ="<?php echo $c['id'] ?>" class ="toefl-link"><?php echo $c['title'] ?></a></h4>
                                        

                                    </div>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                    <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
                </div>


            </section>
        </article>
    </div>
</div>