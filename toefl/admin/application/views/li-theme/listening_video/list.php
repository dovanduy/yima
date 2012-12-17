<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_listening; ?>">Listening <?php echo $part; ?></a></li>
        <li><?php echo $listening_title; ?></li>
        <li>Video</li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2><?php echo $listening_title; ?></h2>
            </header>
            <!-- /Article Header -->

            <!-- Notification -->
            <?php
            if (isset($notification)) {
                ?>
                <div class="notification success">
                    <a href="#" class="close-notification">x</a>
                    <p><?php echo $notification; ?></p>
                </div>
                <?php
            }
            ?>
            <!-- /Notification -->

            <!-- Article Content -->
            <section>
                <button class="blue small preview_video_button right" style="margin-left: 10px; width: 150px;" alt="<?php echo $lid; ?>">Preview Video</button>
                <form action="<?php echo $link_search; ?>" id="frm_search" method="post">
                    <?php if ($user_info['group_id'] != 2) {?><a class="button blue button-add right" href="<?php echo $link_add; ?>">Add</a><?php }?>
                    <input type="submit" class="button right" value="Search"/>
                    <input type="text" name="search_val" class="right" value="<?php if (isset($search_val)) echo $search_val; ?>"/>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th width="80%">Question</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($items)) {
                            foreach ($items as $item) {
                                ?>
                                <tr id="item<?php echo $item->id; ?>">
                                    <td><?php echo $item->title; ?></td>
                                    <td class="center">
                                        <?php if ($user_info['qb_edit'] == 1) { ?>
                                            <a class="edit" href="<?php echo $link_edit . $item->id; ?>">Edit</a>&nbsp;&nbsp;
                                        <?php } ?>
                                        <?php if ($user_info['qb_delete'] == 1) { ?>
                                            <a class="delete" href="<?php echo $link_delete . $item->id; ?>">Delete</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">
                                <?php if (isset($pagination)) echo $pagination; ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </section>
            <!-- /Article Content -->

        </div>
        <!-- /Article Container -->

    </article>
    <!-- /Full Content Block -->

</section>
<!-- /Main Content -->
<div class="preview-video-shadow" style="display: none;"></div>
<div class="preview-video" style="display: none;">
    <input type="hidden" id="preview-video-lid" value="0"/>
    <input type="hidden" id="duration" value="0"/>
    <input type="hidden" id="current_duration" value="0"/>
    <div class="close"><img src="<?php echo theme_url(); ?>img/icons/close.png"></div>
    <div class="video-content">
        <img height="300" alt="" src="">
    </div>
    <div class="timer"></div>
    <div class="progress-bar blue large"></div>
    <div class="control">
        <a class="button stop gray" href="#">Stop</a>
    </div>
    <div class="player">

    </div>
</div>

<script>
    $().ready(function(){
        function center_screen(selector){
            height=$(window).height();
            var vinTop = (height - $(selector).height())/2;
            if(vinTop<0)vinTop=0;
            $(selector).css("margin-top", vinTop + 'px');
        }
    
        function full_screen(selector){
            height=$(window).height();
            $(selector).css("height", height + 'px');
        }
        full_screen('#shadow_box');
        
        //center preview video box
        height=$(window).height();
        width=$(window).width();
        var vinTop = (height - 60 - $('.preview-video').height())/2;
        var vinLeft = (width - 60 - $('.preview-video').width())/2;
        if(vinTop<0)vinTop=0;
        if(vinLeft<0)vinLeft=0;
        $('.preview-video-shadow').css("height", height + 'px');
        $('.preview-video').css("top", vinTop + 'px');
        $('.preview-video').css("left", vinLeft + 'px');
        
        var intervalHandle = null;
        
        $('.preview-video-shadow, .preview-video .close, .preview-video .stop').click(function(){
            $('.preview-video-shadow').hide();
            $('.preview-video').hide();
            clearInterval(intervalHandle);
        });
        
        $('.preview_video_button').live('click',function(){
            var url = '<?php echo base_url(); ?>listening/load_details';
            var id = $(this).attr('alt');
            $('#preview-video-lid').val(id);
            $.post(url,{id:id}, function(response) {
                $('.preview-video-shadow').show();
                $('.preview-video').show();
                //var lsound='audioUrl=<?php echo base_url(); ?>data/sounds/listening/listening_page/'+response['lsound'];
                var lsound='<?php echo base_url(); ?>data/sounds/listening/listening_page/'+response['lsound'];
                var player_url='<?php echo theme_url(); ?>js/player.swf';
                $('.preview-video .player').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 50,width: 250, autostart: true});<\/script>");
                
                $('#duration').val(response['lsound_duration']);
                $('#current_duration').val(0);
                intervalHandle = setInterval(play_video, 1000);
            }, 'json');
        });
        
        function play_video(){
            var duration=parseInt($('#duration').val());
            
            var current_duration=parseInt($('#current_duration').val());
            current_duration++;
            $('#current_duration').val(current_duration);
            
            percent=Math.floor(current_duration/duration*100);
            percent_width=Math.floor(current_duration/duration*495);
            $('.preview-video .progress-bar').html('<div style="width: '+percent_width+'px;"><span>'+percent+'<sup>%</sup></span></div>')
            $('.preview-video .timer').html(convert_time(current_duration) + ' / ' + convert_time(duration));
            if (current_duration>=duration) {
                clearInterval(intervalHandle);
            }
            
            var url = '<?php echo base_url(); ?>listening_video/load_video_with_current_duration';
            var lid=parseInt($('#preview-video-lid').val());
            var action = '';
            $.post(url,{lid:lid, current_duration:current_duration}, function(response) {
                $('.preview-video .video-content').html('<img height="300" alt="" src="<?php echo base_url(); ?>data/images/listening/'+response['limg']+'">');
            }, 'json');
        }
        
        function convert_time(second){
            minute=Math.floor(second/60);
            second=Math.floor(second - minute*60);
            return pad(minute, 2) + ' : ' + pad(second, 2);
        }
        
        function pad(number, length) {
            var str = '' + number;
            while (str.length < length) {
                str = '0' + str;
            }
            return str;
        }
    });
</script>