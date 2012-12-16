<?php

class DataController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $SectionModel;
    private $SubjectModel;
    private $TestNTModel;
    private $OrganizationModel;
    private $Dom;
    private $SpeakingModel;
    private $ListeningModel;
    private $Listening_cqModel;
    private $Listening_mcqModel;
    private $Listening_oqModel;
    private $Listening_scqModel;
    private $Listening_videoModel;
    private $WritingModel;

    public function init() {
        /* @var $this DataController */
        $this->validator = new FormValidator();
        /* @var $this DataController */
        $this->SectionModel = new SectionModel();
        /* @var $this DataController */
        $this->SubjectModel = new SubjectModel();
        /* @var $this DataController */
        $this->TestNTModel = new TestNTModel();
        /* @var $this DataController */
        $this->OrganizationModel = new OrganizationModel();

        $this->Dom = new simple_html_dom();

        /* @var $SpeakingModel SpeakingModel */
        $this->SpeakingModel = new SpeakingModel();
        /* @var $ListeningModel ListeningModel */
        $this->ListeningModel = new ListeningModel();
        /* @var $Listening_cqModel Listening_cqModel */
        $this->Listening_cqModel = new Listening_cqModel();
        /* @var $Listening_mcqModel ListeningMCQModel */
        $this->Listening_mcqModel = new ListeningMCQModel();
        /* @var $Listening_oqModel Listening_oqModel */
        $this->Listening_oqModel = new Listening_oqModel();
        /* @var $Listening_scqModel Listening_scqModel */
        $this->Listening_scqModel = new ListeningSCQModel();
        /* @var Listening_videoModel Listening_videoModel */
        $this->Listening_videoModel = new Listening_videoModel();
        /* @var $WritingModel WritingModel */
        $this->WritingModel = new WritingModel();
    }

    public function actionArrange_test_image() {
        $dir = Yii::app()->params['upload_dir'];
        if (!is_dir($dir))
            return array();

        $folders = scandir($dir);

        foreach ($folders as $k => $v) {
            if ($v != '.' && $v != '..' && $v != '.DS_Store') {
                /* $dirf1 = Yii::app()->params['upload_dir'] . $v . '/1/';
                  rmdir($dirf1);
                  $dirf2 = Yii::app()->params['upload_dir'] . $v . '/2/';
                  rmdir($dirf2);
                  continue; */

                // xu ly trang le
                $dirf = Yii::app()->params['upload_dir'] . $v . '/1/';
                if (!is_dir($dirf))
                    continue;

                $files = scandir($dirf);
                if ($ofiles)
                    unset($ofiles);

                foreach ($files as $fk => $fv) {
                    if ($fv == '.' || $fv == '..' || $fv == '.DS_Store')
                        continue;

                    $ofiles[] = str_replace('.JPG', '', $fv);
                }

                if ($ofiles) {
                    sort($ofiles, SORT_NUMERIC);

                    $i = -1;
                    foreach ($ofiles as $fv) {

                        $i+=2;
                        $farr1[$dirf . $fv . '.JPG'] = $dirf . str_pad($i, 5, "0", STR_PAD_LEFT) . '.JPG';
                    }
                }

                // xu ly trang chan
                $dirf = Yii::app()->params['upload_dir'] . $v . '/2/';
                if (!is_dir($dirf))
                    continue;

                $files = scandir($dirf);
                if ($ofiles)
                    unset($ofiles);

                foreach ($files as $fk => $fv) {
                    if ($fv == '.' || $fv == '..' || $fv == '.DS_Store')
                        continue;

                    $ofiles[] = str_replace('.JPG', '', $fv);
                }

                if ($ofiles) {
                    sort($ofiles, SORT_NUMERIC);
                    $ofiles = array_reverse($ofiles);

                    $i = 0;
                    foreach ($ofiles as $fv) {

                        $i+=2;
                        $farr2[$dirf . $fv . '.JPG'] = $dirf . str_pad($i, 5, "0", STR_PAD_LEFT) . '.JPG';
                    }
                }
            }
        }

        foreach ($farr1 as $k => $v) {
            rename($k, $v);
            $new_v = str_replace('/1/', '/', $v);
            $new_v = str_replace('/2/', '/', $new_v);
            copy($v, $new_v);
        }
        foreach ($farr2 as $k => $v) {
            rename($k, $v);
            $new_v = str_replace('/1/', '/', $v);
            $new_v = str_replace('/2/', '/', $new_v);
            copy($v, $new_v);
        }
    }

    public function actionGenerate_normal_test() {

        $section = $this->SectionModel->gets();
        $subject = $this->SubjectModel->get_all();
        foreach ($subject as $subj) {
            for ($i = 2000; $i <= 2015; $i++) {
                foreach ($section as $s) {
                    $title = $s['title'] . ' - ' . $i;
                    $organization_id = 28;
                    $subject_id = $subj['id'];
                    $section_id = $s['id'];
                    $type_test = 1;
                    $price = 0;
                    $author_id = 1;
                    $description = 'Normal Test';

                    $org = $this->OrganizationModel->get(28);
                    $sub = $this->SubjectModel->get($subj['id']);
                    $slug = Helper::create_slug($title . '-' . $sub['title'] . '-' . $org['title']);
                    $this->TestNTModel->add($title, $slug, $description, $organization_id, $subject_id, $section_id, $type_test, $price, $author_id, time());
                }
            }
        }
    }

    public function actionMigrate_toefl_flie() {
        actionMigrate_speaking();
        actionMigrate_listening();
        actionMigrate_listening_cq();
        actionMigrate_listening_mcq();
        actionMigrate_listening_oq();
        actionMigrate_listening_scq();
        actionMigrate_listening_video();
        actionMigrate_writing();
    }

    public function actionMigrate_speaking() {
        $speaking = $this->SpeakingModel->get_all_speaking();
        foreach ($speaking as $s) {
            $path = "C:/xampp/htdocs/yima/data/sounds/speaking/";
            if (file_exists($path . $s['introsound']) && $s['introsound'] != "") {
                $file = HelperApp::copy_toefl_audio_speaking($s['introsound'], $path);
                $this->SpeakingModel->update(array('introsound' => $file, 'id' => $s['id']));
            } else {
                $this->SpeakingModel->update(array('introsound' => "", 'id' => $s['id']));
            }


            if (file_exists($path . $s['ssound']) && $s['ssound'] != "") {
                $file = HelperApp::copy_toefl_audio_speaking($s['ssound'], $path);
                $this->SpeakingModel->update(array('ssound' => $file, 'id' => $s['id']));
            } else {
                $this->SpeakingModel->update(array('ssound' => "", 'id' => $s['id']));
            }

            if (file_exists($path . $s['lsound']) && $s['lsound'] != "") {
                $file = HelperApp::copy_toefl_audio_speaking($s['lsound'], $path);
                $this->SpeakingModel->update(array('lsound' => $file, 'id' => $s['id']));
            } else {
                $this->SpeakingModel->update(array('lsound' => "", 'id' => $s['id']));
            }

            $path_img = "C:/xampp/htdocs/yima/data/images/speaking/";
            $image = $path_img . $s['limg'];
            if (file_exists($image) && $s['limg'] != "") {
                $type = 'speaking';
                $resize = HelperApp::resize_images_toefl_copy($image, HelperApp::get_toefl_sizes(), $type);
                $img = $resize['img'];
                $thumbnail = $resize['thumbnail'];
                $this->SpeakingModel->update(array('limg' => $img, 'thumbnail' => $thumbnail, 'id' => $s['id']));
            } else {
                $img = "";
                $thumbnail = "";
                $this->SpeakingModel->update(array('limg' => $img, 'thumbnail' => $thumbnail, 'id' => $s['id']));
            }
        }
    }

    public function actionMigrate_listening() {
        $listening = $this->ListeningModel->get_all_listening();
        foreach ($listening as $l) {
            $path = "C:/xampp/htdocs/yima/data/sounds/listening/listening_page/";
            $filepath = $path . $l['lsound'];
            // print_r($filepath = $path . $l['lsound']);die;
            $type = "listening/listening_page";
            if (file_exists($filepath) && $l['lsound'] != "") {

                $file = HelperApp::copy_toefl_audio($l['lsound'], $path, $type);
                $this->ListeningModel->update(array('lsound' => $file, 'id' => $l['id']));
            } else {

                $this->ListeningModel->update(array('lsound' => "", 'id' => $l['id']));
            }
        }
    }

    public function actionMigrate_listening_cq() {
        $listening_cq = $this->Listening_cqModel->get_all_listening_cq();
        foreach ($listening_cq as $l) {
            $path = "C:/xampp/htdocs/yima/data/sounds/listening/cq/";
            $filepath = $path . $l['lsound'];

            $type = "listening/cq";
            if (file_exists($filepath) && $l['lsound'] != "") {

                $file = HelperApp::copy_toefl_audio($l['lsound'], $path, $type);
                $this->Listening_cqModel->update(array('lsound' => $file, 'id' => $l['id']));
            } else {

                $this->Listening_cqModel->update(array('lsound' => "", 'id' => $l['id']));
            }
        }
    }

    public function actionMigrate_listening_mcq() {
        $listening_mcq = $this->Listening_mcqModel->get_all_listening_mcq();
        foreach ($listening_mcq as $l) {

            $path = "C:/xampp/htdocs/yima/data/sounds/listening/mcq/";
            $filepath = $path . $l['lsound'];
            $type = "listening/mcq";
            if (file_exists($filepath) && $l['lsound'] != "") {

                $file = HelperApp::copy_toefl_audio($l['lsound'], $path, $type);
                $this->Listening_mcqModel->update(array('lsound' => $file, 'id' => $l['id']));
            } else {

                $this->Listening_mcqModel->update(array('lsound' => "", 'id' => $l['id']));
            }

            $path = "C:/xampp/htdocs/yima/data/sounds/listening/sentence_sound/mcq/";
            $filepath = $path . $l['sentence_sound'];

            $type = "listening/sentence_sound/mcq";
            if (file_exists($filepath) && $l['sentence_sound'] != "") {

                $file = HelperApp::copy_toefl_audio($l['sentence_sound'], $path, $type);
                $this->Listening_mcqModel->update(array('sentence_sound' => $file, 'id' => $l['id']));
            } else {

                $this->Listening_mcqModel->update(array('sentence_sound' => "", 'id' => $l['id']));
            }

            $path = "C:/xampp/htdocs/yima/data/sounds/listening/replay_sound/mcq/";
            $filepath = $path . $l['replay_sound'];
            $type = "listening/replay_sound/mcq";
            if (file_exists($filepath) && $l['replay_sound'] != "") {

                $file = HelperApp::copy_toefl_audio($l['replay_sound'], $path, $type);
                $this->Listening_mcqModel->update(array('replay_sound' => $file, 'id' => $l['id']));
            } else {

                $this->Listening_mcqModel->update(array('replay_sound' => "", 'id' => $l['id']));
            }
        }
    }

    public function actionMigrate_listening_oq() {
        $listening_oq = $this->Listening_oqModel->get_all_listening_oq();
        foreach ($listening_oq as $l) {
            $path = "C:/xampp/htdocs/yima/data/sounds/listening/oq/";
            $filepath = $path . $l['lsound'];

            $type = "listening/oq";
            if (file_exists($filepath) && $l['lsound'] != "") {

                $file = HelperApp::copy_toefl_audio($l['lsound'], $path, $type);
                $this->Listening_oqModel->update(array('lsound' => $file, 'id' => $l['id']));
            } else {

                $this->Listening_oqModel->update(array('lsound' => "", 'id' => $l['id']));
            }
        }
    }

    public function actionMigrate_listening_scq() {
        $listening_scq = $this->Listening_scqModel->get_all_listening_scq();
        foreach ($listening_scq as $l) {

            $path = "C:/xampp/htdocs/yima/data/sounds/listening/scq/";
            $filepath = $path . $l['lsound'];
            $type = "listening/scq";
            if (file_exists($filepath) && $l['lsound'] != "") {

                $file = HelperApp::copy_toefl_audio($l['lsound'], $path, $type);
                $this->Listening_scqModel->update(array('lsound' => $file, 'id' => $l['id']));
            } else {

                $this->Listening_scqModel->update(array('lsound' => "", 'id' => $l['id']));
            }

            $path = "C:/xampp/htdocs/yima/data/sounds/listening/sentence_sound/scq/";
            $filepath = $path . $l['sentence_sound'];

            $type = "listening/sentence_sound/scq";
            if (file_exists($filepath) && $l['sentence_sound'] != "") {

                $file = HelperApp::copy_toefl_audio($l['sentence_sound'], $path, $type);
                $this->Listening_scqModel->update(array('sentence_sound' => $file, 'id' => $l['id']));
            } else {

                $this->Listening_scqModel->update(array('sentence_sound' => "", 'id' => $l['id']));
            }

            $path = "C:/xampp/htdocs/yima/data/sounds/listening/replay_sound/scq/";
            $filepath = $path . $l['replay_sound'];
            $type = "listening/replay_sound/scq";
            if (file_exists($filepath) && $l['replay_sound'] != "") {

                $file = HelperApp::copy_toefl_audio($l['replay_sound'], $path, $type);
                $this->Listening_scqModel->update(array('replay_sound' => $file, 'id' => $l['id']));
            } else {

                $this->Listening_scqModel->update(array('replay_sound' => "", 'id' => $l['id']));
            }
        }
    }

    public function actionMigrate_listening_video() {
        $listening_video = $this->Listening_videoModel->get_all_listening_video();
        foreach ($listening_video as $l) {
            $path_img = "C:/xampp/htdocs/yima/data/images/listening/";
            $image = $path_img . $l['limg'];
            if (file_exists($image) && $l['limg'] != "") {
                $type = 'listening';
                $resize = HelperApp::resize_images_toefl_copy($image, HelperApp::get_toefl_sizes(), $type);
                $img = $resize['img'];
                $thumbnail = $resize['thumbnail'];
                $this->Listening_videoModel->update(array('limg' => $img, 'thumbnail' => $thumbnail, 'id' => $l['id']));
            } else {
                $img = "";
                $thumbnail = "";
                $this->Listening_videoModel->update(array('limg' => $img, 'thumbnail' => $thumbnail, 'id' => $l['id']));
            }
        }
    }

    public function actionMigrate_writing() {
        $writing = $this->WritingModel->get_all_writing();
        foreach ($writing as $w) {

            $path = "C:/xampp/htdocs/yima/data/sounds/writing/";
            $filepath = $path . $w['lsound'];

            $type = "writing";
            if (file_exists($filepath) && $w['lsound'] != "") {

                $file = HelperApp::copy_toefl_audio($w['lsound'], $path, $type);
                $this->WritingModel->update(array('lsound' => $file, 'id' => $w['id']));
            } else {

                //$this->WritingModel->update(array('lsound' => "", 'id' => $w['id']));
            }


            $filepath = $path . $w['ssound'];

            if (file_exists($filepath) && $w['ssound'] != "") {

                $file = HelperApp::copy_toefl_audio($w['ssound'], $path, $type);
                $this->WritingModel->update(array('ssound' => $file, 'id' => $w['id']));
            } else {

                $this->WritingModel->update(array('ssound' => "", 'id' => $w['id']));
            }

            $path_img = "C:/xampp/htdocs/yima/data/images/writing/";
            $image = $path_img . $w['limg'];

            if (file_exists($image) && $w['limg'] != "") {
                $type = 'writing';
                $resize = HelperApp::resize_images_toefl_copy($image, HelperApp::get_toefl_sizes(), $type);
                $img = $resize['img'];
                $thumbnail = $resize['thumbnail'];
                $this->WritingModel->update(array('limg' => $img, 'thumbnail' => $thumbnail, 'id' => $w['id']));
            } else {
                $img = "";
                $thumbnail = "";
                $this->WritingModel->update(array('limg' => $img, 'thumbnail' => $thumbnail, 'id' => $w['id']));
            }
        }
    }

    public function actionGenerate_subject_from_backkhoa_student_score() {
        $khoa_id = array(
            '2' => 4, '3' => 5, '4' => 6, '5' => 7,
            '6' => 8, '7' => 14, '8' => 13, '9' => 10,
            'K' => 9, 'G' => 11, 'V' => 12
        );
        $sql = "TRUNCATE TABLE yima_sys_subject";
        $command = Yii::app()->db->createCommand($sql);
        $command->execute();
        $sql1 = "TRUNCATE TABLE yima_organization_faculty_subject";
        $command1 = Yii::app()->db->createCommand($sql1);
        $command1->execute();

        $sql_subject = "select ten_monhoc, ma_monhoc from yima_data_bachkhoa_student_scores group by ma_monhoc having ten_monhoc<>''";
        $command_subject = Yii::app()->db->createCommand($sql_subject);
        $subjects = $command_subject->queryAll();

        $sql_insert = "INSERT INTO yima_sys_subject(title, slug, ma_mon_hoc, date_added, last_modified) 
            VALUES(:title, :slug, :ma_mon_hoc, :date_added, :last_modified)";
        $cmd_insert = Yii::app()->db->createCommand($sql_insert);

        $sql_ofs = "INSERT INTO yima_organization_faculty_subject(organization_id, faculty_id, subject_id, sub_number) 
            VALUES(:organization_id, :faculty_id, :subject_id, :sub_number)";
        $cmd_ofs = Yii::app()->db->createCommand($sql_ofs);

        foreach ($subjects as $sub) {
            $title = trim($sub['ten_monhoc']);
            $slug = Helper::create_slug($title);
            $ma_monhoc = $sub['ma_monhoc'];
            $date_added = $last_modified = time();

            $cmd_insert->bindParam(":title", $title, PDO::PARAM_STR);
            $cmd_insert->bindParam(":slug", $slug, PDO::PARAM_STR);
            $cmd_insert->bindParam(":ma_mon_hoc", $ma_monhoc, PDO::PARAM_STR);
            $cmd_insert->bindParam(":date_added", $date_added, PDO::PARAM_INT);
            $cmd_insert->bindParam(":last_modified", $last_modified, PDO::PARAM_INT);
            $cmd_insert->execute();

            $organization_id = 28;

            $fid = substr($ma_monhoc, 0, 1);
            if ($fid == '0' || $fid == 'P' || $fid == 'C' || $fid == 'M') {
                $faculty_id = 0;
            } else {
                $faculty_id = $khoa_id[$fid];
            }
            //echo $fid . '-' . $faculty_id . '<br/>';

            $subject_id = Yii::app()->db->lastInsertID;

            $cmd_ofs->bindParam(":organization_id", $organization_id, PDO::PARAM_INT);
            $cmd_ofs->bindParam(":faculty_id", $faculty_id, PDO::PARAM_INT);
            $cmd_ofs->bindParam(":subject_id", $subject_id, PDO::PARAM_INT);
            $cmd_ofs->bindParam(":sub_number", $ma_monhoc, PDO::PARAM_STR);
            $cmd_ofs->execute();
        }
    }

    public function actionCheck_yima_data_bachkhoa() {

        $khoa = array('2', '3', '4', '5', '6', '7', '8', '9', 'K', 'V', 'G');
        $nienkhoa = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11');

        //$khoa = array('3');
        //$nienkhoa = array('06');

        $sql = "SELECT count(*) as total
                FROM yima_data_bachkhoa_students
                WHERE mssv like  :knk";

        $sql_max = "SELECT mssv
                FROM yima_data_bachkhoa_students
                WHERE mssv like  :knk
                ORDER BY mssv DESC";

        $command = Yii::app()->db->createCommand($sql);

        $command_max = Yii::app()->db->createCommand($sql_max);

        foreach ($khoa as $k) {
            echo '<ul style="margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">';
            foreach ($nienkhoa as $nk) {
                $knk = $k . $nk . '%';

                $command->bindParam(":knk", $knk, PDO::PARAM_STR);
                $command_max->bindParam(":knk", $knk, PDO::PARAM_STR);

                $count = $command->queryRow();
                $max = $command_max->queryRow();
                $display_count = intval($count['total']);
                if ($display_count <= 100) {
                    $display_count = '<span style="color: #f00;">' . $display_count . '</span>';
                }

                echo '<li style="width: 200px; margin: 10px 20px; float: left;"><strong>' . $k . $nk . '</strong> - ' . $display_count . ' - ' . $max['mssv'] . '<br/>';
                if ($max['mssv'] == '') {
                    $start = 0;
                } else {
                    $start = intval(substr($max['mssv'], -4)) + 1;
                }
                $end = $start + 1000;
                echo '<a href="http://localhost/yima/back/data/generate_bachkhoa_mssv/khoa/' . $k . '/nienkhoa/' . $nk . '/start/' . $start . '/end/' . $end . '" alt="">Crawl more</a></li>';
            }
            echo '<div style="clear: both;"></div></ul>';
        }
    }

    public function actionGenerate_bachkhoa_mssv($khoa = '', $nienkhoa = '', $start = 0, $end = 99999) {
        //$khoa = array('2', '3', '4', '5', '6', '7', '8', '9', 'K', 'V', 'G');
        //$nienkhoa = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');

        $sql = "INSERT INTO yima_data_bachkhoa_students(id, mssv, student_name, content) 
            VALUES(:mssv, :mssv, :student_name, :content)";
        $command = Yii::app()->db->createCommand($sql);

        $sql_scores = "INSERT INTO yima_data_bachkhoa_student_scores(student_id, mssv, hocky, updated_date, ma_monhoc, ten_monhoc, nhom_to, so_tc, diem_kiem_tra, diem_thi, diem_tk) 
            VALUES(:student_id, :mssv, :hocky, :updated_date, :ma_monhoc, :ten_monhoc, :nhom_to, :so_tc, :diem_kiem_tra, :diem_thi, :diem_tk)";
        $cmd_scores = Yii::app()->db->createCommand($sql_scores);

        for ($i = $start; $i <= $end; $i++) {
            $mssv = $khoa . $nienkhoa . str_pad($i, 5, '0', STR_PAD_LEFT);

            //find mssv
            $result = $this->scan_bachkhoa_mssv($mssv);
            if ($result['found']) {
                $command->bindParam(":mssv", $mssv, PDO::PARAM_STR);
                $command->bindParam(":student_name", $result['student_name'], PDO::PARAM_STR);
                $command->bindParam(":content", $result['scores']->innertext, PDO::PARAM_LOB);
                $command->execute();
                $student_id = $mssv;

                $score_details = $result['score_details'];
                //print_r($score_details);
                //exit();

                foreach ($score_details as $sd) {
                    $lbl_year = $sd['lbl_year'];
                    $lbl_updated_date = $sd['lbl_updated_date'];
                    $score = $sd['score'];

                    if ($score)
                        foreach ($score as $s) {
                            if (trim($s['ma_monhoc']) != '') {
                                $cmd_scores->bindParam(":student_id", $student_id, PDO::PARAM_STR);
                                $cmd_scores->bindParam(":mssv", $mssv, PDO::PARAM_STR);
                                $cmd_scores->bindParam(":hocky", $lbl_year, PDO::PARAM_STR);
                                $cmd_scores->bindParam(":updated_date", $lbl_updated_date, PDO::PARAM_STR);
                                $cmd_scores->bindParam(":ma_monhoc", $s['ma_monhoc'], PDO::PARAM_STR);
                                $cmd_scores->bindParam(":ten_monhoc", $s['ten_monhoc'], PDO::PARAM_STR);
                                $cmd_scores->bindParam(":nhom_to", $s['nhom_to'], PDO::PARAM_STR);
                                $cmd_scores->bindParam(":so_tc", $s['so_tc'], PDO::PARAM_STR);
                                $cmd_scores->bindParam(":diem_kiem_tra", $s['diem_kiem_tra'], PDO::PARAM_STR);
                                $cmd_scores->bindParam(":diem_thi", $s['diem_thi'], PDO::PARAM_STR);
                                $cmd_scores->bindParam(":diem_tk", $s['diem_tk'], PDO::PARAM_STR);
                                $cmd_scores->execute();
                            }
                        }
                }
            }
        }
    }

    private function scan_bachkhoa_mssv($mssv) {
        $request = array(
            'http' => array(
                'method' => 'POST',
                'content' => http_build_query(array(
                    'HOC_KY' => 'd.hk_nh is not NULL',
                    'image' => 'Xem-->',
                    'mssv' => $mssv
                )),
            )
        );
        $context = stream_context_create($request);
        $html = file_get_html('http://www.aao.hcmut.edu.vn/php/aao_bd.php?goto=', false, $context);
// Find all links 
        $wrap = $html->find('div', 1);
        $not_found_text = $wrap->find('.BigTitle', 0)->innertext;
        $pos = strpos($not_found_text, 'Không tìm thấy');
        $found = ($pos === false) ? 1 : 0;
        if ($found) {
            $result['found'] = 1;

            $student = $wrap->find('div', 0)->innertext;
            $arr = explode('-', $student);
            $result['student_name'] = $arr[0];

            $result['scores'] = $wrap->find('table', 0);

            $scores = $wrap->find('table', 0);
            $count = -1;
            $index = -1;
            foreach ($scores->find('table') as $element) {
                $index++;
                if ($index % 3 == 0) {
                    $count++;
                    $result['score_details'][$count]['lbl_year'] = $element->find('div', 0)->innertext;
                    $result['score_details'][$count]['lbl_updated_date'] = $element->find('font', 1)->innertext;
                    $row_count = -1;
                    $row_index = -1;
                    foreach ($element->find('tr') as $row) {
                        $row_count++;
                        if ($row_count >= 4) {
                            if (count($row->find('td[colspan]', 0)) == 0) {
                                $row_index++;
                                $result['score_details'][$count]['score'][$row_index]['ma_monhoc'] = $row->find('font', 0)->innertext;
                                $result['score_details'][$count]['score'][$row_index]['ten_monhoc'] = $row->find('font', 1)->innertext;
                                $result['score_details'][$count]['score'][$row_index]['nhom_to'] = $row->find('font', 2)->innertext;
                                $result['score_details'][$count]['score'][$row_index]['so_tc'] = $row->find('font', 3)->innertext;
                                $result['score_details'][$count]['score'][$row_index]['diem_kiem_tra'] = $row->find('font', 4)->innertext;
                                $result['score_details'][$count]['score'][$row_index]['diem_thi'] = $row->find('font', 5)->innertext;
                                $result['score_details'][$count]['score'][$row_index]['diem_tk'] = $row->find('font', 6)->innertext;
                            }
                        }
                    }
                }
            }
        } else {
            $result['found'] = 0;
        }
        return $result;
    }

}

?>
