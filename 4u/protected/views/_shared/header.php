<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Yima.vn | Yes, It's my answer</title>

        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="robots" content="noindex, nofollow"/>

        <!-- Le styles -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
        <?php /* <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet"> */ ?>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/libs.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/themes/start/jquery.ui.all.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/event.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css?v=1" rel="stylesheet">

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo72.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo57.png">
        <script type="text/javascript">
            var baseUrl = '<?php echo Yii::app()->request->baseUrl; ?>' ;
            var baseDomain = '<?php echo Helper::domain(); ?>';
            var httpReferer = '<?php echo $_SERVER['REQUEST_URI']; ?>';
        </script>
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-19815313-11']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </head>

    <body>
        <div class="top-header">
                <div class="container">
                    <div class="row-fluid">
                        <div class="span6"><a href="<?php echo Helper::host_info(); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt=""/></a></div>
                        <div class="span6">
                            <div class="menu-top-contact pull-right">
                                <?php /* <i class="icon-circle-arrow-right"></i> Gọi <span class="label label-info">08.668.22033</span> để được tư vấn trực tiếp<br/> */ ?>
                                <i class="icon-circle-arrow-right"></i> <a href="<?php echo Yii::app()->request->baseUrl; ?>/contact">Liên hệ</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="subnav">
            <div class="container clearfix">

                <ul class="nav nav-pills pull-left clearfix">

                    <li><a class="bold" href="<?php echo Yii::app()->request->baseUrl; ?>">Trang chủ</a></li>        
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/post/search/">Tìm kiếm câu hỏi</a></li>

                    <li><a class="bold" href="<?php echo Yii::app()->request->baseUrl; ?>/post/add/">Gửi câu hỏi</a></li>
                </ul>

                <ul class="nav nav-pills pull-right clearfix">
                    <?php if (!UserControl::LoggedIn()): ?>
                        <li class=""><a href="<?php echo Yii::app()->request->hostInfo; ?>/yima/front/user/signup">Đăng ký</a></li>
                        <li class=""><a href="<?php echo Yii::app()->request->hostInfo; ?>/yima/front/user/signin">Đăng nhập</a></li>
                    <?php else: ?>

                        <li class="dropdown nav-account">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" class="bold">Nạp tiền <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class=""><a href="/yima/front/user/profile">Mua thẻ cào</a></li>
                                <li class="divider"></li>
                                <li class=""><a href="/yima/front/user/profile">Nhập mã số thẻ cào</a></li>
                                <li class=""><a href="/yima/front/user/profile">Nhập coupon code</a></li>
                                <li class="divider"></li>
                                <li class=""><a href="/yima/front/user/settings">Lich sử giao dịch</a></li>
                                <li class="divider"></li>
                                <li class=""><a href="/yima/front/user/settings">Số dư <span class="label label-success">1.000.000đ</span></a></li>
                                <li class=""><a href="/yima/front/user/settings">Đã mua <span class="label label-info">500.000đ</span></a></li>
                            </ul>
                        </li> 
                        <?php /* <li class="dropdown nav-account">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo UserControl::getFullname(); ?> <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                          <li class=""><a href="/yima/front/user/profile">Trang cá nhân</a></li>
                          <li class=""><a href="/yima/front/user/setting">Cài đặt tài khoản</a></li>
                          <li class="divider"></li>
                          <li class=""><a href="/yima/front/user/signout">Thoát</a></li>
                          </ul>
                          </li> */ ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>