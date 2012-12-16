<div id="sidebar" class="span2 bs-docs-sidebar">
    <ul class="nav nav-list bs-docs-sidenav well">
        <li class="nav-header nt-test"><a href="#">Normal Test</a></li>
        <ul class="nav nav-list nt-test-list-item">
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/testNT"><i class="icon-list-alt"></i>Normal Test</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/question"><i class="icon-list-alt"></i>Question</a></li>
        </ul>
        <li class="nav-header"><a href="#">Customer</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/organization/"><i class="icon-home"></i> Organization</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/faculty/"><i class="icon-bookmark"></i> Faculty</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/class/"><i class="icon-th-large"></i> Class</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/grade/"><i class="icon-align-center"></i> Grade</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/subject/"><i class="icon-folder-open"></i> Subject</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/subject/mod/"><i class="icon-fire"></i> Subject Mods</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/keyword_searching_test/"><i class="icon-hdd"></i> Keyword</a></li>
        
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/coupon/"><i class="icon-star"></i> Coupon Codes</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/card/"><i class="icon-th-large"></i> Cards</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/card/type/"><i class="icon-move"></i> Card Types</a></li>
        
        <li class="nav-header"><a href="#">PAYMENT</a></li>
        <li class="<?php if(Yii::app()->params['page'] == "transaction") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl ?>/transaction/"><i class="icon-th-list"></i> Transactions</a></li>
        <li class="<?php if(Yii::app()->params['page'] == "tracking") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl ?>/tracking/"><i class="icon-briefcase"></i> Trackings</a></li>
        <li class="<?php if(Yii::app()->params['page'] == "paypal") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl ?>/paypal/"><i class=" icon-certificate"></i> Paypals</a></li>

        <li class="nav-header subnav-down"><a href="#">TOEFL Test</a> </li>
        
        <ul class="nav nav-list toefl-test-list-item" style="display: none;">
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/source_test"><i class="icon-list-alt"></i> Source Test</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/reading/index/?part=1"><i class="icon-book"></i> R01</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/reading/index/?part=2"><i class="icon-book"></i> R02</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/reading/index/?part=3"><i class="icon-book"></i> R03</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/1"><i class="icon-headphones"></i> L01</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/2"><i class="icon-headphones"></i> L02</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/3"><i class="icon-headphones"></i> L03</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/4"><i class="icon-headphones"></i> L04</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/5"><i class="icon-headphones"></i> L05</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/6"><i class="icon-headphones"></i> L06</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/1"><i class="icon-signal"></i> Ind. S01</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/2"><i class="icon-signal"></i> Ind. S02</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/3"><i class="icon-signal"></i> Int.(L+R) S3</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/4"><i class="icon-signal"></i> Int.(L+R) S4</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/5"><i class="icon-signal"></i> Int. (L) S05</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/6"><i class="icon-signal"></i> Int. (L) S06</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/writing/index/part/1"><i class="icon-pencil"></i> Int. W01</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/writing/index/part/2"><i class="icon-pencil"></i> Ind. W02</a></li>
        </ul>

        <li class="nav-header subnav-down"><a href="#">TOEIC Test</a></li>
        
        <ul class="nav nav-list toeic-test-list-item" style="display: none;" >
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toeic/source_test"><i class="icon-list-alt"></i> Source Test</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toeic/reading"><i class="icon-book"></i>Reading</a></li>         
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toeic/listening"><i class="icon-headphones"></i>Listening</a></li>
        </ul>
        
        <li class="nav-header subnav-down" id="4u"><a href="#">4U</a></li>
        
        <ul class="nav nav-list 4u-list-item subnav-item" <?php if(!isset(Yii::app()->params['group']) || Yii::app()->params['group'] != "4u"): ?> style="display: none;" <?php endif;?>>
            <li class="<?php if(Yii::app()->params['group'] == "4u" && Yii::app()->params['page'] == "post") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl ?>/4u/post"><i class="icon-list-alt"></i> Posts</a></li>            
            <li class="<?php if(Yii::app()->params['group'] == "4u" && Yii::app()->params['page'] == "comment") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl ?>/comment"><i class=" icon-envelope"></i> Comments</a></li>            
            <li class="<?php if(Yii::app()->params['group'] == "4u" && Yii::app()->params['page'] == "report") echo 'active'; ?>"><a href="<?php echo Yii::app()->request->baseUrl ?>/4u/report"><i class="icon-exclamation-sign"></i> Reports</a></li>            
        </ul>
        
        <li class="nav-header faq"><a href="#">FAQs</a></li>

        <ul class="nav nav-list faq-list-item" style="display: none;" >
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/categoryfaq"><i class="icon-list-alt"></i>Categories</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl ?>/faq"><i class="icon-list-alt"></i>FAQs</a></li>
        </ul>

        <li class="nav-header"><a href="#">SYSTEM</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/option/"><i class="icon-tint"></i> Site Options</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/user/"><i class="icon-user"></i> User</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/admin/"><i class="icon-eye-open"></i> Admin</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/log/"><i class="icon-search"></i> Log</a></li>

</div>