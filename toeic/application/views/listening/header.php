<section role="main" class="test listening">

    <!-- Login box -->
    <article id="login-box">

        <div class="article-container">
            <header>
                <h2>LISTENING</h2>
                <div id="user_box"><?php echo $student_firstname . ' ' . $student_lastname; ?></div>
                <div id="timer" style="display: none;"><?php echo $listening['test_time_lbl']; ?></div>
                <a rel="tooltip" class="left switch_timer" href="#" title="Hide the timer" style="padding: 7px; display: none;">Hide time</a>
                <div id="current_position" style="display: none;">1 of <?php echo $number_question; ?></div>
                <button class="button blue right center next">Continue</button>
                <button class="button blue right center end_section" style="display: none;">Continue</button>
                <button class="button right center ok" disabled="true" style="display: none;">OK</button>
                <button class="button green right volume" href="#" style="display: none;">Volume</button>
            </header>
            <div id="volume" style="display: none;">
                <input class="range" name="test" min="0" max="100" value="50" data-orig-type="range" type="text"/>
            </div>

            <section>