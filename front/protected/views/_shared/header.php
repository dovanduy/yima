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
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css?v=19112012" rel="stylesheet">

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo72.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo57.png">
        <script type="text/javascript">
            var baseUrl = '<?php echo Yii::app()->request->baseUrl; ?>' ;
            var ticketTax = '<?php echo Yii::app()->getParams()->itemAt('ticket_tax'); ?>';
            
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
        <?php /*
          <div class="navbar navbar-fixedp">
          <div class="navbar-inner">
          <div class="container clearfix">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo Helper::host_info(); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt=""/></a>
          <div class="nav-collapse pull-right clearfix">
          <div class="menu-top-contact pull-left">
          <i class="icon-circle-arrow-right icon-white"></i> <a href="<?php echo Yii::app()->request->baseUrl; ?>/contact">Liên hệ</a>
          <i class="icon-circle-arrow-right icon-white"></i> Gọi 08.668.22033 để được tư vấn trực tiếp
          </div>
          </div><!--/.nav-collapse -->
          </div>
          </div>
          </div> */ ?>
        <div class="top-header">
                <div class="container">
                    <div class="row-fluid">
                        <div class="span6"><a href="<?php echo Helper::host_info(); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt=""/></a></div>
                        <div class="span6 clearfix">
                            <div class="menu-top-contact pull-right">
                                <?php /*<i class="icon-circle-arrow-right"></i> Gọi <span class="label label-info">08.668.22033</span> để được tư vấn trực tiếp<br/>*/?>
                                <i class="icon-circle-arrow-right"></i> <a href="<?php echo Yii::app()->request->baseUrl; ?>/contact">Liên hệ</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="subnav <?php if(Yii::app()->params['is_page'] == "do_test") echo 'hide'; ?>">
            <div class="container clearfix">
                <ul class="nav nav-pills pull-left">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Trường / Trung tâm <b class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <?php foreach (HelperGlobal::get_featured_organization() as $or): ?>
                                <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/index/slug/<?php echo $or['slug'] ?>"><?php echo $or['title'] ?></a></li>

                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/test" class="bold">Tìm bài kiểm tra</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/create_test" class="bold">Soạn kiểm tra</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl" class="bold">TOEFL</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toeic/test/" class="bold">TOEIC</a></li>
                    <?php /*
                      <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/info/view/page/help" class="bold">Hướng dẫn sử dụng</a></li>
                      <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/faq/">Câu hỏi thường găp</a></li>
                      <li><a href="<?php echo Yii::app()->params['domain']; ?>4u/" class="bold">Yima4u</a></li>
                     */ ?>
                </ul>
                <ul class="nav nav-pills pull-right">
                    <?php if (!UserControl::LoggedIn()): ?>
                        <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/signup">Đăng ký</a></li>
                        <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/signin">Đăng nhập</a></li>
                    <?php else: ?>
                        <li class="dropdown nav-account">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" class="bold">Nạp tiền <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class=""><a href="#modal-paypal" data-toggle="modal"><i class="icon-shopping-cart"></i> Mua thẻ cào</a></li>
                                <li class="divider"></li>
                                <li class=""><a href="#modal-card" data-toggle="modal"><i class=" icon-filter"></i> Nhập mã số thẻ cào</a></li>
                                <li class=""><a href="#modal-coupon" data-toggle="modal"><i class="icon-briefcase"></i> Nhập coupon code</a></li>
                                <li class="divider"></li>
                                <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/transaction/"><i class="icon-tasks"></i> Lich sử giao dịch</a></li>
                                <li class="divider"></li>
                                <li class="">
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/transaction/">
                                        <div class="row-fluid">
                                            <span class="span5">Số dư</span>
                                            <span class="span7"><span class="label label-success" id="user-amount"><?php echo number_format(UserControl::getAmount(), 0, '.', '.'); ?>đ</span></span>                                        
                                        </div>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/transaction/type/paypal">
                                        <div class="row-fluid">
                                            <span class="span5">Đã mua</span>
                                            <span class="span7"><span class="label label-info"><?php echo number_format(UserControl::getPaid(), 0, '.', '.'); ?>đ</span></span>                                        
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown nav-account">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo UserControl::getFullname(); ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/test/type/created/"><i class="icon-plus-sign"></i> Bài kiểm tra của tôi</a></li>
                                <li class="divider"></li>
    <!--                                <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/profile">Trang cá nhân</a></li>-->
                                <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/setting"><i class="icon-cog"></i> Cài đặt tài khoản</a></li>
                                <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/password"><i class="icon-lock"></i> Đổi mật khẩu</a></li>
                                <li class="divider"></li>
                                <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/transaction"><i class="icon-tasks"></i> Lịch sử giao dịch</a></li>
                                <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/test/type/done/"><i class="icon-ok"></i> Bài kiểm tra đã làm</a></li>
                                <?php /* <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/test/type/toefl/"><i class="icon-ok"></i> Bài Toefl đã làm</a></li> */ ?>
                                <li class="divider"></li>
                                <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/signout"><i class="icon-off"></i> Thoát</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>