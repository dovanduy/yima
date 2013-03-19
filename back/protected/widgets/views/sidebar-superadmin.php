<div class="nav-collapse sidebar-nav">
    <ul class="nav nav-tabs nav-stacked main-menu">
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/organization/"><i class="icon-home icon-white"></i><span class="hidden-tablet"> Organization</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/faculty/"><i class="icon-bookmark icon-white"></i><span class="hidden-tablet"> Faculty</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/class/"><i class="icon-th-large icon-white"></i><span class="hidden-tablet"> Class</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/grade/"><i class="icon-align-center icon-white"></i><span class="hidden-tablet"> Grade</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/subject/"><i class="icon-folder-open icon-white"></i><span class="hidden-tablet"> Subject</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/subject/mod/"><i class="icon-fire icon-white"></i><span class="hidden-tablet"> Subject Mods</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/keyword_searching_test/"><i class="icon-hdd icon-white"></i><span class="hidden-tablet"> Keyword</span></a></li>

        <li class="nav-header"><a href="#"><span class="hidden-tablet"> PAYMENT</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/transaction/"><i class="icon-th-list icon-white"></i><span class="hidden-tablet"> Transactions</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/tracking/"><i class="icon-briefcase icon-white"></i><span class="hidden-tablet"> Trackings</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/paypal/"><i class=" icon-certificate icon-white"></i><span class="hidden-tablet"> Paypals</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/coupon/"><i class="icon-star icon-white"></i><span class="hidden-tablet"> Coupon Codes</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/card/type/"><i class="icon-move icon-white"></i><span class="hidden-tablet"> Card Types</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/card/"><i class="icon-th-large icon-white"></i><span class="hidden-tablet"> Cards</span></a></li>

        <li class="nav-header"><a href="#"><span class="hidden-tablet"> Normal Test</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/testNT"><i class="icon-list-alt icon-white"></i><span class="hidden-tablet"> Normal Test</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/testNT/pending"><i class="icon-list-alt icon-white"></i><span class="hidden-tablet"> Pending</span></a></li>
        <?php /* <li><a href="<?php echo Yii::app()->request->baseUrl ?>/question"><i class="icon-list-alt icon-white"></i><span class="hidden-tablet"> Question</span></a></li> */ ?>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/testNT/finish/"><i class="icon-ok icon-white"></i><span class="hidden-tablet"> Finished</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/comment/index/type/test_nt/"><i class=" icon-envelope icon-white"></i><span class="hidden-tablet"> Comments</span></a></li>            
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/report/index/type/test_nt/"><i class="icon-exclamation-sign icon-white"></i><span class="hidden-tablet"> Reports</span></a></li>     
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/testNT/raw/"><i class="icon-download-alt icon-white"></i><span class="hidden-tablet"> Raw</span></a></li> 

        <li class="nav-header"><a href="#"><span class="hidden-tablet"> TOEFL Test</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/source_test"><i class="icon-list-alt icon-white"></i><span class="hidden-tablet"> Source Test</span></a></li>
        <li class="divider"></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/reading/index/?part=1"><i class="icon-book icon-white"></i><span class="hidden-tablet"> R01</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/reading/index/?part=2"><i class="icon-book icon-white"></i><span class="hidden-tablet"> R02</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/reading/index/?part=3"><i class="icon-book icon-white"></i><span class="hidden-tablet"> R03</span></a></li>
        <li class="divider"></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/1"><i class="icon-headphones icon-white"></i><span class="hidden-tablet"> L01</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/2"><i class="icon-headphones icon-white"></i><span class="hidden-tablet"> L02</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/3"><i class="icon-headphones icon-white"></i><span class="hidden-tablet"> L03</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/4"><i class="icon-headphones icon-white"></i><span class="hidden-tablet"> L04</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/5"><i class="icon-headphones icon-white"></i><span class="hidden-tablet"> L05</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/listening/index/part/6"><i class="icon-headphones icon-white"></i><span class="hidden-tablet"> L06</span></a></li>
        <li class="divider"></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/1"><i class="icon-signal icon-white"></i><span class="hidden-tablet"> Ind. S01</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/2"><i class="icon-signal icon-white"></i><span class="hidden-tablet"> Ind. S02</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/3"><i class="icon-signal icon-white"></i><span class="hidden-tablet"> Int.(L+R) S3</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/4"><i class="icon-signal icon-white"></i><span class="hidden-tablet"> Int.(L+R) S4</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/5"><i class="icon-signal icon-white"></i><span class="hidden-tablet"> Int. (L) S05</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/speaking/index/part/6"><i class="icon-signal icon-white"></i><span class="hidden-tablet"> Int. (L) S06</span></a></li>
        <li class="divider"></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/writing/index/part/1"><i class="icon-pencil icon-white"></i><span class="hidden-tablet"> Int. W01</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toefl/writing/index/part/2"><i class="icon-pencil icon-white"></i><span class="hidden-tablet"> Ind. W02</span></a></li>

        <li class="nav-header"><a href="#"><span class="hidden-tablet"> TOEIC Test</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toeic/source_test"><i class="icon-list-alt icon-white"></i><span class="hidden-tablet"> Source Test</span></a></li>
        <li class="divider"></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toeic/reading"><i class="icon-book icon-white"></i><span class="hidden-tablet">Reading</span></a></li>         
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/toeic/listening"><i class="icon-headphones icon-white"></i><span class="hidden-tablet">Listening</span></a></li>

        <li class="nav-header"><a href="#"><span class="hidden-tablet"> Yima4u</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/4u/post"><i class="icon-list-alt icon-white"></i><span class="hidden-tablet"> Posts</span></a></li>            
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/comment"><i class=" icon-envelope icon-white"></i><span class="hidden-tablet"> Comments</span></a></li>            
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/4u/report"><i class="icon-exclamation-sign icon-white"></i><span class="hidden-tablet"> Reports</span></a></li>            

        <li class="nav-header"><a href="#"><span class="hidden-tablet"> FAQs</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/categoryfaq"><i class="icon-list-alt icon-white"></i><span class="hidden-tablet">Categories</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/faq"><i class="icon-list-alt icon-white"></i><span class="hidden-tablet">FAQs</span></a></li>

        <li class="nav-header"><a href="#"><span class="hidden-tablet"> SYSTEM</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/option/"><i class="icon-tint icon-white"></i><span class="hidden-tablet"> Site Options</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/user/"><i class="icon-user icon-white"></i><span class="hidden-tablet"> User</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/admin/"><i class="icon-eye-open icon-white"></i><span class="hidden-tablet"> Admin</span></a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl ?>/log/"><i class="icon-search icon-white"></i><span class="hidden-tablet"> Log</span></a></li>

    </ul>
</div><!--/.well -->