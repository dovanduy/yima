<?php $this->renderPartial('sidebar', array()); ?>
<section class="search span9">
    <div id="user-info">
        <?php echo Helper::print_error($message); ?>
        <?php echo Helper::print_success($message); ?>        
        
        <div class="head">
            <legend>Đổi mật khẩu</legend>
        </div>
        
        <div class="password block">
            <div class="row-fluid">
                <form class="form-horizontal" method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/user/password/">
                    
                    
                    <div class="control-group">
                        <label class="control-label">Mật khẩu cũ</label>
                        <div class="controls">
                            <input class="input-xlarge" type="password" name="oldpwd" value="" >
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Mật khẩu mới</label>
                        <div class="controls">
                            <input class="input-xlarge" type="password" name="pwd1" value="" >
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Xác nhận</label>
                        <div class="controls">
                            <input class="input-xlarge" type="password" name="pwd2" value="" >
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