<section role="main" class="test">

    <!-- Login box -->
    <article id="login-box">

        <div class="article-container">
            <header>
                <h2>SPEAKING</h2>
                <div id="user_box"><?php echo $student_firstname . ' ' . $student_lastname; ?></div>
                <div id="timer" style="display: none;">00:00</div>
                <a rel="tooltip" class="left switch_timer" href="#" title="Hide the timer" style="padding: 7px; display: none;">Hide time</a>
                <div id="current_position" style="display: none;">1 of 6</div>
                <button class="button right next">Continue</button>
                <button class="button blue right play disabled" disabled="true">Play</button>
                <button class="button blue right stop disabled" disabled="true">Stop</button>
                <button class="button blue right record">Record</button>
                <button class="button green right volume">Volume</button>
                <button class="button skip_button">Skip</button>
            </header>

            <section>