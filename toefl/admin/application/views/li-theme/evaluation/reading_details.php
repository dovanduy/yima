<div id="review_inner">
    <h2 style="background: #dedede; padding: 5px 10px;"><?php echo $firstname; ?> <?php echo $lastname; ?></h2>
    <h2>Reading 01</h2>
    <table>
        <tr>
            <th class="center" width="20">Number</th>
            <th class="center" width="30">Type</th>
            <th width="200">Question</th>
            <th width="200">Answer</th>
            <th width="200">Student's answer</th>
        </tr>
        <?php
        if (isset($reading1_scq)) {
            foreach ($reading1_scq as $row) {
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
        if (isset($reading1_mcq)) {
            foreach ($reading1_mcq as $row) {
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
        if (isset($reading1_iq)) {
            foreach ($reading1_iq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">IQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        if (isset($reading1_ddq)) {
            foreach ($reading1_ddq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">DDQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        if (isset($reading1_oq)) {
            foreach ($reading1_oq as $row) {
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




    <h2>Reading 02</h2>
    <table>
        <tr>
            <th class="center" width="20">Number</th>
            <th class="center" width="30">Type</th>
            <th width="200">Question</th>
            <th width="200">Answer</th>
            <th width="200">Student's answer</th>
        </tr>
        <?php
        if (isset($reading2_scq)) {
            foreach ($reading2_scq as $row) {
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
        if (isset($reading2_mcq)) {
            foreach ($reading2_mcq as $row) {
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
        if (isset($reading2_iq)) {
            foreach ($reading2_iq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">IQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        if (isset($reading2_ddq)) {
            foreach ($reading2_ddq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">DDQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>



    <h2>Reading 03</h2>
    <table>
        <tr>
            <th class="center" width="20">Number</th>
            <th class="center" width="30">Type</th>
            <th width="200">Question</th>
            <th width="200">Answer</th>
            <th width="200">Student's answer</th>
        </tr>
        <?php
        if (isset($reading3_scq)) {
            foreach ($reading3_scq as $row) {
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
        if (isset($reading3_mcq)) {
            foreach ($reading3_mcq as $row) {
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
        if (isset($reading3_iq)) {
            foreach ($reading3_iq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">IQ</td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        if (isset($reading3_ddq)) {
            foreach ($reading3_ddq as $row) {
                ?>
                <tr>
                    <td class="center"><?php echo $row['number_question']; ?></td>
                    <td class="center">DDQ</td>
                    <td><?php echo $row['content']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><?php echo $row['student_answer']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>