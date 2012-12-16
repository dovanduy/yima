<input type="hidden" id="current_question" value="1"/>
<input type="hidden" id="current_timer" value="<?php echo $reading['test_time']; ?>"/>
<div id="direction">
    <h3 class="center">Section Directions</h3>
    <p>In the reading test, you will read a variety of texts andanswer several different types of reading comprehension 
        questions. The entire Reading Test will last 75 minutes. There are three parts, and directions are given for each 
        part. You are encouraged to answer as many questions as possible within the time allowed. </p>

    <p>The Reading section is divided into separately timed parts. A clock at the top will show you how much time is remaining.</p>

    <p>You can move to the next question by clicking on <strong>Next</strong>. You can skip questions and go back to them later as long as there is time remaining in the part you are working on. If you want to return to previous questions, click on <strong>Back</strong>.</p>
    <p>You can click on <strong>Review</strong> at any time and the review screen will show you which questions you have answered and which you have Not Answereded. From this review screen, you may go directly to any question you have already seen within the part of the reading section you are working on.</p>
    <p>You will now begin the Reading section. You will read 1 passage. You will have <strong>75 minutes</strong> to read the passage and answer the questions.</p>
    <p>Click on <strong>Continue</strong> to go on.</p>
</div>
<div id="reading_text" style="display: none;">
    <article class="half-block left_panel">
        <div class="article-container">
            <section>
                <p>Read the whole passage before you begin to answer the question.</p>
                <p>However you will see the passage again with the question.</p>
                <p style="margin-top: 30px; font-weight: bold;">When you are ready to go on to the questions, click on Next</p>
            </section>
        </div>
    </article>
    <article class="half-block text clearrm">
        <div class="article-container">
            <header><h2><?php echo $reading['title']; ?></h2></header>
            <section><?php echo $reading['content']; ?></section>
        </div>
    </article>     
    <div class="clearfix"></div>
</div>
<div id="review" style="display: none;">
    <div id="review_inner">
        <table>
            <tr>
                <th class="center" width="100">Number</th>
                <th class="center" width="500">Question</th>
                <th class="center" width="100">Status</th>
                <th class="center" width="100">View</th>
            </tr>
            <?php
            if (isset($reading_part5)) {
                foreach ($reading_part5 as $row) {
                    ?>
                    <tr>
                        <td class="center"><?php echo $row['number_question']; ?></td>
                        <td><?php echo $row['content']; ?></td>
                        <td class="center" id="status<?php echo $row['number_question']; ?>">Not Answered</td>
                        <td class="center"><a href="#" alt="<?php echo $row['number_question']; ?>" class="button view_question">View</a></td>
                    </tr>
                    <?php
                }
            }
            ?>
            <?php
            if (isset($reading_part6)) {
                foreach ($reading_part6 as $row) {
                    ?>
                    <tr>
                        <td class="center"><?php echo $row['number_question']; ?></td>
                        <td><?php echo $row['content']; ?></td>
                        <td class="center" id="status<?php echo $row['number_question']; ?>">Not Answered</td>
                        <td class="center"><a href="#" alt="<?php echo $row['number_question']; ?>" class="button view_question">View</a></td>
                    </tr>
                    <?php
                }
            }
            if (isset($reading_part7)) {
                foreach ($reading_part7 as $row) {
                    ?>
                    <tr>
                        <td class="center"><?php echo $row['number_question']; ?></td>
                        <td><?php echo $row['content']; ?></td>
                        <td class="center" id="status<?php echo $row['number_question']; ?>">Not Answered</td>
                        <td class="center"><a href="#" alt="<?php echo $row['number_question']; ?>" class="button view_question">View</a></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
<div id="confirmation" style="display: none;">
    <p>You have seen all of the questions in this of part of Reading section. You have time left to Review. As long as there is time remaining, you can check your work.</p>
    <p>Click on Return to keep working. Click on Continue to go on the next part of the test.</p>
    <p>One you leave this part of the Reading section you WILL NOT be able return to it.</p>
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
        
        $('.button.next').click(function(){
            var number_question=<?php echo $number_question; ?>;
            var current_question=parseInt($('#current_question').val());
            
            if (current_question==number_question){
                $('.question').hide();
                $('.button.back').hide();
                $('.button.next').hide();
                $('.button.return').show();
                $('.button.end_section').show();
                $('#confirmation').show();
            }else{
                current_question+=1;
                $('#current_question').val(current_question);
                $('#current_position').html(current_question+' of '+number_question);
                $('.question').hide();
                $('#question'+current_question).show();
                if (current_question>1) $('.button.back').show();
            }
        });
        
        $('.button.return').click(function(){
            $('#confirmation').hide();
            $('.button.end_section').hide();
            $('.button.next').show();
            $('.button.return').hide();
            var number_question=<?php echo $number_question; ?>;
            var current_question=parseInt($('#current_question').val());
            $('#current_question').val(current_question);
            $('#current_position').html(current_question+' of '+number_question);
            $('.question').hide();
            $('#question'+current_question).show();
            if (current_question>1) $('.button.back').show();
        });
        
        $('.part5_question, .part6_question, .part7_question').click(function(){
           
            question=$(this).attr('alt');
            $('#status'+question).html('Answered');
        });
        
        $('#oq .arrow').click(function(){
            question=$(this).attr('num');
            $('#status'+question).html('Answered');
        });
        
        $('.button.back').click(function(){
            var number_question=<?php echo $number_question; ?>;
            var current_question=parseInt($('#current_question').val());
            current_question-=1;
            $('#current_question').val(current_question);
            $('#current_position').html(current_question+' of '+number_question);
            $('.question').hide();
            $('#question'+current_question).show();       
            
            if (current_question==1) $('.button.back').hide();
        });
        
        $('.button.review').click(function(){
            $('.button.end_section').hide();
            $('.button.return').hide();
            $('.button.next').hide();
            $('.button.review').hide();
            $('.button.back').hide();
            $('.button.return_from_review').show();
            $('.question').hide();
            
            $('#review').show();
        });
        
        $('.button.end_section').click(function(){
            //OQ
            var oq_arr=[<?php echo $reading_oq_arr; ?>];
            var oq_id='<?php echo $reading_oq_arr; ?>';
            
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
            
            //DDQ
            var ddq_arr=[<?php echo $reading_ddq_arr; ?>];
            var ddq_id='<?php echo $reading_ddq_arr; ?>';
            
            var ddq_final_subject_arr=new Array();
            var ddq_final_choice_arr=new Array();
            
            for (var i = 0; i < ddq_arr.length; i++){
                var ddq_subject_arr=new Array();
                var ddq_choice_arr=new Array();
            
                $.each($('.ddq'+ddq_arr[i]), function() {
                    subject_id=$(this).attr('alt');
                    ddq_subject_arr.push(subject_id);
                    
                    var ddq_subject_choice_arr=new Array();
                    $.each($('#subject'+subject_id+' li a.remove_choice'), function() {
                        ddq_subject_choice_arr.push($(this).attr('alt'));
                    });
                    ddq_subject_choice=ddq_subject_choice_arr.join('/');
                    
                    ddq_choice_arr.push(ddq_subject_choice);
                });
                
                ddq_subject=ddq_subject_arr.join(';');
                ddq_choice=ddq_choice_arr.join(';');
                
                ddq_final_subject_arr.push(ddq_subject);
                ddq_final_choice_arr.push(ddq_choice);
                
            }
            
            ddq_subject=ddq_final_subject_arr.join(',');
            ddq_choice=ddq_final_choice_arr.join(',');
            
            
            //IQ
            var part7_arr=[<?php echo $reading_part7_arr; ?>];
            var part7_id='<?php echo $reading_part7_arr; ?>';
            var part7_choice_arr=new Array();
            for (var i = 0; i < part7_arr.length; i++){
                part7_choice_arr[i]=$('#part7'+part7_arr[i]).val();
            }
            part7_choice=part7_choice_arr.join(',');
            
            //MCQ
            var part6_arr=[<?php echo $reading_part6_arr; ?>];
            var part6_id='<?php echo $reading_part6_arr; ?>';
            var part6_choice_arr=new Array();
            for (var i = 0; i < part6_arr.length; i++){
                part6_checked='';
                var part6_checked_arr=new Array();
                $.each($('.part6'+part6_arr[i]), function() {
                    if ($(this).attr('checked')=='checked') part6_checked_arr.push($(this).val());
                });
                part6_checked=part6_checked_arr.join(';');
                part6_choice_arr[i]=part6_checked;
            }
            part6_choice=part6_choice_arr.join(',');
            
            //SCQ
            var part5_arr=[<?php echo $reading_part5_arr; ?>];
            var part5_id='<?php echo $reading_part5_arr; ?>';
            var choice_arr=new Array();
            for (var i = 0; i < part5_arr.length; i++){
                choice_arr[i]=$('input[name=part5'+part5_arr[i]+']:checked').val();
            }
            part5_choice=choice_arr.join(',');
            
            //post to reading_command
            var url = '<?php echo base_url(); ?>reading_command';
            $.post(url,{part5_id:part5_id,part5_choice:part5_choice,part6_id:part6_id,part6_choice:part6_choice,part7_id:part7_id,part7_choice:part7_choice,ddq_id:ddq_id,ddq_subject:ddq_subject,ddq_choice:ddq_choice, oq_id:oq_id, oq_choice:oq_choice}, function() {
                window.location = "<?php echo base_url(); ?>start";
            }, 'json');
            
        });

        $('.button.view_question').click(function(){
            $('.button.next').show();
            $('.button.review').show();
            $('.button.back').hide();
            $('.button.return_from_review').hide();
            var current_question=parseInt($(this).attr('alt'));
            $('#question'+current_question).show();
            if (current_question>1) $('.button.back').show();
            
            var number_question=<?php echo $number_question; ?>;
            $('#current_question').val(current_question);
            $('#current_position').html(current_question+' of '+number_question);
            
            $('#confirmation').hide();
            $('#review').hide();
        });

        $('.button.return_from_review').click(function(){
            $('.button.next').show();
            $('.button.review').show();
            $('.button.back').hide();
            $('.button.return_from_review').hide();
            var current_question=parseInt($('#current_question').val());
            $('#question'+current_question).show();
            if (current_question>1) $('.button.back').show();
            
            $('#confirmation').hide();
            $('#review').hide();
        });
        
        $('.button.continue').click(function(){
            $('#timer').show();   
            $('.switch_timer').show();   
            $('#direction').hide();
            $('#reading_text').show();
            
            $('.button.continue').hide();            
            $('.button.next_reading').show();
            setInterval(run_timer, 1000); 
        });
        
        $('.button.next_reading').click(function(){
            $('#current_position').show();   
            $('#reading_text').hide();
            $('#question1').show();
            
            $('.button.review').show();
            $('.button.next_reading').hide();
            $('.button.next').show();            
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
        
        $('.square').click(function(){
            var current_question=parseInt($('#current_question').val());
            text=$(this).html();
            part7_title=$('#question'+current_question+' .part7_title').html();
            
            if (text=='&nbsp;') {
                $('#question'+current_question+' .square').html('&nbsp;');
                $(this).html(part7_title);
            }else{
                $(this).html('&nbsp;');
            }
        });
        
        function run_timer(){
            lbl_current_time=$('#timer').html();
            current_time=parseInt($('#current_timer').val());
            current_time-=1;
            $('#current_timer').val(current_time);
            if (lbl_current_time!='&nbsp;') {
                minute=Math.floor(current_time/60);
                second=Math.floor(current_time - minute*60);
                $('#timer').html(pad(minute, 2) + ' : ' + pad(second, 2));
            }
            if (current_time==0) $('.button.end_section').trigger('click');
        }
        
        function pad(number, length) {
            var str = '' + number;
            while (str.length < length) {
                str = '0' + str;
            }
            return str;
        }
        
        $('.arrow').click(function(){
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
