<section role="main" class="test">

    <!-- Login box -->
    <article id="login-box">

        <div class="article-container">
            <header>
                <h2>READING</h2>
                <div id="user_box"><?php echo $student_firstname . ' ' . $student_lastname; ?></div>
                <div id="timer" style="display: none;"><?php echo $reading['test_time_lbl']; ?></div>
                <a rel="tooltip" class="left switch_timer" href="#" title="Hide the timer" style="padding: 7px; display: none;">Hide time</a>
                <div id="current_position" style="display: none;">1 of <?php echo $number_question; ?></div>
                <a class="button blue right next" href="#" style="display: none;">Next</a>
                <a class="button blue right next_reading" href="#" style="display: none;">Next</a>
                <a class="button gray right back" href="#" style="display: none;">Back</a>
                <a class="button gray right help" href="#" style="display: none;">Help</a>
                <a class="button blue right return" href="#" style="display: none;">Return</a>
                <a class="button blue right return_from_review" href="#" style="display: none;">Return</a>
                <a class="button green right review" href="#" style="display: none;">Review</a>
                <a class="button blue right continue" href="#">Continue</a>
                <a class="button blue right end_section" href="#" style="display: none;">Continue</a>
                <a class="button gray right view_text" href="#" style="display: none;">View Text</a>
            </header>

            <section>