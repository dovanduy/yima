<section role="main" class="test">

    <!-- Login box -->
    <article id="login-box">

        <div class="article-container">
            <header>
                <h2>WRITING</h2>
                <div id="user_box"><?php echo $student_firstname . ' ' . $student_lastname; ?></div>
                <div id="timer" style="display: none;">00:00</div>
                <a rel="tooltip" class="left switch_timer" href="#" title="Hide the timer" style="padding: 7px; display: none;">Hide time</a>
                <div id="current_position" style="display: none;">1 of 11</div>
                <a class="button right return" href="#" style="display: none;">Return</a>
                <a class="button blue right next" href="#">Next</a>
                <a class="button green right volume" href="#">Volume</a>
            </header>

            <section>