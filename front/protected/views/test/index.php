
<?php $this->renderPartial('search_sidebar', array('test_categories' => $test_categories, 'test_organizations' => $test_organizations, 'query_string' => $query_string)); ?>
<section class="search span9">

    <?php $this->renderPartial('search_bar', array('query_string' => $query_string)); ?>

    <div id="search_results">
        <div class="alert-message clearfix">
            <strong>
                Kết quả tìm kiếm
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
        <div class="list-result search-page">
            <ul>
                <?php if (count($tests) < 1): ?>
                    <li>Không có bài kiểm tra nào</li>
                <?php endif; ?>
                <?php foreach ($tests as $n): ?>
                    <li>
                        <a class="book-cover" href="<?php echo Yii::app()->baseUrl ?>/test/view/s/<?php echo $n['slug'] ?>">
                            <span class="inner">
                                <?php echo $n['title']; ?>
                            </span>
                        </a>
                        <div class="summary">
                            <div class="title"><a href="<?php echo Yii::app()->baseUrl ?>/test/view/s/<?php echo $n['slug'] ?>"><?php echo $n['subject_title'] ?></a></div>
                            <div class="price">Giá: <?php if ($n['price'] == 0) echo '<span class="label label-success">miễn phí</span>'; else echo '<span class="label label-info">' . number_format($n['price'], 0, '.', '.') . ' đ</span>'; ?></div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div> 
        <div class="clearfix"></div>
        <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
    </div>


</section>