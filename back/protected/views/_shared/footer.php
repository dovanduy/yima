<!-- start: JavaScript-->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.8.21.custom.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cookie.js"></script>

<script src='<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar.min.js'></script>

<script src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js'></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/excanvas.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flot.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flot.pie.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flot.stack.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flot.resize.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.chosen.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.uniform.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cleditor.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.noty.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.elfinder.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.raty.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.iphone.toggle.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.uploadify-3.1.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.gritter.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.imagesloaded.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.masonry.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.knob.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.sparkline.min.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/tiny_mce/tiny_mce.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox.pack.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/app.js"></script>
<script type="text/javascript">
	
    function message_welcome1(){
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome on Perfectum Dashboard',
            // (string | mandatory) the text inside the notification
            text: 'I hope you like this template',
            // (string | optional) the image to display on the left
            image: 'img/avatar.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });
    }
	
    function message_welcome2(){
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Perfectum is Amazing Theme',
            // (string | mandatory) the text inside the notification
            text: 'Perfectum works on all devices, computers, tablets and smartphones. Perfectum has lots of great features. Try It!',
            // (string | optional) the image to display on the left
            image: 'img/avatar.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });
    }
	
    function message_welcome3(){
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Buy Perfectum!',
            // (string | mandatory) the text inside the notification
            text: 'This great template can be yours today.',
            // (string | optional) the image to display on the left
            image: 'img/avatar.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'gritter-light'
        });
    }
	
    $(document).ready(function(){
		
        //setTimeout("message_welcome1()",5000);
        //setTimeout("message_welcome2()",10000);	
        //setTimeout("message_welcome3()",15000);
		
    });			
</script>
<!-- end: JavaScript-->

</body>
</html>