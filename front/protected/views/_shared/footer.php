<?php if (UserControl::LoggedIn()): ?>
    <div id="modal-user hide">
        <div class="modal hide fade" id="modal-card">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Nạp thẻ cào</h3>
            </div>
            <form class="form-horizontal" action="<?php echo Yii::app()->request->baseUrl; ?>/card/add/" method="post">
                <div class="modal-body">

                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Mã thẻ</label>
                        <div class="controls">
                            <input type="text" name="code">
                            <p class="help-block"><i>Lưu ý: Mã thẻ cào có 9 chữ số</i></p>
                        </div>
                    </div>                            

                </div>
                <div class="modal-footer">

                    <button href="#" class="btn btn-primary modal-submit input-small">Nạp</button>
                </div>
            </form>
        </div>

        <div class="modal hide fade" id="modal-coupon">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Nạp coupon</h3>
            </div>
            <form class="form-horizontal" action="<?php echo Yii::app()->request->baseUrl; ?>/coupon/add/" method="post">
                <div class="modal-body">

                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Mã coupon</label>
                        <div class="controls">
                            <input type="text" name="code">
                            <p class="help-block"><i>Lưu ý: Mã coupon có 9 chữ số</i></p>
                        </div>
                    </div>                            

                </div>
                <div class="modal-footer">

                    <button href="#" class="btn btn-primary modal-submit input-small">Nạp</button>
                </div>
            </form>
        </div>
        <?php $card_types = HelperGlobal::get_card_types(); ?>
        <div class="modal hide fade" id="modal-paypal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Mua thẻ cào</h3>
            </div>
            <form class="form-horizontal frm-buy-card" action="<?php echo Yii::app()->request->baseUrl; ?>/tracking/paypal/" method="post" autocomplete="off">
                <div class="modal-body">
                    <table class="table table-striped table-bordered buy-card-table">
                        <thead>
                            <tr>
                                <th>Loại</th>
                                <th style="text-align: center">Mệnh giá</th>
                                <th style="text-align: center">Số lượng (cái)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($card_types as $k => $v): ?>
                                <tr>
                                    <td><?php echo $v['description']; ?></td>
                                    <td style="text-align: center">                                    
                                        <?php echo number_format($v['amount']); ?> đ
                                    </td>
                                    <td style="text-align: center">                                    
                                        <input href="<?php echo Yii::app()->request->baseUrl; ?>/tracking/update_price/" type="text" style="text-align: center" class="input-mini quantity" name="card[<?php echo $v['id'] ?>]" value="0" />
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td><strong>Tổng tiền</strong></td>
                                <td colspan="2" style="text-align: center"><span class="label label-info price-vnd">0 VNĐ</span></td>
                            </tr>
                            <tr>
                                <td><strong>Tổng USD</strong></td>
                                <td colspan="2" style="text-align: center"><span class="label label-important price-usd">0.00 USD</span></td>
                            </tr>
                        </tbody>                        
                    </table>
                    <div class="pull-right">              
                        * Lưu ý: $1 = <?php echo number_format(SiteOption::getUsdRate()); ?>đ
                    </div>

                    <?php /* <p class="pull-right"><a href="<?php echo Yii::app()->request->baseUrl; ?>/tracking/update_price/" class="btn btn-warning update-price">Cập nhật giá tiền</a></p> */ ?>
                </div>
                <div class="modal-footer">
                    <img class="pull-left" src="<?php echo Yii::app()->request->baseUrl; ?>/images/we-accept-paypal.png"/>
                    <button href="#" class="btn btn-primary modal-submit input-small btn-large">Mua thẻ</button>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<div class="alert alert-error error-popup hide">
    <button type = "button" class="close" data-dismiss = "alert">×</button>
    <h4>Lỗi!</h4>
    <div class="message">

    </div>
</div>

<div class="alert alert-success success-popup hide">
    <button type = "button" class="close" data-dismiss = "alert">×</button>
    <h4>Chúc mừng!</h4>
    <div class="message">

    </div>
</div>

<div id="footer">
    <div class="container">
        <?php /*
        <div class="row-fluid">
            <div class="span3">
                <h6>Trường / Trung tâm</h6>
                <ul>
                    <?php foreach (HelperGlobal::get_featured_organization() as $or): ?>
                        <li class=""><a href="<?php echo Yii::app()->request->baseUrl; ?>/organization/index/slug/<?php echo $or['slug'] ?>"><?php echo $or['title'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="span3">
                <h6>Chủ đề</h6>
                <ul>
                    <?php foreach (HelperGlobal::get_featured_subject() as $su): ?>
                        <li class=""><a href="<?php echo Yii::app()->baseUrl ?>/subject/index/id/<?php echo $su['id'] ?>"><?php echo $su['title'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="span3">
                <h6>Từ khóa tìm kiếm</h6>
                <ul>
                    <?php foreach (HelperGlobal::get_featured_keyword() as $k): ?>
                        <li class=""><a href=""><?php
                    echo ($k['keyword_owner'] != '') ?
                            $k['keyword_subject'] . ' --- ' . $k['keyword_owner'] : $k['keyword_subject'];
                        ?></a></li>
                    <?php endforeach; ?>
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
         */?>
        
        <div class="copyright">
            &copy; <?php echo date('Y', time()); ?> Yima.vn.
            <?php /*<a href="<?php echo Yii::app()->request->baseUrl; ?>/info/view/page/terms-conditions">Điều khoản sử dụng</a>.
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/info/view/page/privacy-policy">Chính sách bảo mật</a>.*/?>
            Hỗ trợ kỹ thuật bởi <a href="http://soinmedia.com" target="_blank">SoinMedia</a>
        </div>
    </div>
</div>
<!-- Le javascript
        ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs.js"></script>        
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>              
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tiny_mce/tiny_mce.js"></script>        
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js?v=19112012"></script>

</body>
</html>