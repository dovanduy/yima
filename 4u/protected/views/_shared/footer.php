<div id="footer">
    <div class="container">
        <div class="row-fluid">
            <div class="span3">
                <h6>Trường / Trung tâm</h6>
                <ul>
                    <?php foreach (HelperGlobal::get_featured_organization() as $or): ?>
                        <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/index/slug/<?php echo $or['slug']?>"><?php echo $or['title'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="span3">
                <h6>Chủ đề</h6>
                <ul>
                    <?php foreach (HelperGlobal::get_featured_subject() as $su): ?>
                        <li class=""><a href="#"><?php echo $su['title'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="span3">
                <h6>Từ khóa tìm kiếm</h6>
                <ul>
                    
                </ul>
            </div>
            <div class="span3">
                <h6>Yima.vn</h6>
                <ul>
                    <li class=""><a href="">Giới thiệu</a></li>
                    <li class=""><a href="">Hướng dẫn sử dụng</a></li>
                    <li class=""><a href="">Câu hỏi thường gặp</a></li>
                    <li class=""><a href="">Liên hệ</a></li>
                </ul>
                <h6>Kết nối với chúng tôi</h6>
                <ul>
                    <li class=""><a href="">Facebook</a></li>
                    <li class=""><a href="">Twitter</a></li>
                    <li class=""><a href="">Youtube</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            &copy; <?php echo date('Y', time()); ?> Yima.vn.
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/info/view/page/terms-conditions">Điều khoản sử dụng</a>.
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/info/view/page/privacy-policy">Chính sách bảo mật</a>.
        </div>
    </div>
</div>
<!-- Le javascript
        ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs.js"></script>        
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>              
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tiny_mce/tiny_mce.js"></script>        
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>

</body>
</html>