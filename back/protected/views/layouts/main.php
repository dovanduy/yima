<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/header.php"); ?>

<div class="container-fluid">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <div class="span2 main-menu-span">
            <a class="brand hidden-phone hidden-tablet" href="<?php echo Yii::app()->request->baseUrl ?>"> <img alt="Yima.vn" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png" style="width: 90%; max-width: 150px;"/></a>
            <?php $this->widget('Sidebar'); ?>
        </div><!--/span-->
        <!-- end: Main Menu -->

        <noscript>
        <div class="alert alert-block span10">
            <h4 class="alert-heading">Warning!</h4>
            <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
        </div>
        </noscript>

        <div id="content" class="span10" style="min-height: 2400px;">
            <!-- start: Content -->
            <?php echo $content; ?>
            <!-- end: Content -->
        </div><!--/#content.span10-->
    </div><!--/fluid-row-->

    <div class="modal hide fade" id="myModal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Settings</h3>
        </div>
        <div class="modal-body">
            <p>Here settings can be configured...</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Close</a>
            <a href="#" class="btn btn-primary">Save changes</a>
        </div>
    </div>

    <div class="clearfix"></div>

    <footer>
        <p>
            <span style="text-align:left;float:left">&copy; <a href="http://yima.vn" target="_blank">Yima.vn</a> <?php echo date('Y',time());?></span>
            <span style="text-align:right;float:right">Powered by: <a href="http://htmlfivemedia.com">HTML5 Media</a></span>
        </p>

    </footer>

</div><!--/.fluid-container-->
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/footer.php"); ?>
