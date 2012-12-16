<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta name="robots" content="noindex,nofollow"/>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/ui-lightness/jquery-ui.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css?v=19112012" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox.css"  media="screen" />
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/ico/favicon.ico">

            <title>Yima.vn | Yes, It's my answer | Content Management</title>
            <script>
                var baseUrl = '<?php echo Yii::app()->request->baseUrl; ?>';
            </script>
    </head>

    <body>

        <header>
            <div class="navbar navbar-fixed-top navbar-inverse">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="btn btn-navbar " data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>                       
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>" class="brand">Yima.vn</a>
                        <div class="nav-collapse">
                            <?php /*
                              <ul class="nav pull-left">
                              <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a></li>
                              </ul>
                             */ ?>
                            <?php if (UserControl::LoggedIn()) : ?>
                                <ul class="nav pull-right">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Normal Test <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/testNT"><i class="icon-list-alt"></i> Normal Test</a></li>
<!--                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/question"><i class="icon-question-sign"></i> Question</a></li>-->
                                            <li class=""><a href="<?php echo Yii::app()->request->baseUrl ?>/testNT/finish/"><i class="icon-ok"></i> Finished</a></li>
                                            <li class=""><a href="<?php echo Yii::app()->request->baseUrl ?>/comment/index/type/test_nt/"><i class=" icon-envelope"></i> Comments</a></li>            
                                            <li class=""><a href="<?php echo Yii::app()->request->baseUrl ?>/report/index/type/test_nt/"><i class="icon-exclamation-sign"></i> Reports</a></li>     
                                            <li class=""><a href="<?php echo Yii::app()->request->baseUrl ?>/testNT/raw/"><i class="icon-download-alt"></i> Raw</a></li>     
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> TOEFL <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/source_test"><i class="icon-list-alt"></i> Source Test</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/reading/index/?part=1"><i class="icon-book"></i> R01</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/reading/index/?part=2"><i class="icon-book"></i> R02</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/reading/index/?part=3"><i class="icon-book"></i> R03</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/1"><i class="icon-headphones"></i> L01</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/2"><i class="icon-headphones"></i> L02</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/3"><i class="icon-headphones"></i> L03</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/4"><i class="icon-headphones"></i> L04</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/5"><i class="icon-headphones"></i> L05</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/6"><i class="icon-headphones"></i> L06</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/1"><i class="icon-signal"></i> Ind. S01</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/2"><i class="icon-signal"></i> Ind. S02</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/3"><i class="icon-signal"></i> Int.(L+R) S3</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/4"><i class="icon-signal"></i> Int.(L+R) S4</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/5"><i class="icon-signal"></i> Int. (L) S05</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/6"><i class="icon-signal"></i> Int. (L) S06</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/writing/index/part/1"><i class="icon-pencil"></i> Int. W01</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/writing/index/part/2"><i class="icon-pencil"></i> Ind. W02</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> TOEIC <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toeic/source_test"><i class="icon-list-alt"></i> Source Test</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toeic/reading"><i class="icon-book"></i>Reading</a></li>         
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toeic/listening"><i class="icon-headphones"></i>Listening</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Customer <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/grade/"><i class="icon-align-center"></i> Grade</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/organization/"><i class="icon-home"></i> Organization</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/faculty/"><i class="icon-bookmark"></i> Faculty</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/class/"><i class="icon-th-large"></i> Class</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/subject/"><i class="icon-folder-open"></i> Subject</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/subject/mod/"><i class="icon-fire"></i> Subject Mods</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/keyword_searching_test/"><i class="icon-hdd"></i> Keyword</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/coupon/"><i class="icon-star"></i> Coupon Codes</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/card/type/"><i class="icon-move"></i> Card Types</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/card/"><i class="icon-th-large"></i> Cards</a></li>
                                        </ul>
                                    </li>                                    
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Payment <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li class="<?php if (Yii::app()->params['page'] == "transaction") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl ?>/transaction/"><i class="icon-th-list"></i> Transactions</a></li>
                                            <li class="<?php if (Yii::app()->params['page'] == "tracking") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl ?>/tracking/"><i class="icon-briefcase"></i> Tracking</a></li>
                                            <li class="<?php if (Yii::app()->params['page'] == "paypal") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl ?>/paypal/"><i class=" icon-certificate"></i> Paypal</a></li>
                                        </ul>
                                    </li>                                    
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 4u <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li class="<?php if (Yii::app()->params['group'] == "4u" && Yii::app()->params['page'] == "post") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl ?>/4u/post"><i class="icon-list-alt"></i> Posts</a></li>            
                                            <li class="<?php if (Yii::app()->params['group'] == "4u" && Yii::app()->params['page'] == "comment") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl ?>/comment"><i class=" icon-envelope"></i> Comments</a></li>            
                                            <li class="<?php if (Yii::app()->params['group'] == "4u" && Yii::app()->params['page'] == "report") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl ?>/report"><i class="icon-exclamation-sign"></i> Reports</a></li>            
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> FAQs <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/categoryfaq"><i class="icon-list-alt"></i>Categories</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/faq"><i class="icon-list-alt"></i>FAQs</a></li>
                                        </ul>
                                    </li>                                    
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo UserControl::getTitle(); ?> <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/admin/"><i class="icon-eye-open"></i> Admin</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/user/"><i class="icon-user"></i> User</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/option/"><i class="icon-tint"></i> Site Options</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/log/"><i class="icon-search"></i> Log</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/password">Change Password</a></li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/logout">Sign Out</a></li>
                                        </ul>
                                    </li> 
                                </ul>
                            <?php endif; ?>

                            <?php /* if (!UserControl::LoggedIn()): ?>
                              <ul class="nav pull-right">
                              <li><a href="<?php echo Yii::app()->request->baseUrl ?>/home/language/lang/vn">Tiếng việt</a></li>
                              <li><a href="<?php echo Yii::app()->request->baseUrl ?>/home/language/lang/en">English</a></li>
                              </ul>
                              <?php endif; */ ?>
                        </div>
                    </div> 
                </div>
            </div>
        </header>