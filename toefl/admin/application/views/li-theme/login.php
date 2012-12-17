<!DOCTYPE html>
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop no-websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms no-csstransforms3d csstransitions fontface video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang="en"><!--<![endif]--><head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>TOEFL iBT | Administrator</title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name='robots' content='noindex,nofollow' />

        <link rel="shortcut icon" href="<?php echo theme_url(); ?>favicon.ico">
        <link rel="apple-touch-icon" href="<?php echo theme_url(); ?>apple-touch-icon.png">

        <!-- CSS Styles -->
        <link rel="stylesheet" href="<?php echo theme_url(); ?>css/style.css">
        <link rel="stylesheet" href="<?php echo theme_url(); ?>css/colors.css">
        <link rel="stylesheet" href="<?php echo theme_url(); ?>css/jquery_005.css">
        <link rel="stylesheet" href="<?php echo theme_url(); ?>css/jquery.css">
        <link rel="stylesheet" href="<?php echo theme_url(); ?>css/jquery_006.css">
        <link rel="stylesheet" href="<?php echo theme_url(); ?>css/jquery_003.css">
        <link rel="stylesheet" href="<?php echo theme_url(); ?>css/jquery_002.css">
        <link rel="stylesheet" href="<?php echo theme_url(); ?>css/jquery_008.css">
        <link rel="stylesheet" href="<?php echo theme_url(); ?>css/jquery_004.css">
        <link rel="stylesheet" href="<?php echo theme_url(); ?>css/jquery_007.css">

        <!-- Google WebFonts -->
        <link href="<?php echo theme_url(); ?>css/css.css" rel="stylesheet" type="text/css">

        <script src="<?php echo theme_url(); ?>js/ga.js" async=""></script>
        <script src="<?php echo theme_url(); ?>js/modernizr-1.js"></script>
    </head>
    <body class="login">
        <section role="main">

            <a href="<?php echo theme_url(); ?>" title="Back to Homepage"></a>

            <!-- Login box -->
            <article id="login-box">

                <div class="article-container">

                    <p>Type in your username and password in 2 boxes below.</p>

                    <!-- Notification -->
                    <div class="notification error" style="display: none;">
                        <a href="#" class="close-notification" title="Hide Notification" rel="tooltip">x</a>
                        <p>Your username or password is incorrect. Please try again!</p>
                    </div>
                    <!-- /Notification -->

                    <form action="<?php echo base_url(); ?>login/check" id="login_form">
                        <input type="hidden" name="action" value="check_login">
                        <fieldset>
                            <dl>
                                <dt><label>Login</label></dt>
                                <dd style="width: 270px;"><input class="large" type="text" name="username"></dd>
                                <dt><label>Password</label></dt>
                                <dd style="width: 270px;"><input class="large" type="password" name="password"></dd>
                            </dl>
                        </fieldset>
                        <button type="submit" class="right">Log in</button>
                    </form>

                </div>

            </article>
            <!-- /Login box -->

        </section>

        <!-- JS Libs at the end for faster loading -->
        <script src="<?php echo theme_url(); ?>js/jquery.js"></script>
        <script src="<?php echo theme_url(); ?>js/jquery.form.js"></script>
        <script>!window.jQuery && document.write(unescape('%3Cscript src="js/jquery/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
        <script src="<?php echo theme_url(); ?>js/selectivizr.js"></script>
        <script src="<?php echo theme_url(); ?>js/jquery_002.js"></script>
        <script src="<?php echo theme_url(); ?>js/login.js"></script>
        <script>
            $().ready(function(){
                height=$(window).height();
                var vinTop = (height - 200 - $('.login section[role="main"]').height())/2;
                if(vinTop<0)vinTop=0;
                $('.login section[role="main"]').css("margin-top", vinTop + 'px');
                
                
                $('#login_form').submit(function(e){
                    e.preventDefault();
                    var options ={
                        beforeSubmit:  function(){},
                        type:'POST',// pre-submit callback 
                        success: function(getData){
                            if (getData['status']=='success'){
                                window.location = getData['back_url'];
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
            });
        </script>
    </body>
</html>