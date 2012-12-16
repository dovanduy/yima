<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/testNT/">Normal Test</a> <span class="divider">/</span> </li>
    <li>Finished <span class="divider">/</span> <?php echo $finish['title'] ?></li>
</ul>
<hr/>
<legend>Result</legend>

<ul>
    <li><strong>Normal test:</strong> <?php echo $finish['title'] ?></li>
    <li><strong>Author:</strong> <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/overview/id/<?php echo $finish['author_id']; ?>"><?php echo $finish['author_email']; ?></a></li>
    <li><strong>Completor:</strong> <a href="<?php echo Yii::app()->request->baseUrl; ?>/user/overview/id/<?php echo $finish['user_id']; ?>"><?php echo $finish['completor_email']; ?></a></li>
    <li><strong>Date completed:</strong> <?php echo date('d-m-Y H:i:s', $finish['date_added']); ?></li>
    <li><strong>Total question:</strong> <span class="label label-info"><?php echo $finish['total_question']; ?></span></li>
    <li><strong>Total right:</strong> <span class="label label-success"><?php echo $finish['total_right'] ?></span></li>                        
</ul>

<table style="margin-top: 20px" class="table table-striped table-bordered table-center clearfix">
    <thead>
        <tr>
            <th style="width:40%">Question</th>
            <th style="width:10%">RS</th>
            <th style="width:40%">Question</th>
            <th style="width:10%">RS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $information = unserialize($finish['information']);
        $questions = array_values($information['right_choices']);
        $user_choices = $information['user_choices'];
        $ceil = ceil(count($questions) / 2);
        ?>

        <?php for ($i = 0; $i < $ceil; $i++): ?>
            <?php
            $q1 = $questions[$i * 2];
            $q2 = isset($questions[($i * 2) + 1]) ? $questions[($i * 2) + 1] : null;
            ?>

            <tr>
                <td class="align-left"><?php echo $q1['title']; ?></td>
                <td><i class="<?php echo $q1['choice'] == $user_choices[$q1['id']] ? "icon-ok" : "icon-remove"; ?>"></i></td>
                <?php if ($q2): ?>
                    <td class="align-left"><?php echo $q2['title']; ?></td>
                    <td><i class="<?php echo $q2['choice'] == $user_choices[$q2['id']] ? "icon-ok" : "icon-remove"; ?>"></i></td>
                <?php else: ?>
                    <td colspan="2"></td>
                <?php endif; ?>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>
