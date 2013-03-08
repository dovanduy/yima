<div class="row signup signin-up">
    <div class="container">
        <div class="span10 offset1">
            <h1>Đăng ký tài khoản</h1>
            <div class="row-fluid signup">
                <div class="span8 signup-form">
                    <?php echo Helper::print_error($message); ?>
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="email">Email</label>
                                <div class="controls"><input type="text" class="input-xlarge" name="email" id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="password">Mật khẩu</label>
                                <div class="controls"><input type="password" class="input-xlarge" name="pwd1" value=""></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="password">Xác nhận mật khẩu</label>
                                <div class="controls"><input type="password" class="input-xlarge" name="pwd2" value=""></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Họ và tên đệm</label>
                                <div class="controls"><input type="text" class="input-xlarge" name="lastname" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>"></div>
                            </div>  
                            <div class="control-group">
                                <label class="control-label">Tên</label>
                                <div class="controls"><input type="text" class="input-xlarge" name="firstname" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>"></div>
                            </div>      

                            <div class="controls">
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" value="remember" id="remember">
                                    Duy trì trạng thái đăng nhập
                                </label>
                                <p class="help-block">Khi click vào nút "Đăng ký" bên dưới, bạn xác nhận là đã đọc và đồng ý với những điều khoản sử dụng <a href="<?php echo Yii::app()->request->baseUrl; ?>/info/view/page/terms-conditions">tại đây</a>.</p>
                            </div>
                            <div class="form-actions submit">
                                <button class="btn btn-primary btn-large" type="submit">Đăng ký</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="span4 signup-contact">
                    Bạn đã đăng ký tài khoản rồi? <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/signin">Đăng nhập!</a><br/><br/>
                    <?php /*Nếu bạn vẫn còn thắc mắc về cách sử dụng <b>Yima.vn </b>, đừng ngần ngại gọi đến số <span class="label label-info">08.668.22033</span> để được tư vấn trực tiếp.*/?>
                </div>
            </div>
        </div>                    
    </div>
</div>
</div>