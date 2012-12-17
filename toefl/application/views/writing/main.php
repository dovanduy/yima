<input type="hidden" id="volume" value="50"/>
<input type="hidden" id="duration" value="0"/>
<input type="hidden" id="current_duration" value="0"/>
<input type="hidden" id="current_question" value="1"/>
<div class="sound">
    <div id="lsound">Loading the player ...</div>
    <script type="text/javascript">
        jwplayer("lsound").setup({ flashplayer: "<?php echo base_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>admin/data/sounds/system/writing_direction_1.mp3",
            height: 0,
            width: 250,
            autostart: true
        });
    </script>
</div>
<div class="step direction step1">
    <img src="<?php echo base_url(); ?>img/headset_small.jpg" alt=""/>
    <p class="bold">Make sure your headset is on.</p>
    <p>This section measures your ability to use writing to communicate in an academic environment. There will be two writing tasks.</p>
    <p>For the first writing task, you will read a passage and listen to a lecture and then answer a question based on what you have read and heard. For the second task, you will answer a question based on your own knowledge and experience.</p>
    <p>Now listen to the directions for the first writing task.</p>
</div>
<div class="step direction step2" style="display: none;">
    <h3 class="center" style="margin-bottom: 10px;">Integrated Writing</h3>
    <h3 class="center">Directions</h3>
    <p>For this task, you will read a passage about an academic topic. You will have <strong>3 minutes</strong> to read the passage. You may take notes on the passage while you read. The passage will then be removed and you will listen to a lecture about the same topic. While you listen, you may also take notes.</p>
    <p>Then you will write a response to a question that asks you about the relationship between the lecture you heard and the reading passage. Try to answer the question as completely as possible using information from the reading passage and the lecture. The question does <strong>not</strong> ask you to express your personal opinion. You will be able to see the reading passage again when it is time for you to write. You may use your notes to help you answer the question. You will have <strong>20 minutes</strong> to write your response.</p>
    <p>Typically, an effective response will be 150 to 225 words. You need to demonstrate your ability to write well and to provide complete and accurate content. If you finish your response before time is up, you may click on <strong>Next</strong> to go on to the second writing task.</p>
    <p>Now you will see the reading passage. Remember it will be available to you again when you write your response. Immediately after the reading time ends, the lecture will begin, so keep your headset on until the lecture is over.</p>
</div>
<div class="reading_part step step3" style="display: none;">
    <p><?php echo $writing1['direction']; ?></p>
    <p class="bold italic reading_time">Reading Time: 3 minutes</p>
    <div style="border: 1px solid #CCCCCC; height: 250px; margin-top: 20px; overflow-y: scroll; padding: 10px 20px 10px 10px;">
        <?php echo $writing1['content']; ?>
    </div>
</div>
<div class="video_part step step4" style="display: none;">
    <div class="video_image"><img src="<?php echo HelperURL::upload_url(); ?>media/toefl/writing/<?php echo $writing1['limg']; ?>" height="200"/></div>
    <div class="progress-bar blue large">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="writing_part step step5" style="display: none;">
    <p class="italic">Direcions: You have 20 minutes to plan and write your response. Your response will be judged on  the basis of the quality of your writing and on how well your response presents the  points in the lecture and their relationship to the reading passage. Typically, an  effective response will be 150 to 225 words.</p>
    <p class="writing_part_direction"><?php echo $writing1['subject']; ?></p>
    <div>
        <div class="reading_text left"><?php echo $writing1['content']; ?></div>
        <div class="student_writing right">
            <textarea id="writing1_content" name="writing1_content" value=""></textarea>
            <div class="word_count">Word Count: <span id="display_count1">0</span></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="step step6 end_writing" style="display: none;">
    <p>You still have time to write your response. As long as there is time remaining, you can continue writing or rewriting your response.</p>
    <p>Click on <strong>Return</strong> to continue writing your response. Click on <strong>Next</strong> to leave this question.</p>
    <p>Once you leave this question, you will not be able to return and you may not continue writing.</p>
</div>
<div class="step direction step7" style="display: none;">
    <h3 class="center" style="margin-bottom: 10px;">Independent Writing</h3>
    <h3 class="center">Directions</h3>
    <p>For this task, you will write an essay in response to a question that asks you to state, explain, and support your opinion on an issue. You will have <strong>30 minutes</strong> to plan, write, and revise your response.</p>
    <p>Typically, an effective essay will contain a minimum of 300 words. You need to demonstrate your ability to write well. This includes the development of your ideas, the organization of your essay, and the quality and accuracy of the language you use to express your ideas.</p>
    <p>If you finish your essay before time is up, you may click on <strong>Next</strong> to end this section.</p>
    <p>Click on <strong>Continue</strong> to go on.</p>
</div>
<div class="writing_part step step8" style="display: none;">
    <div>
        <div class="independent left">
            <div class="bold italic">Directions:</div>
            <p class="independent_direction">Read the question below. You have <strong>30 minutes</strong> to plan, write, and revise your essay. Typically, an effective response contains a minimum of 300 words.</p>
            <div class="bold italic reading_time">Questions</div>
            <p><?php echo $writing2['subject']; ?></p>
        </div>
        <div class="independent_writing right">
            <textarea id="writing2_content" name="writing2_content" value=""></textarea>
            <div class="word_count">Word Count: <span id="display_count2">0</span></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="step step9 end_writing" style="display: none;">
    <p>You still have time to write your response. As long as there is time remaining, you can continue writing or rewriting your response.</p>
    <p>Click on <strong>Return</strong> to continue writing your response. Click on <strong>Next</strong> to leave this question.</p>
    <p>Once you leave this question, you will not be able to return and you may not continue writing.</p>
</div>
<div class="step step10 end_speaking" style="display: none;">
    <p>This is the end of Writing Section</p>
</div>
<!-- JS Libs at the end for faster loading -->
<script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="js/jquery/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
<script src="<?php echo base_url(); ?>js/selectivizr.js"></script>
<script src="<?php echo base_url(); ?>js/jquery_002.js"></script>
<script src="<?php echo base_url(); ?>js/login.js"></script>
<script>

    $().ready(function(){
        height=$(window).height();
        var vinTop = (height - 40 - $('.article-container').height())/2;
        if(vinTop<0)vinTop=0;
        $('.test').css("margin-top", vinTop + 'px');

        var intervalHandle = null;

        function run_timer(time){
            $('#duration').val(time);
            $('#current_duration').val(0);

            minute=Math.floor(time/60);
            second=Math.floor(time - minute*60);
            $('#timer').html(pad(minute, 2) + ' : ' + pad(second, 2));

            intervalHandle = setInterval(count_down, 1000);
        }

        function pad(number, length) {
            var str = '' + number;
            while (str.length < length) {
                str = '0' + str;
            }
            return str;
        }

        function count_down(){
            var duration=parseInt($('#duration').val());

            var current_duration=parseInt($('#current_duration').val());
            current_duration++;
            $('#current_duration').val(current_duration);

            var current_question=parseInt($('#current_question').val());

            var time_remain=duration-current_duration;

            minute=Math.floor(time_remain/60);
            second=Math.floor(time_remain - minute*60);
            $('#timer').html(pad(minute, 2) + ' : ' + pad(second, 2));

            percent=Math.floor(current_duration/duration*100);
            percent_width=Math.floor(current_duration/duration*335);
            $('.step'+current_question+' .progress-bar').html('<div style="width: '+percent_width+'px;"><span>'+percent+'<sup>%</sup></span></div>')
            if (current_duration>=duration) {
                clearInterval(intervalHandle);
                var current_question=parseInt($('#current_question').val());
                if (current_question==5 || current_question==8) $('.button.next').trigger('click');
                $('.button.next').trigger('click');
            }
        }

        $('#writing1_content').keypress(function(){
            total_words=this.value.split(/[\s\.\?]+/).length;
            jQuery('#display_count1').html(total_words);
        });

        $('#writing2_content').keypress(function(){
            total_words=this.value.split(/[\s\.\?]+/).length;
            jQuery('#display_count2').html(total_words);
        });

        $('.button.return').click(function(){
            var number_question=11;
            var current_question=parseInt($('#current_question').val());
            current_question--;
            $('#current_question').val(current_question);
            $('.step').hide();
            $('.step'+current_question).show();
            $('.button.return').hide();
        });

        $('.button.next').click(function(){
            var lsound_arr=new Array();
            var lsound_duration_arr=new Array();

            var ssound_arr=new Array();
            var ssound_duration_arr=new Array();

            lsound_arr[1]='<?php echo $writing1['lsound'] ?>';
            lsound_duration_arr[1]='<?php echo $writing1['lsound_duration'] ?>';
            ssound_arr[1]='<?php echo $writing1['ssound'] ?>';
            ssound_duration_arr[1]='<?php echo $writing1['ssound_duration'] ?>';

            lsound_arr[2]='<?php echo $writing2['lsound'] ?>';
            lsound_duration_arr[2]='<?php echo $writing2['lsound_duration'] ?>';
            ssound_arr[2]='<?php echo $writing2['ssound'] ?>';
            ssound_duration_arr[2]='<?php echo $writing2['ssound_duration'] ?>';

            var number_question=11;
            var current_question=parseInt($('#current_question').val());

            current_question+=1;
            $('#current_question').val(current_question);
            $('.step').hide();
            $('.step'+current_question).show();

            switch(current_question){
                case 2:
                    var lsound='<?php echo base_url(); ?>admin/data/sounds/system/writing_direction_2.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    break;
                case 3:
                    $('#current_position').show();
                    $('#current_position').html('1 of 2');
                    $('.button.next').hide();
                    run_timer(180);
                    $('#timer').show();
                    var lsound='<?php echo base_url(); ?>admin/data/sounds/speaking/empty.mp3';
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    break;
                case 4:
                    clearInterval(intervalHandle);
                    run_timer(lsound_duration_arr[1]);
                    $('#timer').hide();
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/writing/'+lsound_arr[1];
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    break;
                case 5:
                    $('.button.next').show();
                    clearInterval(intervalHandle);
                    run_timer(1200);
                    $('#timer').show();
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/writing/'+ssound_arr[1];
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    break;
                case 6:
                    $('.button.return').show();
                    break;
                case 7:
                    $('#current_position').hide();
                    clearInterval(intervalHandle);
                    $('#timer').hide();
                    $('.button.return').hide();
                    break;
                case 8:
                    $('#current_position').show();
                    $('#current_position').html('2 of 2');
                    run_timer(1800);
                    $('#timer').show();
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/writing/'+ssound_arr[2];
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div>\n\
                <script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    break;
                case 9:
                    $('.button.return').show();
                    break;
                case 10:
                    $('#current_position').hide();
                    clearInterval(intervalHandle);
                    $('#timer').hide();
                    $('.button.return').hide();
//                    var wid1 = '<?php echo $wid1?>';
//                    var wid2 = '<?php echo $wid2?>';
//                    var url = '<?php echo HelperURL::main_url(); ?>/toefl/marks_writing';
//                    writing1=$('#writing1_content').val();
//                    writing2=$('#writing2_content').val();
//
//                    $.post(url,{writing1:writing1,writing2:writing2,wid1:wid1,wid2:wid2}, function() {
//                    }, 'json');
                    break;
                case 11:
                    var wid1 = '<?php echo $wid1?>';
                    var wid2 = '<?php echo $wid2?>';
                    var url = '<?php echo HelperURL::main_url(); ?>/toefl/marks_writing';
                    var cid = '<?php echo $cid?>';
                    writing1=$('#writing1_content').val();
                    writing2=$('#writing2_content').val();
                    $.post(url,{writing1:writing1,writing2:writing2,wid1:wid1,wid2:wid2,cid:cid}, function(data) {
                    }, 'json');
                      window.location = "<?php echo HelperURL::main_url() ?>toefl/finished/id/"+data+"/part/writing";
                    break;
                default:
                }
            });
        });
</script>
