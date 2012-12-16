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
                    <div class="list-result">
                        <ul>
                            <?php foreach ($course as $c): ?>
                                <li class="clearfix">

                                    <div class="summary">
                                        <h4><a href="#" value ="<?php echo $c['id'] ?>" class ="toefl-link"><?php echo $c['title'] ?></a></h4>
                                        <div class ="toefl-test" id="toefl_<?php echo $c['id'] ?>">
                                            <ul>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/reading/<?php echo $c['reading1'] ?>"> Reading 1</a></li>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/reading/<?php echo $c['reading2'] ?>"> Reading 2</a></li>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/reading/<?php echo $c['reading3'] ?>"> Reading 3</a></li>
                                            </ul>
                                            <ul>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/listening/<?php echo $c['listening1'] ?>"> Listening 1</a></li>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/listening/<?php echo $c['listening2'] ?>"> Listening 2</a></li>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/listening/<?php echo $c['listening3'] ?>"> Listening 3</a></li>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/listening/<?php echo $c['listening4'] ?>"> Listening 4</a></li>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/listening/<?php echo $c['listening5'] ?>"> Listening 5</a></li>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/listening/<?php echo $c['listening6'] ?>"> Listening 6</a></li>
                                            </ul>
                                            <ul>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/speaking/<?php echo $c['speaking1'] ?>/<?php echo $c['speaking2'] ?>/<?php echo $c['speaking3'] ?>/<?php echo $c['speaking4'] ?>/<?php echo $c['speaking5'] ?>/<?php echo $c['speaking6'] ?>"> Speaking</a></li>
                                            </ul>
                                            <ul>
                                                <li><a target="_blank" href="<?php echo Yii::app()->request->hostInfo . Yii::app()->params['domain'] ?>toefl/writing/<?php echo $c['writing1'] ?>/<?php echo $c['writing2'] ?>"> Writing</a></li>
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