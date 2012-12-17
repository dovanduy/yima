<!-- Main Content -->
<section role="main">
    <!-- Breadcumbs -->
    <ul id="breadcrumbs">
        <li><a href="<?php echo $link_base; ?>" title="Back to Homepage">Back to Homepage</a></li>
        <li><a href="<?php echo $link_object; ?>">Session</a></li>
        <li>Mixed Test</li>
    </ul>
    <!-- /Breadcumbs -->

    <!-- Full Content Block -->
    <!-- Note that only 1st article need clearfix class for clearing -->
    <article class="full-block clearfix">

        <!-- Article Container for safe floating -->
        <div class="article-container">

            <!-- Article Header -->
            <header>
                <h2>Mixed Test</h2>

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
                <table>
                    <thead>
                        <tr>
                            <th width="20%">Mixed Test</th>
                            <th width="20%">Reading</th>
                            <th width="20%">Listening</th>
                            <th width="20%">Speaking</th>
                            <th width="20%">Writing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($mixed_tests)) {
                            foreach ($mixed_tests as $item) {
                                ?>
                                <tr id="item<?php echo $item['id']; ?>">
                                    <td class="bold"><?php echo $item['title']; ?></td>
                                    <td>
                                        <strong>R1:</strong> <?php echo $item['reading1']; ?><br/>
                                        <strong>R2:</strong> <?php echo $item['reading2']; ?><br/>
                                        <strong>R3:</strong> <?php echo $item['reading3']; ?><br/>
                                    </td>
                                    <td>
                                        <strong>L1:</strong> <?php echo $item['listening1']; ?><br/>
                                        <strong>L2:</strong> <?php echo $item['listening2']; ?><br/>
                                        <strong>L3:</strong> <?php echo $item['listening3']; ?><br/>
                                        <strong>L4:</strong> <?php echo $item['listening4']; ?><br/>
                                        <strong>L5:</strong> <?php echo $item['listening5']; ?><br/>
                                        <strong>L6:</strong> <?php echo $item['listening6']; ?>
                                    </td>
                                    <td>
                                        <strong>S1:</strong> <?php echo $item['speaking1']; ?><br/>
                                        <strong>S2:</strong> <?php echo $item['speaking2']; ?><br/>
                                        <strong>S3 (L+R):</strong> <?php echo $item['speaking3']; ?><br/>
                                        <strong>S4 (L+R):</strong> <?php echo $item['speaking4']; ?><br/>
                                        <strong>S5 (L):</strong> <?php echo $item['speaking5']; ?><br/>
                                        <strong>S6 (L):</strong> <?php echo $item['speaking6']; ?>
                                    </td>
                                    <td>
                                        <strong>W1 (Int):</strong> <?php echo $item['writing1']; ?><br/>
                                        <strong>W2 (Ind):</strong> <?php echo $item['writing2']; ?>
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