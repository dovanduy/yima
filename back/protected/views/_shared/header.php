<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- start: Meta -->
        <meta charset="utf-8">
        <title>Yima.vn | Content Management</title>
        <meta name="description" content="Yima.vn | Content Management">
        <meta name="author" content="HTML5 Media">
        <meta name="robots" content="noindex,nofollow"/>
        <!-- end: Meta -->

        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- end: Mobile Specific -->

        <!-- start: CSS -->
        <link id="bootstrap-style" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox.css" rel="stylesheet">
        <link id="base-style" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
        <link id="base-style-responsive" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style-responsive.css" rel="stylesheet">
        <link id="base-style-responsive" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" rel="stylesheet">

        <!--[if lt IE 7 ]>
        <link id="ie-style" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style-ie.css" rel="stylesheet">
        <![endif]-->
        <!--[if IE 8 ]>
        <link id="ie-style" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style-ie.css" rel="stylesheet">
        <![endif]-->
        <!--[if IE 9 ]>
        <![endif]-->

        <!-- end: CSS -->


        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- start: Favicon -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/ico/favicon.ico?v=1">
        <!-- end: Favicon -->

        <script>
            var baseUrl = '<?php echo Yii::app()->request->baseUrl; ?>';
        </script>


    </head>

    <body>
        <div id="overlay">
            <ul>
                <li class="li1"></li>
                <li class="li2"></li>
                <li class="li3"></li>
                <li class="li4"></li>
                <li class="li5"></li>
                <li class="li6"></li>
            </ul>
        </div>	
        <!-- start: Header -->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>                    
                    <!-- start: Header Menu -->
                    <div class="nav-no-collapse header-nav">
                        <ul class="nav pull-right">
                            <li class="dropdown hidden-phone">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="icon-warning-sign icon-white"></i> <span class="label label-important hidden-phone">2</span> <span class="label label-success hidden-phone">11</span>
                                </a>
                                <ul class="dropdown-menu notifications">
                                    <li>
                                        <span class="dropdown-menu-title">You have 11 notifications</span>
                                    </li>	
                                    <li>
                                        <a href="#">
                                            + <i class="icon-user"></i> <span class="message">New user registration</span> <span class="time">1 min</span> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            + <i class="icon-comment"></i> <span class="message">New comment</span> <span class="time">7 min</span> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            + <i class="icon-comment"></i> <span class="message">New comment</span> <span class="time">8 min</span> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            + <i class="icon-comment"></i> <span class="message">New comment</span> <span class="time">16 min</span> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            + <i class="icon-user"></i> <span class="message">New user registration</span> <span class="time">36 min</span> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            + <i class="icon-shopping-cart"></i> <span class="message">2 items sold</span> <span class="time">1 hour</span> 
                                        </a>
                                    </li>
                                    <li class="warning">
                                        <a href="#">
                                            - <i class="icon-user icon-red"></i> <span class="message">User deleted account</span> <span class="time">2 hour</span> 
                                        </a>
                                    </li>
                                    <li class="warning">
                                        <a href="#">
                                            - <i class="icon-shopping-cart icon-red"></i> <span class="message">Transaction was canceled</span> <span class="time">6 hour</span> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            + <i class="icon-comment"></i> <span class="message">New comment</span> <span class="time">yesterday</span> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            + <i class="icon-user"></i> <span class="message">New user registration</span> <span class="time">yesterday</span> 
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-menu-sub-footer">View all notifications</a>
                                    </li>	
                                </ul>
                            </li>
                            <!-- start: Notifications Dropdown -->
                            <li class="dropdown hidden-phone">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="icon-tasks icon-white"></i> <span class="label label-warning hidden-phone">17</span>
                                </a>
                                <ul class="dropdown-menu tasks">
                                    <li>
                                        <span class="dropdown-menu-title">You have 17 tasks in progress</span>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="header">
                                                <span class="title">iOS Development</span>
                                                <span class="percent"></span>
                                            </span>
                                            <div class="taskProgress progressSlim progressYellow">80</div> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="header">
                                                <span class="title">Android Development</span>
                                                <span class="percent"></span>
                                            </span>
                                            <div class="taskProgress progressSlim progressYellow">47</div> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="header">
                                                <span class="title">Django Project For Google</span>
                                                <span class="percent"></span>
                                            </span>
                                            <div class="taskProgress progressSlim progressYellow">32</div> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="header">
                                                <span class="title">SEO for new sites</span>
                                                <span class="percent"></span>
                                            </span>
                                            <div class="taskProgress progressSlim progressYellow">63</div> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="header">
                                                <span class="title">New blog posts</span>
                                                <span class="percent"></span>
                                            </span>
                                            <div class="taskProgress progressSlim progressYellow">80</div> 
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-menu-sub-footer">View all tasks</a>
                                    </li>	
                                </ul>
                            </li>
                            <!-- end: Notifications Dropdown -->
                            <!-- start: Message Dropdown -->
                            <li class="dropdown hidden-phone">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="icon-envelope icon-white"></i> <span class="label label-success hidden-phone">9</span>
                                </a>
                                <ul class="dropdown-menu messages">
                                    <li>
                                        <span class="dropdown-menu-title">You have 9 messages</span>
                                    </li>	
                                    <li>
                                        <a href="#">
                                            <span class="avatar"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/avatar.jpg" alt="Avatar"></span>
                                            <span class="header">
                                                <span class="from">
                                                    Łukasz Holeczek
                                                </span>
                                                <span class="time">
                                                    6 min
                                                </span>
                                            </span>
                                            <span class="message">
                                                Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                            </span>  
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="avatar"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/avatar2.jpg" alt="Avatar"></span>
                                            <span class="header">
                                                <span class="from">
                                                    Megan Abott
                                                </span>
                                                <span class="time">
                                                    56 min
                                                </span>
                                            </span>
                                            <span class="message">
                                                Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                            </span>  
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="avatar"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/avatar3.jpg" alt="Avatar"></span>
                                            <span class="header">
                                                <span class="from">
                                                    Kate Ross
                                                </span>
                                                <span class="time">
                                                    3 hours
                                                </span>
                                            </span>
                                            <span class="message">
                                                Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                            </span>  
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="avatar"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/avatar4.jpg" alt="Avatar"></span>
                                            <span class="header">
                                                <span class="from">
                                                    Julie Blank
                                                </span>
                                                <span class="time">
                                                    yesterday
                                                </span>
                                            </span>
                                            <span class="message">
                                                Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                            </span>  
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="avatar"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/avatar5.jpg" alt="Avatar"></span>
                                            <span class="header">
                                                <span class="from">
                                                    Jane Sanders
                                                </span>
                                                <span class="time">
                                                    Jul 25, 2012
                                                </span>
                                            </span>
                                            <span class="message">
                                                Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                            </span>  
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-menu-sub-footer">View all messages</a>
                                    </li>	
                                </ul>
                            </li>
                            <!-- end: Message Dropdown -->
                            <li>
                                <a class="btn" href="#">
                                    <i class="icon-wrench icon-white"></i>
                                </a>
                            </li>
                            <?php if (UserControl::LoggedIn()) : ?>
                                <!-- start: User Dropdown -->
                                <li class="dropdown">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="icon-user icon-white"></i>
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/password"><i class="icon-user"></i> Change Password</a></li>
                                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/logout"><i class="icon-off"></i> Sign Out</a></li>
                                    </ul>
                                </li>
                                <!-- end: User Dropdown -->
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- end: Header Menu -->

                </div>
            </div>
        </div>
        <!-- start: Header -->