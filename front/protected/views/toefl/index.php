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
                    <table class="table table-bordered table-striped table-center">
                        <tr>
                            <th>Mã số</th>
                            <th>Tên</th>

                            <th></th>
                        </tr>
                        <?php if (count($toefl) < 1): ?>
                            <tr>
                                <td colspan="3">Không tìm thấy đề phù hợp.</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($toefl as $n): ?>
                            <tr>
                                <td>TOEFL-<?php echo Helper::_parse_id($n['id']) ?></td>
                                <td class="align-left">
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/view/id/<?php echo $n['id'] ?>"><?php echo $n['title']; ?></a><br/>

                                </td>
                                <td>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/view/id/<?php echo $n['id'] ?>" class="btn btn-small">Chi tiết</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
                </div>


            </section>
        </article>
    </div>
</div>