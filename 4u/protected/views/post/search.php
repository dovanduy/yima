
<?php //$this->renderPartial('search_sidebar', array('organizations'=>$organizations,'subjects'=>$subjects));  ?>
<section class="search span12">

    <?php $this->renderPartial('search_bar', array('organizations' => $organizations, 'subjects' => $subjects)); ?>

    <div id="search_results">
        <div class="alert-message clearfix">
            <strong>
                Danh sách câu hỏi
            </strong>
            <?php /* <div id="sort_results">
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
              </div> */ ?>
        </div>
        <ul class="nav nav-tabs">
            <li class="<?php if (Yii::app()->params['page'] == "hay") echo 'active'; ?>">
                <a href="<?php if (Yii::app()->params['page'] == "hay") echo "#";else echo Yii::app()->request->baseUrl ?>/post/search/type/hay/?<?php echo $_SERVER['QUERY_STRING']; ?>">Chuẩn</a>
            </li>
            <li class="<?php if (Yii::app()->params['page'] == "new") echo 'active'; ?>"><a href="<?php if (Yii::app()->params['page'] == "new") echo "#";else echo Yii::app()->request->baseUrl ?>/post/search/type/new/?<?php echo $_SERVER['QUERY_STRING']; ?>">Mới</a></li>
        </ul>
        <div class="list-result">
            <ul>
                <?php if (count($posts) < 1): ?>
                    <li>Không có bài câu hỏi nào.</li>
                <?php endif; ?>
                <?php foreach ($posts as $v): ?>
                    <li class="clearfix">
                        <div class="date">
                            <img class="img-polaroid" width="70" src="<?php echo HelperApp::get_thumbnail($v['thumbnail']); ?>"/>
                        </div>
                        <div class="summary">
                            <h4><a  href="<?php echo Yii::app()->request->baseUrl; ?>/post/view/s/<?php echo $v['slug']; ?>"><?php echo $v['title']; ?></a></h4>
                            <div class="clearfix sub-info">
                                <a class="" href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/?sid=<?php echo $v['subject_id'] ?>"><?php echo $v['subject_name'] ?></a>
                                - <?php echo DateTimeFormat::nicetime($v['date_added']); ?>
                                - <span class="total-vote"><a href="<?php echo Yii::app()->request->baseUrl . "/post/view/s/" . $v['slug'] ?>"><i class="icon-comment"></i> <?php echo $v['total_comment'] ?></a></span>                       
                                - <span class="total-vote"><a href="<?php echo Yii::app()->request->baseUrl . "/post/view/s/" . $v['slug'] ?>"><i class="icon-thumbs-up"></i> <?php echo $v['total_like'] ?></a></span>
                                <?php if ($v['organization_id']): ?>                                    
                                    <br/>
                                    <strong>Trường/Trung tâm:</strong> <a href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/?oid=<?php echo $v['organization_id'] ?>" class=""><?php echo $v['organization_name']; ?></a>
                                <?php endif; ?>                            
                            </div>

                        </div>
                    </li>

                <?php endforeach; ?>
            </ul>
        </div>
        <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
    </div>


</section>