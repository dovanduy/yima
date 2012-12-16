<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/header.php"); ?>
<div class="container" style="padding-top:80px">   
    <div class="row">
        <div class="span12">
            <div class="row-fluid">
                <div class="span7">
                    <h1>Không tìm thấy</h1>
                    <h5>Đường dẫn bạn truy cập không tồn tại. Vui lòng nhấn vào <a href="<?php echo Yii::app()->request->baseUrl ?>">đây</a> để về trang chủ. Hoặc liên hệ với chúng tôi qua địa chỉ <a href="mailto:lienhe@yima.vn">lienhe@yima.vn</a></h5>
                    
                    <a href="<?php echo Yii::app()->request->baseUrl ?>" class="btn btn-primary">Trang chủ</a>
                </div>
                <div class="span5">
                    <img src="<?php echo Yii::app()->request->baseUrl ?>/img/404_man.jpg"/>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $this->renderFile(Yii::app()->basePath . "/views/_shared/footer.php"); ?>