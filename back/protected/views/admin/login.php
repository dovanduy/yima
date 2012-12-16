
<div class="login-box">
    <div class="icons">
        <a href="index.html"><i class="icon-home"></i></a>
        <a href="#"><i class="icon-cog"></i></a>
    </div>
    <?php echo Helper::print_error($message); ?>
    <h2>Login to your account</h2>
    <form class="form-horizontal" action="" method="post">
        <fieldset>

            <div class="input-prepend" title="Username">
                <span class="add-on"><i class="icon-user"></i></span>
                <input class="input-large span10" name="title" id="username" type="text" placeholder="type username" value="<?php echo isset($_POST['title']) ? $_POST['title'] : "" ?>"/>
            </div>
            <div class="clearfix"></div>

            <div class="input-prepend" title="Password">
                <span class="add-on"><i class="icon-lock"></i></span>
                <input class="input-large span10" name="password" id="password" type="password" placeholder="type password"/>
            </div>
            <div class="clearfix"></div>

            <label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>

            <div class="button-login">	
                <button type="submit" class="btn btn-primary"><i class="icon-off icon-white"></i> Login</button>
            </div>
            <div class="clearfix"></div>
    </form>
    <hr>
    <h3>Forgot Password?</h3>
    <p>
        No problem, <a href="#">click here</a> to get a new password.
    </p>	
</div><!--/span-->