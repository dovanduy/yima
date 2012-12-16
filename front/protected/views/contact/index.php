<div class="row signup">
    <div class="container contact">
        <div class="span8 offset2">
            <div class="row-fluid signup">
                <div class="span12 signup-form">
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <legend><h1>Liên hệ</h1></legend>
                            <?php echo Helper::print_error($message); ?>
                            <?php echo Helper::print_success($message); ?>
                            <div class="control-group">
                                <label class="control-label">Họ và tên đệm</label>
                                <div class="controls"><input type="text" class="input-xlarge" name="lastname" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>"></div>
                            </div>  
                            <div class="control-group">
                                <label class="control-label">Tên</label>
                                <div class="controls"><input type="text" class="input-xlarge" name="firstname" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>"></div>
                            </div>  
                            <div class="control-group">
                                <label class="control-label" for="email">Email</label>
                                <div class="controls"><input type="text" class="input-xlarge" name="email" id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">ĐTDĐ / ĐT bàn</label>
                                <div class="controls"><input type="text" class="input-xlarge" name="phone" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>"></div>
                            </div> 
                            <div class="control-group">
                                <label class="control-label">Nội dung</label>
                                <div class="controls"><textarea class="input-xlarge" name="content" rows="5"></textarea>
                                </div> 
                                <div class="form-actions submit">
                                    <button class="btn btn-primary btn-large" type="submit">Gửi liên hệ</button>
                                </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>                    
    </div>
</div>
</div>