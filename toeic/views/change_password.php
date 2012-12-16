<section role="main">

    <a href="<?php echo base_url(); ?>" title="Back to Homepage"></a>

    <!-- Login box -->
    <article id="login-box">

        <div class="article-container">

            <p>Type in your username and password in 2 boxes below.</p>

            <!-- Notification -->
            <div class="notification error" style="display: none;">
                <a href="#" class="close-notification" title="Hide Notification" rel="tooltip">x</a>
                <p>Your password doesn't match. Please try again!</p>
            </div>
            <!-- /Notification -->

            <form action="<?php echo base_url(); ?>login_command" id="login_form" method="post">
                <input type="hidden" name="action" value="change_password">
                <fieldset>
                    <dl>
                        <dt><label>New</label></dt>
                        <dd><input class="large" type="password" name="password"></dd>
                        <dt><label>Confirm</label></dt>
                        <dd><input class="large" type="password" name="confirm"></dd>
                    </dl>
                </fieldset>
                <button type="submit" class="right">Change</button>
            </form>

        </div>

    </article>
    <!-- /Login box -->

</section>

<!-- JS Libs at the end for faster loading -->
<script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="js/jquery/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
<script src="<?php echo base_url(); ?>js/selectivizr.js"></script>
<script src="<?php echo base_url(); ?>js/jquery_002.js"></script>
<script src="<?php echo base_url(); ?>js/login.js"></script>
<script>
    $().ready(function(){
        $('#login_form').submit(function(e){
            e.preventDefault();
            var options ={
                beforeSubmit:  function(){},
                type:'POST',// pre-submit callback 
                success: function(getData){
                    if (getData['status']=='success'){
                        $('.article-container').html('Your new password is updated!');
                    }else{
                        $('.notification').slideDown(600, function () {
                            $(this).fadeTo(350, 1);
                        });
                    }                            
                },
                dataType:  'json'
            }
            $('#login_form').ajaxSubmit(options);
        });
                
        $('.session').live('click',function(){
            var url = '<?php echo base_url(); ?>login_command';
            var session_id = $(this).attr('alt');
            var action = 'select_session';
            $.post(url,{session_id:session_id, action:action}, function(response) {
                window.location= "<?php echo base_url(); ?>start";
            }, 'json');
        });
    });
</script>
