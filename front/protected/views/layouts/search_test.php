
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/header.php"); ?>

<div class="row">
    <div class="container">
        <article class="row-fluid find-magu">
            <?php echo $content; ?>

        </article>
    </div>
</div>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/footer.php"); ?>