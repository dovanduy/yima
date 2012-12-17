<div id="review_inner">
    <h2 style="background: #dedede; padding: 5px 10px;"><?php echo $firstname; ?> <?php echo $lastname; ?></h2>
    <h2>Listening 01</h2>
    <table>
        <tr>
            <th class="center" width="20">Number</th>
            <th class="center" width="30">Type</th>
            <th width="200">Question</th>
            <th width="200">Answer</th>
            <th width="200">Student's answer</th>
        </tr>
        <?php
        if (isset($listening1_scq)) {
            foreach ($listening1_scq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">SCQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening1_mcq)) {
            foreach ($listening1_mcq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">MCQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening1_cq)) {
            foreach ($listening1_cq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">CQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening1_oq)) {
            foreach ($listening1_oq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">OQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>




    <h2>Listening 02</h2>
    <table>
        <tr>
            <th class="center" width="20">Number</th>
            <th class="center" width="30">Type</th>
            <th width="200">Question</th>
            <th width="200">Answer</th>
            <th width="200">Student's answer</th>
        </tr>
        <?php
        if (isset($listening2_scq)) {
            foreach ($listening2_scq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">SCQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening2_mcq)) {
            foreach ($listening2_mcq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">MCQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening2_cq)) {
            foreach ($listening2_cq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">CQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening2_oq)) {
            foreach ($listening2_oq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">OQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>



    <h2>Listening 03</h2>
    <table>
        <tr>
            <th class="center" width="20">Number</th>
            <th class="center" width="30">Type</th>
            <th width="200">Question</th>
            <th width="200">Answer</th>
            <th width="200">Student's answer</th>
        </tr>
        <?php
        if (isset($listening3_scq)) {
            foreach ($listening3_scq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">SCQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening3_mcq)) {
            foreach ($listening3_mcq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">MCQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening3_cq)) {
            foreach ($listening3_cq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">CQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening3_oq)) {
            foreach ($listening3_oq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">OQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>


    <h2>Listening 04</h2>
    <table>
        <tr>
            <th class="center" width="20">Number</th>
            <th class="center" width="30">Type</th>
            <th width="200">Question</th>
            <th width="200">Answer</th>
            <th width="200">Student's answer</th>
        </tr>
        <?php
        if (isset($listening4_scq)) {
            foreach ($listening4_scq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">SCQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening4_mcq)) {
            foreach ($listening4_mcq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">MCQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening4_cq)) {
            foreach ($listening4_cq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">CQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening4_oq)) {
            foreach ($listening4_oq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">OQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>


    <h2>Listening 05</h2>
    <table>
        <tr>
            <th class="center" width="20">Number</th>
            <th class="center" width="30">Type</th>
            <th width="200">Question</th>
            <th width="200">Answer</th>
            <th width="200">Student's answer</th>
        </tr>
        <?php
        if (isset($listening5_scq)) {
            foreach ($listening5_scq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">SCQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening5_mcq)) {
            foreach ($listening5_mcq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">MCQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening5_cq)) {
            foreach ($listening5_cq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">CQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening5_oq)) {
            foreach ($listening5_oq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">OQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>



    <h2>Listening 06</h2>
    <table>
        <tr>
            <th class="center" width="20">Number</th>
            <th class="center" width="30">Type</th>
            <th width="200">Question</th>
            <th width="200">Answer</th>
            <th width="200">Student's answer</th>
        </tr>
        <?php
        if (isset($listening6_scq)) {
            foreach ($listening6_scq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">SCQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening6_mcq)) {
            foreach ($listening6_mcq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">MCQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening6_cq)) {
            foreach ($listening6_cq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">CQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        <?php
        if (isset($listening6_oq)) {
            foreach ($listening6_oq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">OQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>