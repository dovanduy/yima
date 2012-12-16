<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/">Normal Test</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $testnt['title'] ?></li>
</ul>
<hr/>
<legend>Edit Normal Test</legend>

<ul class="nav nav-tabs">
    <li class="<?php if ($type == "general") echo 'active' ?>">
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/edit/id/<?php echo $testnt['id']; ?>">General</a>
    </li>
    <li class="<?php if ($type == "question") echo 'active' ?>"><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/question/id/<?php echo $testnt['id'] ?>">Questions</a></li>
    <li class="<?php if ($type == "image") echo 'active' ?>"><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/image/id/<?php echo $testnt['id'] ?>/">Images</a></li>
</ul>