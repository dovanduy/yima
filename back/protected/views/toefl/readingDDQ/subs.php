<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
   <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/reading/index/?part=<?php echo $part ?>">Reading 0<?php echo $part?></a> <span class="divider">/</span> </li>
   <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/readingDDQ/index/?part=<?php echo $part ?>$rid=<?php echo $rid?>">DDQ</a> <span class="divider">/</span> </li>
    <li class="active">Manager <span class="divider">/</span> </li>
    <li class="active"><?php echo $reading['title'] ?></li>
</ul>
<hr/>
<legend>Edit Reading DDQ: <?php echo $reading['title'] ?></legend>
<article class="full-block clearfix">

    <!-- Article Container for safe floating -->
    <div class="article-container">
        <!-- Article Header -->
        <header>
            <h2><?php echo $readingDDQ['title']?></h2>
        </header>
        <!-- /Article Header -->
<input id="ddqid" type="hidden" value="<?php echo $ddq_id?>"/>
        <div id="manage_ddq" class="row-fluid clearfix">

            

            <article class="half-block span6" style="min-height: 1000px;">

                <!-- Article Container for safe floating -->
                <div class="article-container choice">

                    <!-- Article Content -->
                    <section>
                        <p>
                            <input class="medium" type="text" id="txt_add_choice" url_choice="<?php echo Yii::app()->request->baseUrl . "/toefl/readingDDQ/post_choice/ddq_id/" . $ddq_id ?>" style="width: 290px; margin-bottom: 10px;"><br/>
                            <a rel="tooltip" title="Update Choice" class="button stats-view btn btn-danger" id="update_choice" href="#" style="display: none;">Update Choice</a>
                            <a rel="tooltip" title="Add New Choice" class="button stats-view blue btn btn-info" id="add_choice" href="#">Add Choice</a>
                        </p>
                        <!-- Stats Summary -->
                        <ul class="stats-summary">
                        </ul>
                        <!-- /Stats Summary -->

                    </section>
                    <!-- /Article Content -->

                </div>
                <!-- /Article Container -->

            </article>

            <p style="margin-bottom: 10px;" class="span6">
                <input class="medium" type="text" id="txt_add_subject" style="width: 286px; margin-bottom: 10px;" url_sub="<?php echo Yii::app()->request->baseUrl . "/toefl/readingDDQ/post_subs/ddq_id/" . $ddq_id ?>"><br/>
                <a rel="tooltip" title="Update Subject" class="button stats-view btn btn-danger" id="update_subject" href="#" style="display: none;">Update Subject</a>
                <a rel="tooltip" title="Add New Subject" class="button stats-view blue btn btn-info" id="add_subject" href="#">Add Subject</a>
            </p>

        </div>

    </div>
    <!-- /Article Container -->

</article>