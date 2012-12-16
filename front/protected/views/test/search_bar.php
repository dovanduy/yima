<div id="search_bar">
    <form action="" method="get" name="searchform" id="searchform" class="form-search clearfix">
        <?php foreach ($query_string as $k => $v): ?>
            <?php if ($k == "own" || $k == "cate") continue; ?>
            <input type="hidden" name="<?php echo $k; ?>" value="<?php echo $v; ?>"/>
        <?php endforeach; ?>
        <input type="text" autocomplete="off" placeholder="Tìm kiếm (vd: TOEFL, IELTS)" maxlength="50" class="search-title" name="cate" value="<?php if (isset($_GET['cate'])) echo $_GET['cate']; ?>">
        <input type="text" autocomplete="off" maxlength="50" class="search-location" name="own" id="cityfield" placeholder="Tác giả / Trường / Trung tâm" value="<?php if (isset($_GET['own'])) echo $_GET['own']; ?>">
        <button type="submit" class="btn-style search_button button-medium button-submit">Tìm bài kiểm tra</button>
    </form>
</div>