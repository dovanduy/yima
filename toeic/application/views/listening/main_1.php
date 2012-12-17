<input type="hidden" id="video_duration" value="0"/>
<input type="hidden" id="current_video_duration" value="0"/>

<input type="hidden" id="question_duration" value="0"/>
<input type="hidden" id="current_question_duration" value="0"/>

<input type="hidden" id="sentence_duration" value="0"/>
<input type="hidden" id="current_sentence_duration" value="0"/>

<input type="hidden" id="current_question" value="-2"/>
<input type="hidden" id="current_timer" value="<?php echo $listening['test_time']; ?>"/>

<div class="sound"></div>
<div id="headset" class="systempage systempage2" style="margin-top: 110px;">
    <p class="center">Now put on your headset</p>
    <p class="center"><img src="<?php echo base_url(); ?>img/headset.jpg"/></p>
    <p class="center">Click on <strong>Continue</strong> to go on</p>
</div>
<?php /* <div id="changing_volume" class="systempage systempage2" style="margin-top: 80px; display: none;">
  <h3 class="center">CHANGING THE VOLUME</h3>
  <p>To change the volume, click on the Volume button at the top of the screen. The volume control will appear. Move the volume indicator to the left or to the right to change the volumne.</p>
  <p>To close the volume control, click on the Volume button again.</p>
  <p>You will be able to change the volume during the test if you need to.</p>
  <p class="center" style="margin-top: 30px; font-weight: bold;">You may now change the volume.<br/> When you are finished, click on Continue.</p>
  </div> */ ?>
<div id="direction" class="systempage systempage1" style="padding: 30px 100px 0 100px; display: none;">
    <h3 class="center">SECTION DIRECTIONS</h3>
    <p>This section measures your ability to understand conversations and lectures in English.</p>
    <p>The Listening section is divided into separately timed parts.</p>
    <p>After each conversation or lecture, you will answer some questions about it. The questions typically ask about the main idea and supporting details. Some questions ask about a speaker's purpose or attitude. Answer the questions based on what is stated or implied by the speakers.</p>
    <p>You may take notes while you listen. You may use your notes to help you answer the questions. Your notes will not be scored.</p>
    <p>If you need to change the volume while you listen, check the volume of the computer that you are using.</p>
    <p>In some questions, you will see this icon: <img src="<?php echo base_url(); ?>img/replay.gif" style="border: none;"/> This means that you will hear, but not see, part of the question.</p>
    <p>You must answer each question. After you answer, click on Next. Then click OK to confirm your answer and go on to the next question. After you click on OK, you cannot return to previous questions.</p>
    <p>A clock at the top of the screen will show you how much time is remaining. The clock will count down only while you are answering questions.</p>
    <p>You will now begin this part of the Listening section.</p>
</div>
<div id="video" class="systempage systempage0" style="display: none;">
    
    <div class="progress-bar blue large">
    </div>
</div>

<!-- JS Libs at the end for faster loading -->
<script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.tools.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="js/jquery/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
<script src="<?php echo base_url(); ?>js/selectivizr.js"></script>
<script src="<?php echo base_url(); ?>js/jquery_002.js"></script>
<script src="<?php echo base_url(); ?>js/login.js"></script>
<script>
    $().ready(function(){
        
        $(".range").rangeinput();
        
        $('.volume').click(function(){
            $('#volume').toggle();
        });
        
        height=$(window).height();
        var vinTop = (height - 40 - $('.article-container').height())/2;
        if(vinTop<0)vinTop=0;
        $('.test').css("margin-top", vinTop + 'px');
        
        var video_timer = null;
        var question_timer = null;
        var sentence_timer = null;
        var main_timer = null;		
		
        function stop_video_timer(){clearInterval(video_timer);}
        function stop_question_timer(){clearInterval(question_timer);}
        function stop_sentence_timer(){clearInterval(sentence_timer);}
        function stop_main_timer(){clearInterval(main_timer);}
		
        function start_video_timer(){video_timer=setInterval(fn_video_timer, 1000);}
        function start_question_timer(){question_timer=setInterval(fn_question_timer, 1000);}
        function start_sentence_timer(){sentence_timer=setInterval(fn_sentence_timer, 1000);}
        function start_main_timer(){main_timer=setInterval(fn_main_timer, 1000);}
		
        function fn_video_timer(){
            video_duration=parseInt($('#video_duration').val());
            
            current_video_duration=parseInt($('#current_video_duration').val());
            current_video_duration++;
            $('#current_video_duration').val(current_video_duration);
            
            percent=Math.floor(current_video_duration/video_duration*100);
            percent_width=Math.floor(current_video_duration/video_duration*335);
			
            $('#video .progress-bar').html('<div style="width: '+percent_width+'px;"><span>'+percent+'<sup>%</sup></span></div>');
			
            //end of video
            if (current_video_duration>=video_duration) {
                stop_video_timer();
				
                current_question=parseInt($('#current_question').val());
				
                if (current_question>0){
                    play_question(current_question);
                }else{
                    next_step();
                }
            }
        }		
		
        function fn_question_timer(){
            question_duration=parseInt($('#question_duration').val());
            
            current_question_duration=parseInt($('#current_question_duration').val());
            current_question_duration++;
            $('#current_question_duration').val(current_question_duration);
			
            if (current_question_duration>=question_duration) {
                stop_question_timer();
				
                current_question=parseInt($('#current_question').val());
                sentence=$('#question'+current_question+' .sentence_sound').val();
                if (sentence==''){
                    show_quiz();
                }else{
                    replay_sentence();
                }
            }
        }
		
        function fn_sentence_timer(){
            sentence_duration=parseInt($('#sentence_duration').val());
            
            current_sentence_duration=parseInt($('#current_sentence_duration').val());
            current_sentence_duration++;
            $('#current_sentence_duration').val(current_sentence_duration);
			
            if (current_sentence_duration>=sentence_duration) {
                stop_sentence_timer();
                show_quiz();               
            }
        }
		
        function show_quiz(){
            $('.answer').show();
            start_main_timer();
            enable_button('.button.ok',0);
            enable_button('.button.next',0);
        }
		
        function fn_main_timer(){
            lbl_current_time=$('#timer').html();
			
            current_timer=parseInt($('#current_timer').val());
            current_timer-=1;
            $('#current_timer').val(current_timer);
			
            if (lbl_current_time!='&nbsp;') {
                minute=Math.floor(current_timer/60);
                second=Math.floor(current_timer - minute*60);
                $('#timer').html(pad(minute, 2) + ' : ' + pad(second, 2));
            }
			
            //run out of time
            if (current_timer==0) $('.button.end_section').trigger('click');
        }
		
        function play_video(replay, from_time, to_time, filename){
            close_all_page();
            stop_all_timers();
								
            if (replay==0){
                lsound='<?php echo HelperURL::upload_url() ?><?php echo $listening['lsound']; ?>';
                $('#video_duration').val(<?php echo $listening['lsound_duration']; ?>);
                $('#current_video_duration').val(0);
            }else{
                lsound='<?php echo HelperURL::upload_url(); ?> <?php echo $listening['lsound'];?>';
                $('#video_duration').val(to_time);
                $('#current_video_duration').val(from_time);
            }
		
            var player_url='<?php echo base_url(); ?>js/player.swf';
            $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");

            //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
            //$('.button.next').hide();						
			
            $('.systempage0').show();
            start_video_timer();
        }
		
        function replay_sentence(){
            stop_all_timers();
		
            var lsound='<?php echo base_url(); ?>admin/data/sounds/listening/sentence_sound/scq/'+$('#question'+current_question+' .sentence_sound').val();
            //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
            var player_url='<?php echo base_url(); ?>js/player.swf';
            $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");

            $('#sentence_duration').val(parseInt($('#question'+current_question+' .sentence_sound_duration').val()));
            $('#current_sentence_duration').val(0);
            start_sentence_timer();
        }
		
        function play_question(current_question){
            close_all_page();
            stop_all_timers();
			
            $('#question'+current_question).show();
            $('#current_position').show();
            $('#current_position').html(current_question+' of '+number_question);
            $('#timer').show();   
            $('.switch_timer').show();
			
            var lsound='<?php echo base_url(); ?>admin/data/sounds/listening/'+$('#question'+current_question+' .question_type').val()+'/'+$('#question'+current_question+' .lsound').val();
            var player_url='<?php echo base_url(); ?>js/player.swf';
            $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
            //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
            $('#question_duration').val(parseInt($('#question'+current_question+' .lsound_duration').val()));
            $('#current_question_duration').val(0);
            start_question_timer();
			
            $('.button.next').html('Next');
            $('.button.next').show();
            $('.button.ok').show();
									
            $('.answer').hide();
			
            enable_button('.button.ok',0);
            enable_button('.button.next',0);
        }				
				
        function next_step(){			
            close_all_page();
            stop_all_timers();
			
            number_question=<?php echo $number_question; ?>;
			
            current_question=parseInt($('#current_question').val());
            current_question+=1;			
            $('#current_question').val(current_question);                
			
            switch (current_question){
                case -2:
                    var lsound='<?php echo base_url(); ?>admin/data/sounds/system/listening_change_volume.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    
                    $('.systempage2').show();
                    break;
					
                case -1:
                    var lsound='<?php echo base_url(); ?>admin/data/sounds/system/listening_direction1.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    $('.systempage1').show();
                    
                    break;
					
                case 0:					
                    play_video(0,0,0,'');					
                    break;
					
                default:
                    replay=$('#question'+current_question+' .replay').val();
                    if (replay==1){
                        replay_from=$('#question'+current_question+' .replay_from').val();
                        replay_to=$('#question'+current_question+' .replay_to').val();
                        replay_sound=$('#question'+current_question+' .replay_sound').val();
												
                        play_video(replay,replay_from,replay_to,replay_sound);
                    }else{
                        play_question(current_question);
                    }
                }
            }
		
            function close_all_page(){
                $('.systempage').hide();
                $('.question').hide();						
            }
		
            function stop_all_timers(){
                stop_video_timer();
                stop_question_timer();
                stop_sentence_timer();
                stop_main_timer();
            }
        
            $('.button.next').click(function(){
                current_question=parseInt($('#current_question').val());
                if (current_question<=0){
                    next_step();
                }else{
                    enable_button('.button.ok',1);
                    enable_button('.button.next',0);
                }                                 
            });
        
            function enable_button(class_name,enabled){
                if (enabled==1){
                    $(class_name).attr("disabled", false);
                    $(class_name).removeClass("disabled");
                }else{
                    $(class_name).attr("disabled", true);
                    $(class_name).addClass("disabled");
                }
            }
        
            $('input[type=radio],input[type=checkbox]').click(function(){
                enable_button('.button.ok',0);
                enable_button('.button.next',1);
            });
        
            $('.button.ok').click(function(){
                current_question=parseInt($('#current_question').val());
                if (current_question>0){				
                    if (current_question>=number_question){
                        $('.button.end_section').trigger('click');
                    } else {    
                        next_step();
                    }			
                }
            
            });
        
            $('.button.end_section').click(function(){
                //OQ
                var oq_arr=[<?php echo $listening_oq_arr; ?>];
                var oq_id='<?php echo $listening_oq_arr; ?>';
            
                var oq_choice_arr=new Array();
                for (var i = 0; i < oq_arr.length; i++){
                    var oq_order_arr=new Array();
                
                    oq_order_arr.push($('.oq'+oq_arr[i]+' .choice1').attr('alt'));
                    oq_order_arr.push($('.oq'+oq_arr[i]+' .choice2').attr('alt'));
                    oq_order_arr.push($('.oq'+oq_arr[i]+' .choice3').attr('alt'));
                    oq_order_arr.push($('.oq'+oq_arr[i]+' .choice4').attr('alt'));
                
                    console.log(oq_order_arr);
                
                    oq_order=oq_order_arr.join(';');
                    oq_choice_arr[i]=oq_order;
                }
                oq_choice=oq_choice_arr.join(',');
            
                //CQ
                var cq_arr=[<?php echo $listening_cq_arr; ?>];
                var cq_id='<?php echo $listening_cq_arr; ?>';
                var cq_choice_arr=new Array();
                for (var i = 0; i < cq_arr.length; i++){
                    var cq_rowcol_arr=new Array();
                    $.each($('.cq'+cq_arr[i]), function() {
                        row_id=$(this).attr('alt');
                        col_id=$('input[name=row'+row_id+']:checked').val();
                        cq_rowcol_arr.push(row_id+"/"+col_id);
                    });
                    cq_rowcol=cq_rowcol_arr.join(';');
                    cq_choice_arr.push(cq_rowcol);
                }
                cq_choice=cq_choice_arr.join(',');
            
            
                //MCQ
                var mcq_arr=[<?php echo $listening_mcq_arr; ?>];
                var mcq_id='<?php echo $listening_mcq_arr; ?>';
                var mcq_choice_arr=new Array();
                for (var i = 0; i < mcq_arr.length; i++){
                    mcq_checked='';
                    var mcq_checked_arr=new Array();
                    $.each($('.mcq'+mcq_arr[i]), function() {
                        if ($(this).attr('checked')=='checked') mcq_checked_arr.push($(this).val());
                    });
                    mcq_checked=mcq_checked_arr.join(';');
                    mcq_choice_arr[i]=mcq_checked;
                }
                mcq_choice=mcq_choice_arr.join(',');
            
            
                //SCQ
                var scq_arr=[<?php echo $listening_scq_arr; ?>];
                var scq_id='<?php echo $listening_scq_arr; ?>';
                var choice_arr=new Array();
                for (var i = 0; i < scq_arr.length; i++){
                    choice_arr[i]=$('input[name=scq'+scq_arr[i]+']:checked').val();
                }
                scq_choice=choice_arr.join(',');
            
                //post to listening_command
                var url = '<?php echo base_url(); ?>listening_command';
                $.post(url,{scq_id:scq_id,scq_choice:scq_choice,mcq_id:mcq_id,mcq_choice:mcq_choice,cq_id:cq_id,cq_choice:cq_choice, oq_id:oq_id, oq_choice:oq_choice}, function() {
                    window.location = "<?php echo base_url(); ?>start";
                }, 'json');
        
            });
        
            $('.switch_timer').click(function(){
                lbl_current_time=$('#timer').html();
                current_time=$('#current_timer').val();
                if (lbl_current_time=='&nbsp;') {
                    minute=Math.floor(current_time/60);
                    second=Math.floor(current_time - minute*60);
                    $('#timer').html(pad(minute, 2) + ' : ' + pad(second, 2));
                }else{
                    $('#timer').html('&nbsp;');
                }
            });
        
            function pad(number, length) {
                var str = '' + number;
                while (str.length < length) {
                    str = '0' + str;
                }
                return str;
            }
            
            $('.arrow').click(function(){
                enable_button('.button.ok',0);
                enable_button('.button.next',1);
                
                question=$(this).attr('num');
            
                exchange = $(this).attr('alt');
                current = $(this).attr('value');
            
                text=$('#question'+question+' .choice'+current+' span').html();
                $('#question'+question+' .choice'+current+' span').html($('#question'+question+' .choice'+exchange+' span').html());
                $('#question'+question+' .choice'+exchange+' span').html(text);
            
                id = $('#question'+question+' .choice'+current).attr('alt');
                $('#question'+question+' .choice'+current).attr('alt',$('#question'+question+' .choice'+exchange).attr('alt'));
                $('#question'+question+' .choice'+exchange).attr('alt',id);
            });
        });
</script>