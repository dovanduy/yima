<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">
            <?php $this->renderPartial('sidebar'); ?>

            <section class="span9">
                <div id="search_results">         
                    <ul class="breadcrumb">
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Trang chủ</a> <span class="divider">/</span></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl."/user/test/type/created/" ?>">Bài kiểm tra</a> <span class="divider">/</span></li>
                        <li class="active">Thêm</li>
                    </ul>
                    <legend>Soạn bài kiểm tra</legend>                    
                    <?php echo Helper::print_error($message); ?>            
                    <div class="add-test"> 
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Tên bài kiểm tra</label>
                                <div class="controls">
                                    <input type="text" class="span12" name="title" value="<?php if (isset($_POST['title'])) echo htmlspecialchars($_POST['title']); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Tóm tắt</label>
                                <div class="controls">
                                    <textarea name="descrip" rows="7" class="span12"><?php if (isset($_POST['descrip'])) echo $_POST['descrip']; ?></textarea>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Tài liệu Scan</label>
                                <div class="controls">
                                    <input type="file" name="attach_file" />
                                    <p class="help-block"><i>Lưu ý: Tài liệu scan định dạng PDF, dung lượng tối đa 3MB</i></p>                                    
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Trường</label>
                                <div class="controls">
                                    <select link="<?php echo Yii::app()->baseUrl ?>/create_test/get_faculty_by_organizaiton/"  class="span12 organization" name="organization">
                                        <option value="0">--- Trường/Trung tâm ---</option>
                                        <?php foreach ($organization as $o): ?>
                                            <option <?php if (isset($_POST['organization']) && $_POST['organization'] == $o['id']) echo 'selected'; ?> value="<?php echo $o['id']; ?>"><?php echo $o['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" value="<?php echo isset($_POST['faculty']) ? $_POST['faculty'] : 0; ?>" id="current_faculty_id"/>
                            <input type="hidden" value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : 0; ?>" id="current_subject_id"/>
                            <input type="hidden" value="<?php echo isset($_POST['organization']) ? $_POST['organization'] : 0; ?>" id="current_organization_id"/>
                            <div class="control-group faculty hide">
                                <label class="control-label">Khoa</label>
                                <div class="controls">
                                    <select class="span12 list-faculty" name="faculty">

                                    </select>
                                </div>
                            </div>

                            <div class="control-group subject hide">
                                <label class="control-label">Chủ đề</label>
                                <div class="controls">
                                    <select class="span12 list-subject" name="subject">       

                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Phân Loại</label>
                                <div class="controls">
                                    <select  class="span12" name="section">
                                        <option value="0">--- Loại ---</option>
                                        <?php foreach ($section as $s): ?>
                                            <option <?php if (isset($_POST['section']) && $_POST['section'] == $s['id']) echo 'selected'; ?> value="<?php echo $s['id']; ?>"><?php echo $s['title']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>



                            <div class="control-group">
                                <label class="control-label">Giá tiền</label>
                                <div class="controls">
                                    <div class="input-append">
                                        <input type="text" class="input-medium" name="price" value="<?php if (isset($_POST['price'])) echo htmlspecialchars($_POST['price']); ?>">
                                        <span class="add-on" style="margin-left: -4px">VNĐ</span>
                                    </div>

                                    <p class="help-block">Lưu ý: Giá tiền phải chia hết cho 500</p>
                                </div>
                            </div>


                            <div class="form-actions">        
                                <button type="submit" class="btn btn-primary btn-large">Tạo bài kiểm tra</button>
                                <button type="button" class="btn btn-large pull-right" onclick="history.go(-1);return false;">Hủy</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </article>
    </div>
</div>