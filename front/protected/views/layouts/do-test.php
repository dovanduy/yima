<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Yima.vn | Yes, It's my answer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/ico/favicon.ico?v=1">
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
       

<?php echo $content; ?>


        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs.js"></script>        
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>              
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tiny_mce/tiny_mce.js"></script>        
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js?v=19112012"></script>

</body>
</html>