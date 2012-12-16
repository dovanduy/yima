
<div class="row">
    <div class="container">
        <div class="span12">
            <div class="row-fluid create-magu">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane active">

                        <form class="form-horizontal form-create-magu" method="post" enctype="multipart/form-data">                            
                            <div class="row-fluid content">
                                <?php echo Helper::print_error($message); ?>
                                <?php echo Helper::print_success($message); ?>
                                <div class="span10 form-magu">

                                    <fieldset>
                                        <legend>Thông tin câu hỏi</legend>
                                        <div class="control-group">
                                            <label class="control-label">Chủ đề<div class="required">*</div></label>
                                            <div class="controls">
                                                <select name="subject" class="input-xxlarge span11">
                                                    <option value="0">-- Chọn chủ đề --</option>
                                                    <?php foreach ($subjects as $k => $v): ?>
                                                        <option <?php if (isset($_POST['subject']) && $_POST['subject'] == $v['id']) echo 'selected';else if($post['subject_id'] == $v['id']) echo 'selected'; ?> value="<?php echo $v['id']; ?>"><?php echo $v['title']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Trường/Trung tâm</label>
                                            <div class="controls">
                                                <select name="organization" class="input-xxlarge span11">
                                                    <option value="0">Tất cả</option>
                                                    <?php foreach ($organizations as $k => $v): ?>
                                                        <option <?php if (isset($_POST['organization']) && $_POST['organization'] == $v['id']) echo 'selected';else if($post['organization_id'] == $v['id']) echo 'selected'; ?> value="<?php echo $v['id']; ?>"><?php echo $v['title']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="title">Tiêu đề<div class="required">*</div></label>
                                            <div class="controls"><input maxlength="200" type="text" class="input-xlarge span11" name="title" value="<?php if (isset($_POST['title'])) echo htmlspecialchars($_POST['title']);else echo htmlspecialchars($post['title']); ?>"></div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label">Nội dung câu hỏi<div class="required">*</div></label>
                                                <div class="controls">
                                                    <textarea cols="150" rows="15" name="content"><?php if (isset($_POST['content'])) echo $_POST['content'];else echo $post['content']; ?></textarea>
                                                </div>         

                                        </div>                     
                                        <div class="control-group">
                                            <div class="controls">                                                
                                                <button type="submit" class="btn btn-primary">Sửa</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>                
            </div>
        </div>     
    </div>
</div>