<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">
            <aside class="sidebar span3">
                <div class="sidebar-wrap">
                    <div id="filter_date" class="filter">
                        <h3>Môn học</h3>
                        <ul>
                            <?php foreach($subject as $s):?>
                            <li>
                                <a href="<?php echo Yii::app()->baseUrl?>/organization/index/slug/<?php echo $slug?>/subject_id/<?php echo $s['subject_id']?>"><?php echo $s['subject_title'] ?></a>
                               
                            </li>
                            
                            <?php endforeach;?>
                           
                        </ul>
                    </div>
                </div>
            </aside>
            
            
            <section class="search span9">
                <div id="search_results">
                    <div class="alert-message clearfix">
                        <strong>
                            <?php echo $organization['title']?>
                        </strong>
                    </div>
                    
                    <div class="list-result">
                        <ul>
                            <?php foreach ($question as $q):?>
                            <li class="clearfix">
                                <div class="date">
                                    <p><strong>SUN</strong>Aug 19</p>
                                </div>
                                <div class="summary">
                                    <h4><a href="#"><?php echo $q['knt_title']?></a></h4>                                   
                                </div>
                            </li>
                            <?php endforeach;?>
                            
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