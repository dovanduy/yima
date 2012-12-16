<?php $this->renderFile(Yii::app()->basePath."/views/_shared/header.php"); ?>
<div class="container" style="padding-top:60px">   
    <div class="row row-fluid">

        <?php //$this->widget('Sidebar'); ?>
        <div class="span12"><?php echo $content; ?></div>

    </div>
</div>
<?php $this->renderFile(Yii::app()->basePath."/views/_shared/footer.php"); ?>
