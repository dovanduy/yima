<hr/>
<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>">Homepage</a> <span class="divider">/</span> </li>
    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/toefl/source_test/">Source Test</a> <span class="divider">/</span> </li>
    <li class="active">Edit <span class="divider">/</span> </li>
    <li class="active"><?php echo $source_test['title'] ?></li>
</ul>
<hr/>
<legend>Edit Source Test: <?php echo $source_test['title'] ?></legend>

<?php echo Helper::print_error($message); ?>
<?php echo Helper::print_success($message); ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label"><strong>Title</strong></label>
        <div class="controls">
            <input type="text"  class="input-xxlarge" name="title" value="<?php echo $source_test['title'] ?>">
        </div>
    </div>


    <legend>Reading</legend>
    <div class="control-group">
        <label class="control-label">Reading 01</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="reading1">
                <option value="0">--- Select Reading 01 ---</option>
                <?php foreach ($reading1 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['reading1']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Reading 02</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="reading2">
                <option value="0">--- Select Reading 02 ---</option>
                <?php foreach ($reading2 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['reading2']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Reading 03</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="reading3">
                <option value="0">--- Select Reading 03 ---</option>
                <?php foreach ($reading3 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['reading3']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <legend>Listening</legend>
    <div class="control-group">
        <label class="control-label">Listening 01</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="listening1">
                <option value="0">--- Select Listening 01 ---</option>
                <?php foreach ($listening1 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['listening1']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Listening 02</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="listening2">
                <option value="0">--- Select Listening 02 ---</option>
                <?php foreach ($listening2 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['listening2']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Listening 03</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="listening3">
                <option value="0">--- Select Listening 03 ---</option>
                <?php foreach ($listening3 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['listening3']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Listening 04</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="listening4">
                <option value="0">--- Select Listening 04 ---</option>
                <?php foreach ($listening4 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['listening4']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Listening 05</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="listening5">
                <option value="0">--- Select Listening 05 ---</option>
                <?php foreach ($listening5 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['listening5']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Listening 06</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="listening6">
                <option value="0">--- Select Listening 06 ---</option>
                <?php foreach ($listening6 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['listening6']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>


    <legend>Speaking</legend>
    <div class="control-group">
        <label class="control-label">Independent Task 01</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="speaking1">
                <option value="0">--- Select Independent Task 01 ---</option>
                <?php foreach ($speaking1 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['speaking1']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Independent Task 02</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="speaking2">
                <option value="0">--- Select Independent Task 02 ---</option>
                <?php foreach ($speaking2 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['speaking2']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Integrated Task (L+R) 03</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="speaking3">
                <option value="0">--- Select Integrated Task (L+R) 03 ---</option>
                <?php foreach ($speaking3 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['speaking3']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Integrated Task (L+R) 04</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="speaking4">
                <option value="0">--- Select Integrated Task (L+R) 04 ---</option>
                <?php foreach ($speaking4 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['speaking4']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Integrated Task (L) 05</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="speaking5">
                <option value="0">--- Select Integrated Task (L) 05 ---</option>
                <?php foreach ($speaking5 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['speaking5']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Integrated Task (L) 06</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="speaking6">
                <option value="0">--- Select Integrated Task (L) 06 ---</option>
                <?php foreach ($speaking6 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['speaking6']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <legend>Writting</legend>
    <div class="control-group">
        <label class="control-label">Integrated Task</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="writing1">
                <option value="0">--- Select Integrated Task ---</option>
                <?php foreach ($writing1 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['writing1']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Independent Task</label>
        <div class="controls">
            <select id="parents_id" class="input-xxlarge" name="writing2">
                <option value="0">--- Select Independent Task ---</option>
                <?php foreach ($writing2 as $o): ?>
                    <option value="<?php echo $o['id']; ?>" <?php if ($o['id'] == $source_test['writing2']) echo 'selected'; ?>><?php echo $o['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <legend>Status</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="disabled" value="0" <?php if (!$source_test['disabled']) echo 'checked' ?>>
                Active
            </label>
            <label class="radio">
                <input type="radio" name="disabled" value="1" <?php if ($source_test['disabled']) echo 'checked'; ?>>
                Disabled
            </label>
        </div>
    </div>
    <legend>Delete</legend>
    <div class="control-group">
        <div class="controls">
            <label class="radio">
                <input type="radio" name="deleted" value="1" <?php if ($source_test['deleted']) echo 'checked'; ?>>
                Yes
            </label>
            <label class="radio">
                <input type="radio" name="deleted" value="0" <?php if (!$source_test['deleted']) echo 'checked'; ?>>
                No
            </label>
        </div>
    </div>

    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="history.go(-1);return false;">Cancel</button>
    </div>
</form>

