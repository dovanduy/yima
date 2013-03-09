
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
                        <td>Không tìm thấy đề phù hợp.</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($tests as $n): ?>
                    <tr>
                        <td>YIMA-<?php echo Helper::_parse_id($n['id']) ?></td>
                        <td class="align-left">
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/test/view/s/<?php echo $n['slug'] ?>"><?php echo $n['title']; ?></a><br/>
                            Loại: <?php echo $n['section_title'] ?><br/>
                            Chủ đề: <a rel="tooltip" title="<?php echo $n['subject_title']; ?>" href="<?php echo Yii::app()->request->baseUrl ?>/test/?cid=<?php echo $n['subject_id']; ?>"><?php echo Helper::string_truncate($n['subject_title']); ?></a>
                        </td>
                        <td class="align-left">
                            <a rel="tooltip" title="<?php echo $n['org_title']; ?>" href="<?php echo Yii::app()->request->baseUrl; ?>/test/?oid=<?php echo $n['organization_id'] ?>"><?php echo $n['org_title']; ?></a><br/>
                            Khoa: <a rel="tooltip" title="<?php echo $n['faculty_name']; ?>" href=""><?php echo $n['faculty_name']; ?></a>
                        </td>
                        <td>
                            <?php if ($n['price'] == 0): ?>
                                <span class="label label-success">Miễn phí</span>
                            <?php else: ?>
                                <span class="label label-info"><?php echo number_format($n['price'], 0, '.', '.'); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="" class="btn btn-small">Chi tiết</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div> 
        <div class="clearfix"></div>
        <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
    </div>


</section>