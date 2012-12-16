<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">
            <aside class="sidebar span3">
                <?php $this->renderPartial('test_sidebar', array()); ?>
            </aside>
            <section class="search span9">
                <div id="search_bar">
                </div>

                <div id="search_results">
                    <div class="alert-message clearfix">
                        <strong>
                            Danh sách bài thi TOEIC
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
                    <div class="list-result">
                        <ul>
                            <?php foreach ($tests as $t): ?>
                                <li class="clearfix">

                                    <div class="summary">
                                        <h4><a href="#" value ="<?php echo $t['id'] ?>" class ="toeic-link"><?php echo $t['title'] ?></a></h4>
                                        <div class ="toeic-test" id="toeic_<?php echo $t['id'] ?>">
                                            <ul>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toeic/reading/<?php echo $t['reading'] ?>"> Reading </a></li>
                                            </ul>
                                            <ul>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toeic/listening/<?php echo $t['listening'] ?>"> Listening </a></li>
                                            </ul>

                                        </div>

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