<div id="search_bar">
    <form action="" method="get" name="searchform" id="searchform" class="form-search clearfix">
        <div class="clearfix optional">
            <select class="search-option" name="oid" id="organization_id">
                <option value="0">-- Trường/Trung tâm --</option>
                <?php foreach ($organizations as $k => $v): ?>
                    <option <?php if (isset($_GET['oid']) && $_GET['oid'] == $v['id']) echo 'selected'; ?> value="<?php echo $v['id']; ?>"><?php echo $v['title'] ?></option>
                <?php endforeach; ?>
            </select>
            <select class="search-option subject" name="fid" id="faculty_id">
                <option value="0">-- Khoa --</option>
            </select>
            <select class="search-option" name="sid" id="subject_id">
                <option value="0">-- Chủ đề --</option>
                <?php /* foreach ($subjects as $k => $v): ?>
                    <option <?php if (isset($_GET['sid']) && $_GET['sid'] == $v['id']) echo 'selected'; ?> value="<?php echo $v['id']; ?>"><?php echo $v['title'] ?></option>
                <?php endforeach; */ ?>
            </select>
            
        </div>
        <input type="text" autocomplete="off" placeholder="Tìm kiếm câu hỏi" maxlength="50" class="search-title input-xxlarge" name="keyword" value="<?php if (isset($_GET['keyword'])) echo $_GET['keyword']; ?>">

        <a href="#" class="btn-style search_button button-medium button-submit">Tìm câu hỏi</a>
    </form>
    <input type="hidden" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] : 0 ?>" id="current_faculty_id" />
    <input type="hidden" value="<?php echo isset($_GET['sid']) ? $_GET['sid'] : 0 ?>" id="current_subject_id" />
</div>