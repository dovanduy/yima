<section role="main" class="test">

    <!-- Login box -->
    <article id="login-box">

        <div class="article-container">
            <header>
                <h2>THE END</h2>
                <div id="user_box"><?php echo $student_firstname . ' ' . $student_lastname; ?></div>
            </header>

            <section>
                <div class="end_writing">
                    <h3 class="center">Congratulation!</h3>
                    <h3 class="center">You have finished your test.</h3>
                </div>
            </section>
        </div>

    </article>
    <!-- /Login box -->

</section>
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
    });
</script>
