<?php $this->renderPartial('sidebar', array()); ?>
<section class="search span9">
    <div id="user-info">
        <div class="head">
            <legend>Lịch sử giao dịch</legend>
        </div>
        <div class="transaction">
            <ul class="nav nav-tabs">
                <li class="<?php if($type == "all") echo 'active'; ?>">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/transaction/">Tất cả</a>
                </li>
                <li class="<?php if($type == "card") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/transaction/type/card/">Thẻ cào</a></li>
                <li class="<?php if($type == "coupon") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/transaction/type/coupon/">Coupon</a></li>
                <li class="<?php if($type == "paypal") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/transaction/type/paypal/">Paypal</a></li>
            </ul>
            
            <?php $this->renderPartial($type,array('transactions'=>$transactions)); ?>
            <?php $this->renderFile(Yii::app()->basePath . "/views/_shared/paging.php", array('total' => $total, 'paging' => $paging)); ?>
        </div>
    </div>
</section>