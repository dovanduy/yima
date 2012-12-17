<input type="hidden" id="volume" value="50"/>
<input type="hidden" id="duration" value="0"/>
<input type="hidden" id="current_duration" value="0"/>
<input type="hidden" id="current_question" value="1"/>
<div class="preload" style="display: none;">
    <?php $user_id=7?>
    <img src="<?php echo base_url(); ?>admin/data/sound/system/speaking_direction_1.mp3"/>
    <img src="<?php echo base_url(); ?>admin/data/sound/system/speaking_direction_2.mp3"/>

    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking1['lsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking2['lsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking3['lsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking4['lsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking5['lsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking6['lsound'] ?>"/>

    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking1['ssound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking2['ssound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking3['ssound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking4['ssound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking5['ssound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking6['ssound'] ?>"/>

    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking1['dsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking2['dsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking3['dsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking4['dsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking5['dsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking6['dsound'] ?>"/>

    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking1['introsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking2['introsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking3['introsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking4['introsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking5['introsound'] ?>"/>
    <img src="<?php echo HelperURL::upload_url() ?>audio/toefl/speaking/<?php echo $speaking6['introsound'] ?>"/>

    <img src="<?php echo base_url(); ?>img/sound/sp1.mp3"/>
    <img src="<?php echo base_url(); ?>img/sound/sp2.mp3"/>
    <img src="<?php echo base_url(); ?>img/sound/sp3.mp3"/>
    <img src="<?php echo base_url(); ?>img/sound/sp4.mp3"/>
    <img src="<?php echo base_url(); ?>img/sound/sp5.mp3"/>
    <img src="<?php echo base_url(); ?>img/sound/sp6.mp3"/>

    <img src="<?php echo base_url(); ?>img/sound/prepare_response.mp3"/>
    <img src="<?php echo base_url(); ?>img/sound/sp_afterbeep.mp3"/>
    <img src="<?php echo base_url(); ?>img/sound/speaking_direction_reading.mp3"/>

</div>
<div class="sound">
    <div id="lsound">Loading the player ...</div>
    <script type="text/javascript">
        jwplayer("lsound").setup({ flashplayer: "<?php echo base_url(); ?>js/player.swf", file: "<?php echo base_url(); ?>admin/data/sound/system/speaking_direction_1.mp3",
            height: 0,
            width: 250,
            autostart: true
        });
    </script>
</div>
<div class="step direction step1">
    <img src="<?php echo base_url(); ?>img/headset_small.jpg" alt=""/>
    <p class="bold">Make sure your headset is on and your microphone or recording device is ready.</p>
    <p>Before the test begins, you should check the microphone connection and volume.</p>
    <p>In this section you will record your responses to the questions, but you will not be able to play back your recorded responses until the end of the test.</p>
    <p>Follow these steps to make sure your microphone is working before you start recording your responses.</p>
    <p>Place your microphone in front of your mouth.</p>
    <p>Click <strong>Record</strong> and speak into your microphone.<br/>
        Click <strong>Stop</strong>.<br/>
        Click <strong>Play</strong>.</p>
    <p>If your voice does not play back, check your microphone connections and the volume of the computer.</p>
    <p>If you hear your voice and it is loud enough, click on Continue to begin.</p>
</div>
<div class="step direction direction2 step2" style="display: none;">
    <h3 class="center">Section Directions</h3>
    <p>In this section of the test, you will be able to demonstrate your ability to speak about a variety of topics. You will answer six questions. Answer each of the questions as completely as possible.</p>
    <p>In questions 1 and 2, you will speak about familiar topics. You need to demonstrate your ability to speak clearly and coherently about the topics.</p>
    <p>In questions 3 and 4, you will first read a short text. The text will go away and you will then listen to a talk on the same topic. You will then be asked a question about what you have read and heard. You will need to combine appropriate information from the text and the talk to provide a complete answer to the question. You need to demonstrate your ability to speak clearly and coherently and to accurately convey information about what you read and heard.</p>
    <p>In questions 5 and 6, you will first listen to part of a conversation or a lecture. You will then be asked a question about what you heard. You need to demonstrate your ability to speak clearly and coherently and on your ability to accurately convey information about what you heard.</p>
    <p>You may take notes while you read and while you listen to the conversations and lectures. You may use your notes to help you prepare your response.</p>
    <p>Listen carefully to the directions for each question. The directions will not be written on the screen.</p>
    <p>For each question, you will be given a short time to prepare your response. A clock will show how much preparation time is remaining. When the preparation time is up, you will be told to begin your response. A clock will show how much time is remaining. A message will appear on the screen when the response time has ended.</p>
</div>
<!-- SPEAKING 01 -->
<div class="video_part step step3" style="display: none;">
    <div class="video_image"><img src="<?php echo base_url(); ?>img/headset.jpg" height="200"/></div>
</div>
<div class="step step4 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking1['subject']; ?></p>
</div>
<div class="step step5 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking1['subject']; ?></p>
    <p class="preparation_time">Preparation Time: 15 seconds</p>
</div>
<div class="step step6 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking1['subject']; ?></p>
    <p class="preparation_time">Preparation Time: 15 seconds</p>
    <div class="center"><img src="<?php echo base_url(); ?>img/off.gif" alt=""/></div>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step7 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking1['subject']; ?></p>
    <p class="preparation_time">Recording: 45 seconds</p>
</div>
<div class="step step8 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking1['subject']; ?></p>
    <p class="preparation_time">Recording: 45 seconds</p>
    <div class="center"><img src="<?php echo base_url(); ?>img/on.gif" alt=""/></div>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>

<div class="step step9 testing_part" style="display: none;">
    <p class="subject">Stop Recording 01 ...</p>
    <p class="preparation_time">Time: 5 seconds</p>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step10 testing_part" style="display: none;">
    <p class="subject">Saving Recording 01 ...</p>
    <p class="preparation_time">Time: 20 seconds</p>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>


<!-- SPEAKING 02 -->
<div class="video_part step step11" style="display: none;">
    <div class="video_image"><img src="<?php echo base_url(); ?>img/headset.jpg" height="200"/></div>
</div>
<div class="step step12 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking2['subject']; ?></p>
</div>
<div class="step step13 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking2['subject']; ?></p>
    <p class="preparation_time">Preparation Time: 15 seconds</p>
</div>
<div class="step step14 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking2['subject']; ?></p>
    <p class="preparation_time">Preparation Time: 15 seconds</p>
    <div class="center"><img src="<?php echo base_url(); ?>img/off.gif" alt=""/></div>
    <p class="sub_timer">00:00</p>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step15 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking2['subject']; ?></p>
    <p class="preparation_time">Recording: 45 seconds</p>
</div>
<div class="step step16 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking2['subject']; ?></p>
    <p class="preparation_time">Recording: 45 seconds</p>
    <div class="center"><img src="<?php echo base_url(); ?>img/on.gif" alt=""/></div>
    <p class="sub_timer">00:00</p>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>

<div class="step step17 testing_part" style="display: none;">
    <p class="subject">Stop Recording 02 ...</p>
    <p class="preparation_time">Time: 5 seconds</p>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step18 testing_part" style="display: none;">
    <p class="subject">Saving Recording 02 ...</p>
    <p class="preparation_time">Time: 20 seconds</p>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>

<!-- SPEAKING 03 -->
<div class="video_part step step19" style="display: none;">
    <div class="video_image"><img src="<?php echo base_url(); ?>img/headset.jpg" height="200"/></div>
</div>
<div class="reading_part step step20" style="display: none;">
    <div class="bold italic">Directions:</div>
    <p><?php echo $speaking3['direction']; ?></p>
</div>
<div class="reading_part step step21" style="display: none;">
    <div class="bold italic">Directions:</div>
    <p><?php echo $speaking3['direction']; ?></p>
    <div class="bold italic reading_time">Reading Time: 45 seconds</div>
    <div style="border: 1px solid #CCCCCC; height: 250px; margin-top: 20px; overflow-y: scroll; padding: 10px 20px 10px 10px;">
        <?php echo $speaking3['content']; ?>
    </div>
    <p class="sub_timer">00:00</p>
    <div class="progress-bar blue small">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="video_part step step22" style="display: none;">
    <div class="video_image"><img src="<?php echo HelperURL::upload_url(); ?>media/toefl/speaking/2012/11/<?php echo $speaking3['limg']; ?>" height="200"/></div>
    <div class="progress-bar blue large">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>


<div class="step step23 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking3['subject']; ?></p>
</div>
<div class="step step24 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking3['subject']; ?></p>
    <p class="preparation_time">Preparation Time: 30 seconds</p>
</div>
<div class="step step25 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking3['subject']; ?></p>
    <p class="preparation_time">Preparation Time: 30 seconds</p>
    <div class="center"><img src="<?php echo base_url(); ?>img/off.gif" alt=""/></div>
    <p class="sub_timer">00:00</p>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step26 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking3['subject']; ?></p>
    <p class="preparation_time">Recording: 60 seconds</p>
</div>
<div class="step step27 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking3['subject']; ?></p>
    <p class="preparation_time">Recording: 60 seconds</p>
    <div class="center"><img src="<?php echo base_url(); ?>img/on.gif" alt=""/></div>
    <p class="sub_timer">00:00</p>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>

<div class="step step28 testing_part" style="display: none;">
    <p class="subject">Stop Recording 03 ...</p>
    <p class="preparation_time">Time: 5 seconds</p>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step29 testing_part" style="display: none;">
    <p class="subject">Saving Recording 03 ...</p>
    <p class="preparation_time">Time: 20 seconds</p>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>


<!-- SPEAKING 04 -->
<div class="video_part step step30" style="display: none;">
    <div class="video_image"><img src="<?php echo base_url(); ?>img/headset.jpg" height="200"/></div>
</div>
<div class="reading_part step step31" style="display: none;">
    <div class="bold italic">Directions:</div>
    <p><?php echo $speaking4['direction']; ?></p>
</div>
<div class="reading_part step step32" style="display: none;">
    <div class="bold italic">Directions:</div>
    <p><?php echo $speaking4['direction']; ?></p>
    <div class="bold italic reading_time">Reading Time: 45 seconds</div>
    <div style="border: 1px solid #CCCCCC; height: 250px; margin-top: 20px; overflow-y: scroll; padding: 10px 20px 10px 10px;">
        <?php echo $speaking4['content']; ?>
    </div>
    <p class="sub_timer">00:00</p>
    <div class="progress-bar blue small">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>

<div class="video_part step step33" style="display: none;">
    <div class="video_image"><img src="<?php echo HelperURL::upload_url(); ?>media/toefl/speaking/2012/11/<?php echo $speaking4['limg']; ?>" height="200"/></div>
    <div class="progress-bar blue large">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>

<div class="step step34 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking4['subject']; ?></p>
</div>
<div class="step step35 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking4['subject']; ?></p>
    <p class="preparation_time">Preparation Time: 30 seconds</p>
</div>
<div class="step step36 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking4['subject']; ?></p>
    <p class="preparation_time">Preparation Time: 30 seconds</p>
    <div class="center"><img src="<?php echo base_url(); ?>img/off.gif" alt=""/></div>
    <p class="sub_timer">00:00</p>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step37 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking4['subject']; ?></p>
    <p class="preparation_time">Recording: 60 seconds</p>
</div>
<div class="step step38 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking4['subject']; ?></p>
    <p class="preparation_time">Recording: 60 seconds</p>
    <div class="center"><img src="<?php echo base_url(); ?>img/on.gif" alt=""/></div>
    <p class="sub_timer">00:00</p>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>

<div class="step step39 testing_part" style="display: none;">
    <p class="subject">Stop Recording 04 ...</p>
    <p class="preparation_time">Time: 5 seconds</p>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step40 testing_part" style="display: none;">
    <p class="subject">Saving Recording 04 ...</p>
    <p class="preparation_time">Time: 20 seconds</p>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>

<!-- SPEAKING 05 -->
<div class="video_part step step41" style="display: none;">
    <div class="video_image"><img src="<?php echo base_url(); ?>img/headset.jpg" height="200"/></div>
</div>
<div class="video_part step step42" style="display: none;">
    <div class="video_image"><img src="<?php echo HelperURL::upload_url(); ?>media/toefl/speaking/2012/11/<?php echo $speaking5['limg']; ?>" height="200"/></div>
    <div class="progress-bar blue large">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step43 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking5['subject']; ?></p>
</div>
<div class="step step44 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking5['subject']; ?></p>
    <p class="preparation_time">Preparation Time: 30 seconds</p>
</div>
<div class="step step45 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking5['subject']; ?></p>
    <p class="preparation_time">Preparation Time: 30 seconds</p>
    <div class="center"><img src="<?php echo base_url(); ?>img/off.gif" alt=""/></div>
    <p class="sub_timer">00:00</p>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step46 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking5['subject']; ?></p>
    <p class="preparation_time">Recording: 60 seconds</p>
</div>
<div class="step step47 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking5['subject']; ?></p>
    <p class="preparation_time">Recording: 60 seconds</p>
    <div class="center"><img src="<?php echo base_url(); ?>img/on.gif" alt=""/></div>
    <p class="sub_timer">00:00</p>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>

<div class="step step48 testing_part" style="display: none;">
    <p class="subject">Stop Recording 05 ...</p>
    <p class="preparation_time">Time: 5 seconds</p>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step49 testing_part" style="display: none;">
    <p class="subject">Saving Recording 05 ...</p>
    <p class="preparation_time">Time: 20 seconds</p>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>

<!-- SPEAKING 06 -->
<div class="video_part step step50" style="display: none;">
    <div class="video_image"><img src="<?php echo base_url(); ?>img/headset.jpg" height="200"/></div>
</div>
<div class="video_part step step51" style="display: none;">
    <div class="video_image"><img src="<?php echo HelperURL::upload_url(); ?>media/toefl/speaking/2012/11/<?php echo $speaking6['limg']; ?>" height="200"/></div>
    <div class="progress-bar blue large">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step52 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking6['subject']; ?></p>
</div>
<div class="step step53 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking6['subject']; ?></p>
    <p class="preparation_time">Preparation Time: 30 seconds</p>
</div>
<div class="step step54 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking6['subject']; ?></p>
    <p class="preparation_time">Preparation Time: 30 seconds</p>
    <div class="center"><img src="<?php echo base_url(); ?>img/off.gif" alt=""/></div>
    <p class="sub_timer">00:00</p>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step55 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking6['subject']; ?></p>
    <p class="preparation_time">Recording: 60 seconds</p>
</div>
<div class="step step56 testing_part" style="display: none;">
    <p class="subject"><?php echo $speaking6['subject']; ?></p>
    <p class="preparation_time">Recording: 60 seconds</p>
    <div class="center"><img src="<?php echo base_url(); ?>img/on.gif" alt=""/></div>
    <p class="sub_timer">00:00</p>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>

<div class="step step57 testing_part" style="display: none;">
    <p class="subject">Stop Recording 06 ...</p>
    <p class="preparation_time">Time: 5 seconds</p>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>
<div class="step step58 testing_part" style="display: none;">
    <p class="subject">Saving Recording 06 ...</p>
    <p class="preparation_time">Time: 20 seconds</p>
    <div class="sub_timer">00:00</div>
    <div class="progress-bar blue medium">
        <div style="width: 0;">
            <span>0<sup>%</sup></span>
        </div>
    </div>
</div>

<div class="step step59 end_speaking" style="display: none;">
    <p>This is the end of Speaking Section.</p>
</div>
<div class="step step60 end_speaking" style="display: none;">
    <p>All of your results are saved.</p>
</div>

<?php /*
  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="550" height="400" id="recorder01" align="middle">
  <param name="movie" value="admin/data/student/speaking/<?php echo $user_id ?>/01/voicerecorder.swf" />
  <param name="quality" value="high" />
  <param name="bgcolor" value="#000000" />
  <param name="play" value="true" />
  <param name="loop" value="true" />
  <param name="wmode" value="window" />
  <param name="flashvars" value="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/01/config.xml?2" />
  <param name="scale" value="showall" />
  <param name="menu" value="true" />
  <param name="devicefont" value="false" />
  <param name="salign" value="" />
  <param name="allowScriptAccess" value="sameDomain" />
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="admin/data/student/speaking/<?php echo $user_id ?>/01/voicerecorder.swf" width="550" height="400">
  <param name="movie" value="admin/data/student/speaking/<?php echo $user_id ?>/01/voicerecorder.swf" />
  <param name="quality" value="high" />
  <param name="bgcolor" value="#000000" />
  <param name="play" value="true" />
  <param name="loop" value="true" />
  <param name="wmode" value="window" />
  <param name="flashvars" value="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/01/config.xml?2" />
  <param name="scale" value="showall" />
  <param name="menu" value="true" />
  <param name="devicefont" value="false" />
  <param name="salign" value="" />
  <param name="allowScriptAccess" value="sameDomain" />
  <!--<![endif]-->
  <a href="http://www.adobe.com/go/getflash">
  <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
  </a>
  <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
  </object>
 */ ?>
<div class="recorder_container">
    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="700" height="400" id="recorder01" align="middle">
        <param name="allowScriptAccess" value="sameDomain" />
        <param name="movie" value="<?php echo base_url()?>admin/data/student/speaking/<?php echo $user_id ?>/01/voicerecorder.swf" />
        <param name="quality" value="high" />
        <param name="bgcolor" value="#000000" />
        <param name="flashvars" value="confFile=<?php echo base_url()?>admin/data/student/speaking/<?php echo $user_id ?>/01/config.xml" />
        <param name="wmode" value="transparent">
        <embed src="<?php echo base_url()?>admin/data/student/speaking/<?php echo $user_id ?>/01/voicerecorder.swf" wmode="transparent" quality="high" flashvars="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/01/config.xml" bgcolor="#000000" width="700" height="400" id="recorder01" name="recorder01" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
    </object>
</div>

<?php /*

  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="700" height="400" id="recorder02" align="middle">
  <param name="allowScriptAccess" value="sameDomain" />
  <param name="movie" value="admin/data/student/speaking/<?php echo $user_id ?>/02/voicerecorder.swf" />
  <param name="quality" value="high" />
  <param name="bgcolor" value="#000000" />
  <param name="flashvars" value="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/02/config.xml" />
  <param name="wmode" value="transparent">
  <embed src="admin/data/student/speaking/<?php echo $user_id ?>/02/voicerecorder.swf" wmode="transparent" quality="high" flashvars="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/02/config.xml" bgcolor="#000000" width="700" height="400" id="recorder02" name="recorder02" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
  </object>

  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="700" height="400" id="recorder03" align="middle">
  <param name="allowScriptAccess" value="sameDomain" />
  <param name="movie" value="admin/data/student/speaking/<?php echo $user_id ?>/03/voicerecorder.swf" />
  <param name="quality" value="high" />
  <param name="bgcolor" value="#000000" />
  <param name="flashvars" value="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/03/config.xml" />
  <param name="wmode" value="transparent">
  <embed src="admin/data/student/speaking/<?php echo $user_id ?>/03/voicerecorder.swf" wmode="transparent" quality="high" flashvars="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/03/config.xml" bgcolor="#000000" width="700" height="400" id="recorder03" name="recorder03" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
  </object>

  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="700" height="400" id="recorder04" align="middle">
  <param name="allowScriptAccess" value="sameDomain" />
  <param name="movie" value="admin/data/student/speaking/<?php echo $user_id ?>/04/voicerecorder.swf" />
  <param name="quality" value="high" />
  <param name="bgcolor" value="#000000" />
  <param name="flashvars" value="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/04/config.xml" />
  <param name="wmode" value="transparent">
  <embed src="admin/data/student/speaking/<?php echo $user_id ?>/04/voicerecorder.swf" wmode="transparent" quality="high" flashvars="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/04/config.xml" bgcolor="#000000" width="700" height="400" id="recorder04" name="recorder04" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
  </object>

  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="700" height="400" id="recorder05" align="middle">
  <param name="allowScriptAccess" value="sameDomain" />
  <param name="movie" value="admin/data/student/speaking/<?php echo $user_id ?>/05/voicerecorder.swf" />
  <param name="quality" value="high" />
  <param name="bgcolor" value="#000000" />
  <param name="flashvars" value="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/05/config.xml" />
  <param name="wmode" value="transparent">
  <embed src="admin/data/student/speaking/<?php echo $user_id ?>/05/voicerecorder.swf" wmode="transparent" quality="high" flashvars="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/05/config.xml" bgcolor="#000000" width="700" height="400" id="recorder05" name="recorder05" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
  </object>

  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="700" height="400" id="recorder06" align="middle">
  <param name="allowScriptAccess" value="sameDomain" />
  <param name="movie" value="admin/data/student/speaking/<?php echo $user_id ?>/06/voicerecorder.swf" />
  <param name="quality" value="high" />
  <param name="bgcolor" value="#000000" />
  <param name="flashvars" value="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/06/config.xml" />
  <param name="wmode" value="transparent">
  <embed src="admin/data/student/speaking/<?php echo $user_id ?>/06/voicerecorder.swf" wmode="transparent" quality="high" flashvars="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/06/config.xml" bgcolor="#000000" width="700" height="400" id="recorder06" name="recorder06" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
  </object>
 */ ?>

<!-- JS Libs at the end for faster loading -->
<script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo base_url()?>js/jquery/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
<script src="<?php echo base_url(); ?>js/selectivizr.js"></script>
<script src="<?php echo base_url(); ?>js/jquery_002.js"></script>
<script src="<?php echo base_url(); ?>js/login.js"></script>
<script>
    function prepare_recorder(spk){
        $('.recorder_container').html(
        '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="700" height="400" id="recorder0'+spk+'" align="middle">'+
            '<param name="allowScriptAccess" value="sameDomain" />'+
            '<param name="movie" value="<?php echo base_url()?>admin/data/student/speaking/<?php echo $user_id ?>/0'+spk+'/voicerecorder.swf" />'+
            '<param name="quality" value="high" />'+
            '<param name="bgcolor" value="#000000" />'+
            '<param name="flashvars" value="confFile=./admin/data/student/speaking/<?php echo $user_id ?>/0'+spk+'/config.xml" />'+
            '<param name="wmode" value="transparent">'+
            '<embed src="<?php echo base_url()?>admin/data/student/speaking/<?php echo $user_id ?>/0'+spk+'/voicerecorder.swf" wmode="transparent" quality="high" flashvars="confFile=<?php echo base_url()?>admin/data/student/speaking/<?php echo $user_id ?>/0'+spk+'/config.xml" bgcolor="#000000" width="700" height="400" id="recorder0'+spk+'" name="recorder0'+spk+'" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />'+
            '</object>');
    }

    $().ready(function(){
        $.ajax({
            url: "<?php echo base_url(); ?>img/sound/speaking_direction_reading.mp3",
            success: function() {
            }
        });

        height=$(window).height();
        var vinTop = (height - 40 - $('.article-container').height())/2;
        if(vinTop<0)vinTop=0;
        $('.test').css("margin-top", vinTop + 'px');

        /*$('#recorder01').css("top", vinTop + 'px');
        $('#recorder02').css("top", vinTop + 'px');
        $('#recorder03').css("top", vinTop + 'px');
        $('#recorder04').css("top", vinTop + 'px');
        $('#recorder05').css("top", vinTop + 'px');
        $('#recorder06').css("top", vinTop + 'px');*/

        function enable_button(class_name,enabled){
            if (enabled==1){
                $(class_name).attr("disabled", false);
                $(class_name).removeClass("disabled");
            }else{
                $(class_name).attr("disabled", true);
                $(class_name).addClass("disabled");
            }
        }

        $('.skip_button').click(function(){
            $('#duration').val(1);
        });

        $('.button.record').click(function(){
            sendToFlash('recorder01').startRecording();
            enable_button('.record',0);
            enable_button('.play',0);
            enable_button('.stop',1);
        });

        $('.button.stop').click(function(){
            sendToFlash('recorder01').stopSound();
            enable_button('.record',1);
            enable_button('.play',1);
            enable_button('.stop',0);
        });

        $('.button.play').click(function(){
            sendToFlash('recorder01').playSound();
            enable_button('.record',0);
            enable_button('.play',0);
            enable_button('.stop',1);
        });

        var intervalHandle = null;

        function count_down(){
            var duration=parseInt($('#duration').val());

            var current_duration=parseInt($('#current_duration').val());
            current_duration++;
            $('#current_duration').val(current_duration);

            var current_question=parseInt($('#current_question').val());

            minute=Math.floor(current_duration/60);
            second=Math.floor(current_duration - minute*60);
            $('.step'+current_question+' .sub_timer').html(pad(minute, 2) + ' : ' + pad(second, 2));

            percent=Math.floor(current_duration/duration*100);
            percent_width=Math.floor(current_duration/duration*400);
            $('.step'+current_question+' .progress-bar').html('<div style="width: '+percent_width+'px;"><span>'+percent+'<sup>%</sup></span></div>')
            if (current_duration>=duration) {
                clearInterval(intervalHandle);
                $('.button.next').trigger('click');
            }
        }

        function pad(number, length) {
            var str = '' + number;
            while (str.length < length) {
                str = '0' + str;
            }
            return str;
        }

        function run_timer(time){
            $('#duration').val(time);
            $('#current_duration').val(0);
            intervalHandle = setInterval(count_down, 1000);
        }

        $('.button.next').click(function(){
            clearInterval(intervalHandle);
            //lsound
            var lsound_arr=new Array();
            var lsound_duration_arr=new Array();
            lsound_arr[1]='<?php echo $speaking1['lsound'] ?>';
            lsound_duration_arr[1]='<?php echo $speaking1['lsound_duration'] ?>';

            lsound_arr[2]='<?php echo $speaking2['lsound'] ?>';
            lsound_duration_arr[2]='<?php echo $speaking2['lsound_duration'] ?>';

            lsound_arr[3]='<?php echo $speaking3['lsound'] ?>';
            lsound_duration_arr[3]='<?php echo $speaking3['lsound_duration'] ?>';

            lsound_arr[4]='<?php echo $speaking4['lsound'] ?>';
            lsound_duration_arr[4]='<?php echo $speaking4['lsound_duration'] ?>';

            lsound_arr[5]='<?php echo $speaking5['lsound'] ?>';
            lsound_duration_arr[5]='<?php echo $speaking5['lsound_duration'] ?>';

            lsound_arr[6]='<?php echo $speaking6['lsound'] ?>';
            lsound_duration_arr[6]='<?php echo $speaking6['lsound_duration'] ?>';

            //ssound
            var ssound_arr=new Array();
            var ssound_duration_arr=new Array();
            ssound_arr[1]='<?php echo $speaking1['ssound'] ?>';
            ssound_duration_arr[1]='<?php echo $speaking1['ssound_duration'] ?>';

            ssound_arr[2]='<?php echo $speaking2['ssound'] ?>';
            ssound_duration_arr[2]='<?php echo $speaking2['ssound_duration'] ?>';

            ssound_arr[3]='<?php echo $speaking3['ssound'] ?>';
            ssound_duration_arr[3]='<?php echo $speaking3['ssound_duration'] ?>';

            ssound_arr[4]='<?php echo $speaking4['ssound'] ?>';
            ssound_duration_arr[4]='<?php echo $speaking4['ssound_duration'] ?>';

            ssound_arr[5]='<?php echo $speaking5['ssound'] ?>';
            ssound_duration_arr[5]='<?php echo $speaking5['ssound_duration'] ?>';

            ssound_arr[6]='<?php echo $speaking6['ssound'] ?>';
            ssound_duration_arr[6]='<?php echo $speaking6['ssound_duration'] ?>';

            //dsound
            var dsound_arr=new Array();
            var dsound_duration_arr=new Array();
            dsound_arr[1]='<?php echo $speaking1['dsound'] ?>';
            dsound_duration_arr[1]='<?php echo $speaking1['dsound_duration'] ?>';

            dsound_arr[2]='<?php echo $speaking2['dsound'] ?>';
            dsound_duration_arr[2]='<?php echo $speaking2['dsound_duration'] ?>';

            dsound_arr[3]='<?php echo $speaking3['dsound'] ?>';
            dsound_duration_arr[3]='<?php echo $speaking3['dsound_duration'] ?>';

            dsound_arr[4]='<?php echo $speaking4['dsound'] ?>';
            dsound_duration_arr[4]='<?php echo $speaking4['dsound_duration'] ?>';

            dsound_arr[5]='<?php echo $speaking5['dsound'] ?>';
            dsound_duration_arr[5]='<?php echo $speaking5['dsound_duration'] ?>';

            dsound_arr[6]='<?php echo $speaking6['dsound'] ?>';
            dsound_duration_arr[6]='<?php echo $speaking6['dsound_duration'] ?>';

            //introsound
            var introsound_arr=new Array();
            var introsound_duration_arr=new Array();
            introsound_arr[1]='<?php echo $speaking1['introsound'] ?>';
            introsound_duration_arr[1]='<?php echo $speaking1['introsound_duration'] ?>';

            introsound_arr[2]='<?php echo $speaking2['introsound'] ?>';
            introsound_duration_arr[2]='<?php echo $speaking2['introsound_duration'] ?>';

            introsound_arr[3]='<?php echo $speaking3['introsound'] ?>';
            introsound_duration_arr[3]='<?php echo $speaking3['introsound_duration'] ?>';

            introsound_arr[4]='<?php echo $speaking4['introsound'] ?>';
            introsound_duration_arr[4]='<?php echo $speaking4['introsound_duration'] ?>';

            introsound_arr[5]='<?php echo $speaking5['introsound'] ?>';
            introsound_duration_arr[5]='<?php echo $speaking5['introsound_duration'] ?>';

            introsound_arr[6]='<?php echo $speaking6['introsound'] ?>';
            introsound_duration_arr[6]='<?php echo $speaking6['introsound_duration'] ?>';

            var number_question=48;
            var current_question=parseInt($('#current_question').val());

            current_question+=1;
            $('#current_question').val(current_question);

            $('.step').hide();
            $('.step'+current_question).show();

            switch(current_question){
                case 2:
                    $('.record').hide(); $('.play').hide(); $('.stop').hide();
                    var lsound='<?php echo base_url(); ?>admin/data/sound/system/speaking_direction_2.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    break;

                case 3:
                    $('.next').hide();
                    $('#current_position').show();
                    $('#current_position').html('1 of 6');
                    var lsound='<?php echo base_url(); ?>img/sound/sp1.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");

                    run_timer(4);
                    break;

                case 4:
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/speaking/'+ssound_arr[1];
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(<?php echo $speaking1['ssound_duration'] ?>);
                    break;

                case 5:
                    var lsound='<?php echo base_url(); ?>img/sound/prepare_response.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    prepare_recorder(1);
                    run_timer(3);
                    break;

                case 6:
                    run_timer(16);
                    break;

                case 7:
                    var lsound='<?php echo base_url(); ?>img/sound/sp_afterbeep.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(5);
                    break;

                case 8:
                    sendToFlash('recorder01').startRecording();
                    run_timer(46);
                    break;

                case 9: //stop sound 1
                    sendToFlash('recorder01').stopSound();
                    run_timer(5);
                    break;

                case 10: //save sound 1
                    sendToFlash('recorder01').saveRecordedWAV();
                    run_timer(20);
                    break;



                case 11:
                    var lsound='<?php echo base_url(); ?>img/sound/sp2.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    $('#current_position').html('2 of 6');
                    run_timer(4);

                    break;

                case 12:
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/speaking/'+ssound_arr[2];
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(<?php echo $speaking2['ssound_duration'] ?>);
                    break;

                case 13:
                    var lsound='<?php echo base_url(); ?>img/sound/prepare_response.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    prepare_recorder(2);
                    run_timer(3);
                    break;

                case 14:
                    run_timer(16);
                    break;

                case 15:
                    var lsound='<?php echo base_url(); ?>img/sound/sp_afterbeep.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(5);
                    break;

                case 16:
                    sendToFlash('recorder02').startRecording();
                    run_timer(46);
                    break;

                case 17: //stop sound 2
                    sendToFlash('recorder02').stopSound();
                    run_timer(5);
                    break;

                case 18: //save sound 2
                    sendToFlash('recorder02').saveRecordedWAV();
                    run_timer(20);
                    break;




                case 19:
                    var lsound='<?php echo base_url(); ?>img/sound/sp3.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    $('#current_position').html('3 of 6');
                    run_timer(2);
                    break;


                case 20:
                    var lsound='<?php echo base_url(); ?>img/sound/speaking_direction_reading.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(4);
                    break;

                case 21:
                    run_timer(46);
                    break;

                case 22:
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/speaking/'+lsound_arr[3];
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(<?php echo $speaking3['lsound_duration'] ?>);
                    break;

                case 23:
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/speaking/'+ssound_arr[3];
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(<?php echo $speaking3['ssound_duration'] ?>);
                    break;

                case 24:
                    var lsound='<?php echo base_url(); ?>img/sound/prepare_response.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    prepare_recorder(4);
                    run_timer(3);
                    break;

                case 25:
                    run_timer(31);
                    break;

                case 26:
                    var lsound='<?php echo base_url(); ?>img/sound/sp_afterbeep.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(5);
                    break;

                case 27:
                    sendToFlash('recorder04').startRecording();
                    run_timer(61);
                    break;

                case 28: //stop sound 3
                    sendToFlash('recorder04').stopSound();
                    run_timer(5);
                    break;

                case 29: //save sound 3
                    sendToFlash('recorder04').saveRecordedWAV();
                    run_timer(20);
                    break;



                case 30:
                    var lsound='<?php echo base_url(); ?>img/sound/sp4.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    $('#current_position').html('4 of 6');
                    run_timer(2);
                    break;


                case 31:
                    var lsound='<?php echo base_url(); ?>img/sound/speaking_direction_reading.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(4);
                    break;

                case 32:
                    run_timer(46);
                    break;

                case 33:
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/speaking/'+lsound_arr[4];
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(<?php echo $speaking4['lsound_duration'] ?>);
                    break;

                case 34:
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/speaking/'+ssound_arr[4];
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(<?php echo $speaking4['ssound_duration'] ?>);
                    break;

                case 35:
                    var lsound='<?php echo base_url(); ?>img/sound/prepare_response.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    prepare_recorder(5);
                    run_timer(3);
                    break;

                case 36:
                    run_timer(31);
                    break;

                case 37:
                    var lsound='<?php echo base_url(); ?>img/sound/sp_afterbeep.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(5);
                    break;

                case 38:
                    sendToFlash('recorder05').startRecording();
                    run_timer(61);
                    break;

                case 39: //stop sound 4
                    sendToFlash('recorder05').stopSound();
                    run_timer(5);
                    break;

                case 40: //save sound 4
                    sendToFlash('recorder05').saveRecordedWAV();
                    run_timer(20);
                    break;



                case 41:
                    var lsound='<?php echo base_url(); ?>img/sound/sp5.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    $('#current_position').html('5 of 6');
                    run_timer(5);
                    break;

                case 42:
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/speaking/'+lsound_arr[5];
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(<?php echo $speaking5['lsound_duration'] ?>);
                    break;

                case 43:
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/speaking/'+ssound_arr[5];
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(<?php echo $speaking5['ssound_duration'] ?>);
                    break;

                case 44:
                    var lsound='<?php echo base_url(); ?>img/sound/prepare_response.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    prepare_recorder(7);
                    run_timer(3);
                    break;

                case 45:
                    run_timer(31);
                    break;

                case 46:
                    var lsound='<?php echo base_url(); ?>img/sound/sp_afterbeep.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(5);
                    break;

                case 47:
                    sendToFlash('recorder07').startRecording();
                    run_timer(61);
                    break;

                case 48: //stop sound 5
                    sendToFlash('recorder07').stopSound();
                    run_timer(5);
                    break;

                case 49: //save sound 5
                    sendToFlash('recorder07').saveRecordedWAV();
                    run_timer(20);
                    break;




                case 50:
                    var lsound='<?php echo base_url(); ?>img/sound/sp6.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    $('#current_position').html('6 of 6');
                    run_timer(4);
                    break;

                case 51:
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/speaking/'+lsound_arr[6];
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(<?php echo $speaking6['lsound_duration'] ?>);
                    break;

                case 52:
                    var lsound='<?php echo HelperURL::upload_url(); ?>audio/toefl/speaking/'+ssound_arr[6];
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(<?php echo $speaking6['ssound_duration'] ?>);
                    break;

                case 53:
                    var lsound='<?php echo base_url(); ?>img/sound/prepare_response.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    prepare_recorder(8);
                    run_timer(3);
                    break;

                case 54:
                    run_timer(31);
                    break;

                case 55:
                    var lsound='<?php echo base_url(); ?>img/sound/sp_afterbeep.mp3';
                    //$('.sound').html('<embed type="application/x-shockwave-flash" flashvars="'+lsound+'&autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="0" quality="best"></embed>');
                    var player_url='<?php echo base_url(); ?>js/player.swf';
                    $('.sound').html("<div id='lsound'>Loading the player ...</div><script type='text/javascript'>jwplayer('lsound').setup({ flashplayer: '"+player_url+"', file: '"+lsound+"',height: 0,width: 400, autostart: true});<\/script>");
                    run_timer(5);
                    break;

                case 56:
                    sendToFlash('recorder08').startRecording();
                    run_timer(61);
                    break;

                case 57: //stop sound 6
                    sendToFlash('recorder08').stopSound();
                    run_timer(5);
                    break;

                case 58: //save sound 6
                    sendToFlash('recorder08').saveRecordedWAV();
                    run_timer(20);
                    break;

                case 59:
                    $('.next').show();
                    $('#current_position').hide();
                    break;

                case 60:
                    break;

                case 61:
                     window.location = "<?php echo base_url(); ?>../front/toefl/";;
                    break;
                default:
                }
            });


            function sendToFlash(movieName) {
                if (navigator.appName.indexOf("Microsoft") != -1) {
                    return window[movieName] || document[movieName];
                } else {
                    return document[movieName] || window[movieName];
                }
            }

            function getWAV() {
                var wav = sendToFlash('recorder01').getRecordedWAV();
                alert('Voice Recorder component returned Base64 encoded WAV file of size  ' + wav.length + ' bytes');
            }

            function isNewRecord() {
                var isnr = sendToFlash('recorder01').isNewRecord();
                if (isnr) {
                    alert('There is WAV information to save.');
                } else {
                    alert('There is no WAV information to save.');
                }
            }
        });
</script>
