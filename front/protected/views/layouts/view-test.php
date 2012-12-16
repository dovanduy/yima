<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/header.php"); ?>

<div class="row-fluid home">
    <div class="container">
        <?php /*
          <div class="row-fluid">
          <div class="span12 featured">
          <div class="info">
          <h3>Chủ Đề Kiểm Tra Online</h3>
          <p>Tìm kiếm các bài thi hiện đang có. Hoặc tạo bài thi của riêng bạn và bắt đầu bán tại đây</p>
          <a href="<?php echo Yii::app()->request->baseUrl; ?>/event/create" class="btn btn-large btn-primary">Tạo Bài Thi</a> (miễn phí)
          </div>
          <div class="banner">
          <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/banner.png" alt=""/>
          </div>
          </div>
          </div> */ ?>
        
        <div class="row-fluid magu-home">
            <?php echo $content; ?>
            <div class="span4" style="margin-top: 33px">
                
            </div>                    
        </div>


    </div> <!-- /container -->
</div>

<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/footer.php"); ?>