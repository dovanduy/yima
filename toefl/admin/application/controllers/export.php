<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Export extends CI_Controller {

    public function __construct() {
        parent::__construct();

        //--- check login and set user_info
        check_login('');

        $this->load->helper('file');

        $this->load->model('Source_test_model');
        $this->load->model('Reading_model');
        $this->load->model('Listening_model');
        $this->load->model('Speaking_model');
        $this->load->model('Writing_model');
    }

    public function index() {
        
    }

    private function export_source_test($id = 0) {
        $item = $this->Source_test_model->get_entry($id);
        if (isset($item[0])) {
            $source_test = $item[0];

            $filename = 'data/export/' . $id;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename .= '/' . $id . '.txt';
            if (file_exists($filename))
                unlink($filename);

            write_file($filename, serialize($source_test), 'a');

            chmod($filename, 0777);

            return $source_test;
        }
    }

    private function export_reading($id = 0, $rid = 0) {
        $item = $this->Reading_model->get_entry($rid);
        if (isset($item[0])) {
            $reading = $item[0];

            $filename = 'data/export/' . $id . '/reading';
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename .= '/' . $rid;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename_content = $filename . '/' . $rid . '-content.txt';
            if (file_exists($filename_content))
                unlink($filename_content);

            $filename .= '/' . $rid . '.txt';
            if (file_exists($filename))
                unlink($filename);

            write_file($filename, serialize($reading), 'a');

            $this->export_reading_scq($id, $rid);
            $this->export_reading_mcq($id, $rid);
            $this->export_reading_iq($id, $rid);
            $this->export_reading_ddq($id, $rid);
            $this->export_reading_oq($id, $rid);

            return $reading;
        }
    }

    private function export_listening($id = 0, $lid = 0) {
        $item = $this->Listening_model->get_entry($lid);
        if (isset($item[0])) {
            $listening = $item[0];

            $filename = 'data/export/' . $id . '/listening';
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename .= '/' . $lid;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }



            $filename .= '/' . $lid . '.txt';
            if (file_exists($filename))
                unlink($filename);

            write_file($filename, serialize($listening), 'a');

            copy('data/sounds/listening/listening_page/' . $listening->lsound, 'data/export/' . $id . '/listening/' . $lid . '/' . $listening->lsound);

            $this->export_listening_video($id, $lid);
            $this->export_listening_scq($id, $lid);
            $this->export_listening_mcq($id, $lid);
            $this->export_listening_cq($id, $lid);
            $this->export_listening_oq($id, $lid);

            return $listening;
        }
    }

    private function export_speaking($id = 0, $sid = 0) {
        $item = $this->Speaking_model->get_entry($sid);
        if (isset($item[0])) {
            $speaking = $item[0];

            $filename = 'data/export/' . $id . '/speaking';
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename .= '/' . $sid;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename_content = $filename . '/' . $sid . '-content.txt';
            if (file_exists($filename_content))
                unlink($filename_content);

            $filename .= '/' . $sid . '.txt';
            if (file_exists($filename))
                unlink($filename);

            write_file($filename, serialize($speaking), 'a');

            copy('data/images/speaking/' . $speaking->limg, 'data/export/' . $id . '/speaking/' . $sid . '/' . $speaking->limg);

            copy('data/sounds/speaking/' . $speaking->lsound, 'data/export/' . $id . '/speaking/' . $sid . '/' . $speaking->lsound);

            copy('data/sounds/speaking/' . $speaking->ssound, 'data/export/' . $id . '/speaking/' . $sid . '/' . $speaking->ssound);

            copy('data/sounds/speaking/' . $speaking->dsound, 'data/export/' . $id . '/speaking/' . $sid . '/' . $speaking->dsound);

            copy('data/sounds/speaking/' . $speaking->introsound, 'data/export/' . $id . '/speaking/' . $sid . '/' . $speaking->introsound);

            return $speaking;
        }
    }

    private function export_writing($id = 0, $wid = 0) {
        $item = $this->Writing_model->get_entry($wid);
        if (isset($item[0])) {
            $writing = $item[0];

            $filename = 'data/export/' . $id . '/writing';
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename .= '/' . $wid;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename_content = $filename . '/' . $wid . '-content.txt';
            if (file_exists($filename_content))
                unlink($filename_content);

            $filename .= '/' . $wid . '.txt';
            if (file_exists($filename))
                unlink($filename);

            write_file($filename, serialize($writing), 'a');

            copy('data/images/writing/' . $writing->limg, 'data/export/' . $id . '/writing/' . $wid . '/' . $writing->limg);

            copy('data/sounds/writing/' . $writing->lsound, 'data/export/' . $id . '/writing/' . $wid . '/' . $writing->lsound);

            copy('data/sounds/writing/' . $writing->ssound, 'data/export/' . $id . '/writing/' . $wid . '/' . $writing->ssound);

            copy('data/sounds/writing/' . $writing->dsound, 'data/export/' . $id . '/writing/' . $wid . '/' . $writing->dsound);

            return $writing;
        }
    }

    public function source_test($id = 0) {
        $source_test = $this->export_source_test($id);

        $this->export_reading($id, $source_test->reading1);
        $this->export_reading($id, $source_test->reading2);
        $this->export_reading($id, $source_test->reading3);

        $this->export_listening($id, $source_test->listening1);
        $this->export_listening($id, $source_test->listening2);
        $this->export_listening($id, $source_test->listening3);
        $this->export_listening($id, $source_test->listening4);
        $this->export_listening($id, $source_test->listening5);
        $this->export_listening($id, $source_test->listening6);

        $this->export_speaking($id, $source_test->speaking1);
        $this->export_speaking($id, $source_test->speaking2);
        $this->export_speaking($id, $source_test->speaking3);
        $this->export_speaking($id, $source_test->speaking4);
        $this->export_speaking($id, $source_test->speaking5);
        $this->export_speaking($id, $source_test->speaking6);

        $this->export_writing($id, $source_test->writing1);
        $this->export_writing($id, $source_test->writing2);

        $this->zip($id);
    }

    private function zip($id = 0) {
        //Get the directory to zip
        $filename_no_ext = 'data/export/' . $id;

        // we deliver a zip file
        header("Content-Type: archive/zip");

        // filename for the browser to save the zip file
        header("Content-Disposition: attachment; filename=$id" . ".zip");

        // get a tmp name for the .zip
        $tmp_zip = tempnam("tmp", "tempname") . ".zip";

        //change directory so the zip file doesnt have a tree structure in it.
        chdir('data/export/');

        // zip the stuff (dir and all in there) into the tmp_zip file
        exec('tar -zcvf ' . $tmp_zip . ' ' . $id);

        // calc the length of the zip. it is needed for the progress bar of the browser
        $filesize = filesize($tmp_zip);
        header("Content-Length: $filesize");

        // deliver the zip file
        $fp = fopen("$tmp_zip", "r");
        echo fpassthru($fp);

        // clean up the tmp zip file
        unlink($tmp_zip);
    }

    private function export_reading_scq($id = 0, $rid = 0) {
        $filename = 'data/export/' . $id . '/reading/' . $rid . '/scq';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('rid', $rid);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('reading_scq');
        $items = $query->result();
        foreach ($items as $item) {
            $filename = 'data/export/' . $id . '/reading/' . $rid . '/scq/' . $item->id;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename_content = $filename . '/' . $item->id . '-content.txt';
            if (file_exists($filename_content))
                unlink($filename_content);

            $filename .= '/' . $item->id . '.txt';
            if (file_exists($filename))
                unlink($filename);
            
            write_file($filename, serialize($item), 'a');

        }
    }

    private function export_reading_mcq($id = 0, $rid = 0) {
        $filename = 'data/export/' . $id . '/reading/' . $rid . '/mcq';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('rid', $rid);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('reading_mcq');
        $items = $query->result();
        foreach ($items as $item) {
            $filename = 'data/export/' . $id . '/reading/' . $rid . '/mcq/' . $item->id;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename_content = $filename . '/' . $item->id . '-content.txt';
            if (file_exists($filename_content))
                unlink($filename_content);

            $filename .= '/' . $item->id . '.txt';
            if (file_exists($filename))
                unlink($filename);
            
            write_file($filename, serialize($item), 'a');
           
        }
    }

    private function export_reading_iq($id = 0, $rid = 0) {
        $filename = 'data/export/' . $id . '/reading/' . $rid . '/iq';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('rid', $rid);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('reading_iq');
        $items = $query->result();
        foreach ($items as $item) {
            $filename = 'data/export/' . $id . '/reading/' . $rid . '/iq/' . $item->id;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename_content = $filename . '/' . $item->id . '-content.txt';
            if (file_exists($filename_content))
                unlink($filename_content);

            $filename .= '/' . $item->id . '.txt';
            if (file_exists($filename))
                unlink($filename);
            
            write_file($filename, serialize($item), 'a');
           
        }
    }

    private function export_reading_ddq($id = 0, $rid = 0) {
        $filename = 'data/export/' . $id . '/reading/' . $rid . '/ddq';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('rid', $rid);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('reading_ddq');
        $items = $query->result();
        foreach ($items as $item) {
            $filename = 'data/export/' . $id . '/reading/' . $rid . '/ddq/' . $item->id;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename_content = $filename . '/' . $item->id . '-content.txt';
            if (file_exists($filename_content))
                unlink($filename_content);

            $filename .= '/' . $item->id . '.txt';
            if (file_exists($filename))
                unlink($filename);
            
            write_file($filename, serialize($item), 'a');

            $this->export_reading_ddq_answer($id, $rid, $item->id);
            $this->export_reading_ddq_subjects($id, $rid, $item->id);
        }
    }

    private function export_reading_ddq_answer($id = 0, $rid = 0, $ddq_id = 0) {
        $filename = 'data/export/' . $id . '/reading/' . $rid . '/ddq/' . $ddq_id . '/answer';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('ddqid', $ddq_id);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('reading_ddq_answer');
        $items = $query->result();
        foreach ($items as $item) {
            $filename = 'data/export/' . $id . '/reading/' . $rid . '/ddq/' . $ddq_id . '/answer/' . $item->id . '.txt';
            if (file_exists($filename))
                unlink($filename);
            
            write_file($filename, serialize($item), 'a');

        }
    }

    private function export_reading_ddq_subjects($id = 0, $rid = 0, $ddq_id = 0) {
        $filename = 'data/export/' . $id . '/reading/' . $rid . '/ddq/' . $ddq_id . '/subjects';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('ddqid', $ddq_id);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('reading_ddq_subjects');
        $items = $query->result();
        foreach ($items as $item) {
            $filename = 'data/export/' . $id . '/reading/' . $rid . '/ddq/' . $ddq_id . '/subjects/' . $item->id . '.txt';
            if (file_exists($filename))
                unlink($filename);
            
            write_file($filename, serialize($item), 'a');

        }
    }

    private function export_reading_oq($id = 0, $rid = 0) {
        $filename = 'data/export/' . $id . '/reading/' . $rid . '/oq';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }
    }

    private function export_listening_video($id = 0, $lid = 0) {
        $filename = 'data/export/' . $id . '/listening/' . $lid . '/video';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $lid);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('listening_video');
        $items = $query->result();
        foreach ($items as $item) {
            $filename = 'data/export/' . $id . '/listening/' . $lid . '/video/' . $item->id;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename .= '/' . $item->id . '.txt';
            if (file_exists($filename))
                unlink($filename);
            
            write_file($filename, serialize($item), 'a');

            copy('data/images/listening/' . $item->limg, 'data/export/' . $id . '/listening/' . $lid . '/video/' . $item->id . '/' . $item->limg);
        }
    }

    private function export_listening_scq($id = 0, $lid = 0) {
        $filename = 'data/export/' . $id . '/listening/' . $lid . '/scq';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $lid);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('listening_scq');
        $items = $query->result();
        foreach ($items as $item) {
            $filename = 'data/export/' . $id . '/listening/' . $lid . '/scq/' . $item->id;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename .= '/' . $item->id . '.txt';
            if (file_exists($filename))
                unlink($filename);
            
            write_file($filename, serialize($item), 'a');

            copy('data/sounds/listening/scq/' . $item->lsound, 'data/export/' . $id . '/listening/' . $lid . '/scq/' . $item->id . '/' . $item->lsound);

            copy('data/sounds/listening/replay_sound/scq/' . $item->replay_sound, 'data/export/' . $id . '/listening/' . $lid . '/scq/' . $item->id . '/' . $item->replay_sound);

            copy('data/sounds/listening/sentence_sound/scq/' . $item->sentence_sound, 'data/export/' . $id . '/listening/' . $lid . '/scq/' . $item->id . '/' . $item->sentence_sound);
        }
    }

    private function export_listening_mcq($id = 0, $lid = 0) {
        $filename = 'data/export/' . $id . '/listening/' . $lid . '/mcq';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $lid);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('listening_mcq');
        $items = $query->result();
        foreach ($items as $item) {
            $filename = 'data/export/' . $id . '/listening/' . $lid . '/mcq/' . $item->id;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename .= '/' . $item->id . '.txt';
            if (file_exists($filename))
                unlink($filename);
            
            write_file($filename, serialize($item), 'a');

            copy('data/sounds/listening/mcq/' . $item->lsound, 'data/export/' . $id . '/listening/' . $lid . '/mcq/' . $item->id . '/' . $item->lsound);

            copy('data/sounds/listening/replay_sound/mcq/' . $item->replay_sound, 'data/export/' . $id . '/listening/' . $lid . '/mcq/' . $item->id . '/' . $item->replay_sound);

            copy('data/sounds/listening/sentence_sound/mcq/' . $item->sentence_sound, 'data/export/' . $id . '/listening/' . $lid . '/mcq/' . $item->id . '/' . $item->sentence_sound);
        }
    }

    private function export_listening_cq($id = 0, $lid = 0) {
        $filename = 'data/export/' . $id . '/listening/' . $lid . '/cq';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $lid);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('listening_cq');
        $items = $query->result();
        foreach ($items as $item) {
            $filename = 'data/export/' . $id . '/listening/' . $lid . '/cq/' . $item->id;
            if (!file_exists($filename)) {
                mkdir($filename, 0, true);
                chmod($filename, 0777);
            }

            $filename_content = $filename . '/' . $item->id . '-content.txt';
            if (file_exists($filename_content))
                unlink($filename_content);

            $filename .= '/' . $item->id . '.txt';
            if (file_exists($filename))
                unlink($filename);
            
            write_file($filename, serialize($item), 'a');

            copy('data/sounds/listening/cq/' . $item->lsound, 'data/export/' . $id . '/listening/' . $lid . '/cq/' . $item->id . '/' . $item->lsound);

            copy('data/sounds/listening/replay_sound/cq/' . $item->replay_sound, 'data/export/' . $id . '/listening/' . $lid . '/cq/' . $item->id . '/' . $item->replay_sound);

            copy('data/sounds/listening/sentence_sound/cq/' . $item->sentence_sound, 'data/export/' . $id . '/listening/' . $lid . '/cq/' . $item->id . '/' . $item->sentence_sound);

            $this->export_listening_cq_column($id, $lid, $item->id);
            $this->export_listening_cq_row($id, $lid, $item->id);
        }
    }

    private function export_listening_oq($id = 0, $lid = 0) {
        $filename = 'data/export/' . $id . '/listening/' . $lid . '/oq';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }
    }

    private function export_listening_cq_column($id = 0, $lid = 0, $cq_id = 0) {
        $filename = 'data/export/' . $id . '/listening/' . $lid . '/cq/' . $cq_id . '/column';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('cqid', $cq_id);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('listening_cq_column');
        $items = $query->result();
        foreach ($items as $item) {

            $filename = 'data/export/' . $id . '/listening/' . $lid . '/cq/' . $cq_id . '/column/' . $item->id . '.txt';
            if (file_exists($filename))
                unlink($filename);
            
            write_file($filename, serialize($item), 'a');
        }
    }

    private function export_listening_cq_row($id = 0, $lid = 0, $cq_id = 0) {
        $filename = 'data/export/' . $id . '/listening/' . $lid . '/cq/' . $cq_id . '/row';
        if (!file_exists($filename)) {
            mkdir($filename, 0, true);
            chmod($filename, 0777);
        }

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('cqid', $cq_id);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('listening_cq_row');
        $items = $query->result();
        foreach ($items as $item) {

            $filename = 'data/export/' . $id . '/listening/' . $lid . '/cq/' . $cq_id . '/row/' . $item->id . '.txt';
            if (file_exists($filename))
                unlink($filename);
            
            write_file($filename, serialize($item), 'a');

        }
    }

}