<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">
            <?php $this->renderPartial('sidebar'); ?>

            <section class="span9">
                <div id="search_results">         
                    <ul class="breadcrumb">
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Trang chủ</a> <span class="divider">/</span></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl."/user/test/type/created/" ?>">Bài kiểm tra</a> <span class="divider">/</span></li>
                        <li class="active"><?php echo $test['title'] ?></li>
                    </ul>
                    <legend>Sửa bài kiểm tra</legend>

                    <ul class="nav nav-tabs">
                        <li class="<?php if ($type == "general") echo 'active'; ?>">
                            <a href="<?php echo Yii::app()->request->baseUrl . "/create_test/edit/id/$test[id]/" ?>">Thông tin chung</a>
                        </li>
                        <li class="<?php if ($type == "question") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl . "/create_test/edit/id/$test[id]/type/question/" ?>">Câu hỏi</a></li>                        
                    </ul>

                    <?php echo Helper::print_error($message); ?>
                    <?php echo Helper::print_success($message); ?>

                    <?php if ($type == "general"): ?>
                        <?php $this->renderPartial('edit_test', array('test' => $test, 'organization' => $organization, 'section' => $section)); ?>
                    <?php endif; ?>

                    <?php if ($type == "question"): ?>
                        <?php $this->renderPartial('manage_question', array('test' => $test, 'questions' => $questions)); ?>
                    <?php endif; ?>

                </div>
            </section>
        </article>
    </div>
</div>