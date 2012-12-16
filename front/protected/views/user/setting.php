<?php $this->renderPartial('sidebar', array()); ?>
<section class="search span9">
    <div id="user-info">
        <?php echo Helper::print_error($message); ?>
        <?php echo Helper::print_success($message); ?>
        <div class="head">
            <legend>Ảnh đại diện</legend>
        </div>
        <div class="avatar block ">
            <div class="row-fluid">
                <div class="span2">
                    <img width="80" class="img-polaroid" src="<?php echo HelperApp::get_thumbnail(UserControl::getThumbnail(),'small'); ?>" />
                </div>
                <div class="span10">

                    <form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/user/avatar/" enctype="multipart/form-data">
                        <p>
                            <input type="file" name="avatar" /><br/>
                            <span class="help-block" style="margin-top: 7px">Lưu ý: Ảnh đại diện có kích thước tối thiểu 150x150 pixel, size tối đa 1MB</span>
                        </p>
                        <p>
                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                        </p>
                    </form>

                </div>
            </div>
        </div>

        <div class="head">
            <legend>Thông tin cá nhân</legend>
        </div>

        <div class="setting block">
            <div class="row-fluid">
                <form class="form-horizontal" method="post">
                    <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" value="<?php echo UserControl::getEmail(); ?>" disabled="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Ngày tham gia</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" disabled="" value="<?php echo date('d-m-Y',  UserControl::getDateAdded()); ?> (<?php echo DateTimeFormat::nicetime(UserControl::getDateAdded()) ?>)" />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Họ</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" name="lastname" value="<?php if(isset($_POST['lastname'])) echo htmlspecialchars ($_POST['lastname']);else echo UserControl::getLastName(); ?>" >
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Tên</label>
                        <div class="controls">
                            <input class="input-xlarge" type="text" name="firstname" value="<?php if(isset($_POST['firstname'])) echo htmlspecialchars ($_POST['firstname']);else echo UserControl::getFirstName(); ?>" >
                        </div>
                    </div>
                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</section>