<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Check_missing_files extends CI_Controller {

    public function index() {
        $params = array('filename' => '');
        $this->load->library('mp3file', $params);

        $this->check_listening();
        $this->check_listening_scq();
        $this->check_listening_mcq();
        $this->check_listening_cq();
        //$this->check_listening_oq();

        $this->check_speaking();
        $this->check_writing();
    }

    private function valid_sound($filename = '') {
        $info = '';


        if (file_exists($filename)) {
            $this->mp3file->read_newfile($filename);
            $a = $this->mp3file->get_metadata();
            if ($a['Encoding'] == 'Unknown') {
                $info = 'Wrong MP3 <a href="' . $filename . '" alt="" target="_blank">Download</a>';
                if (sound_length($filename) != '')
                    $info = '';
            }
        } else {
            $info = 'Not Existed';
        }
        return $info;
    }

    private function check_listening() {
        echo "--- <strong>LISTENING</strong> ---<br/>";
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->order_by('listening_part', 'asc');
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('listening');
        $items = $query->result();

        foreach ($items as $item) {
            $name = explode('.', $item->lsound);
            $file = 'data/sounds/listening/listening_page/' . $item->lsound;

            $error = $this->valid_sound($file);

            if ($error != '')
                echo '<div><strong>Listening ' . $item->listening_part . '</strong>: ' . $item->title . "</div>
                      <div><strong>File</strong>: " . $file . "</div>
                      <div style='color: #f00;'>Error: " . $error . "</div><br/>";
        }

        echo "------------------------<br/><br/>";
    }

    private function check_listening_scq() {
        echo "--- <strong>LISTENING SCQ</strong> ---<br/>";

        $this->db->select('*,
            (select listening.title from listening where listening.id=listening_scq.lid) as listening_title,
            (select listening.listening_part from listening where listening.id=listening_scq.lid) as listening_part');
        $this->db->where('deleted', 0);
        $this->db->order_by('lid', 'asc');
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('listening_scq');
        $items = $query->result();

        foreach ($items as $item) {
            $name = explode('.', $item->lsound);
            $file = 'data/sounds/listening/scq/' . $item->lsound;

            $error = $this->valid_sound($file);

            if ($error != '')
                echo '<div><strong>Listening ' . $item->listening_part . '</strong>: ' . $item->listening_title . "</div>
                      <div><strong>SCQ</strong>: " . $item->title . "</div>
                      <div><strong>File</strong>: " . $file . "</div>
                      <div style='color: #f00;'>Error: " . $error . "</div><br/>";
        }
        echo "------------------------<br/><br/>";
    }

    private function check_listening_mcq() {
        echo "--- <strong>LISTENING MCQ</strong> ---<br/>";

        $this->db->select('*,
                        (select listening.title from listening where listening.id=listening_mcq.lid) as listening_title,
                        (select listening.listening_part from listening where listening.id=listening_mcq.lid) as listening_part');
        $this->db->where('deleted', 0);
        $this->db->order_by('lid', 'asc');
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('listening_mcq');
        $items = $query->result();

        foreach ($items as $item) {
            $name = explode('.', $item->lsound);
            $file = 'data/sounds/listening/mcq/' . $item->lsound;

            $error = $this->valid_sound($file);

            if ($error != '')
                echo '<div><strong>Listening ' . $item->listening_part . '</strong>: ' . $item->listening_title . "</div>
                      <div><strong>MCQ</strong>: " . $item->title . "</div>
                      <div><strong>File</strong>: " . $file . "</div>
                      <div style='color: #f00;'>Error: " . $error . "</div><br/>";
        }
        echo "------------------------<br/><br/>";
    }

    private function check_listening_cq() {
        echo "--- <strong>LISTENING CQ</strong> ---<br/>";

        $this->db->select('*, (select listening.title from listening where listening.id=listening_cq.lid) as listening_title,
            (select listening.listening_part from listening where listening.id=listening_cq.lid) as listening_part');
        $this->db->where('deleted', 0);
        $this->db->order_by('lid', 'asc');
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('listening_cq');
        $items = $query->result();

        foreach ($items as $item) {
            $name = explode('.', $item->lsound);
            $file = 'data/sounds/listening/cq/' . $item->lsound;

            $error = $this->valid_sound($file);

            if ($error != '')
                echo '<div><strong>Listening ' . $item->listening_part . '</strong>: ' . $item->listening_title . "</div>
                      <div><strong>CQ</strong>: " . $item->title . "</div>
                      <div><strong>File</strong>: " . $file . "</div>
                      <div style='color: #f00;'>Error: " . $error . "</div><br/>";
        }
        echo "------------------------<br/><br/>";
    }

    private function check_listening_oq() {
        echo "--- <strong>LISTENING OQ</strong> ---<br/>";

        $this->db->select('*, (select listening.title from listening where listening.id=listening_oq.lid) as listening_title,
            (select listening.listening_part from listening where listening.id=listening_oq.lid) as listening_part');
        $this->db->where('deleted', 0);
        $this->db->order_by('lid', 'asc');
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('listening_oq');
        $items = $query->result();

        foreach ($items as $item) {
            $name = explode('.', $item->lsound);
            $file = 'data/sounds/listening/oq/' . $item->lsound;

            $error = $this->valid_sound($file);

            if ($error != '')
                echo '<div><strong>Listening ' . $item->listening_part . '</strong>: ' . $item->listening_title . "</div>
                      <div><strong>OQ</strong>: " . $item->title . "</div>
                      <div><strong>File</strong>: " . $file . "</div>
                      <div style='color: #f00;'>Error: " . $error . "</div><br/>";
        }
        echo "------------------------<br/><br/>";
    }

    private function check_speaking() {
        echo "--- <strong>SPEAKING</strong> ---<br/>";

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->order_by('speaking_part', 'asc');
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('speaking');
        $items = $query->result();

        foreach ($items as $item) {
            $file = 'data/sounds/speaking/' . $item->ssound;
            $error = $this->valid_sound($file);

            if ($error != '') {
                echo '<div><strong>Speaking ' . $item->speaking_part . '</strong>: ' . $item->title . "</div>
                      <div><strong>Subject Sound</strong>: " . $file . " - <span style='color: #f00;'>Error: " . $error . "</span></div>";
            } else {
                echo '<div><strong>Speaking ' . $item->speaking_part . '</strong>: ' . $item->title . "</div>
                      <div><strong>Subject Sound</strong>: " . $file . " - <span style='color: #0f0;'>Ok!</span></div>";
            }

            if ($item->speaking_part > 2) {
                $file = 'data/sounds/speaking/' . $item->lsound;
                $error = $this->valid_sound($file);
                if ($error != '')
                    echo "<div><strong>Listening Sound</strong>: " . $file . " - <span style='color: #f00;'>Error: " . $error . "</span></div>";


                /* $file = 'data/sounds/speaking/' . $item->dsound;
                  $error = $this->valid_sound($file);
                  if ($error != '')
                  echo "<div><strong>Direction Sound</strong>: " . $file . " - <span style='color: #f00;'>Error: " . $error . "</span></div>"; */
            }

            echo '<br/>';
        }
        echo "------------------------<br/><br/>";
    }

    private function check_writing() {
        echo "--- <strong>WRITING</strong> ---<br/>";

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->order_by('writing_part', 'asc');
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('writing');
        $items = $query->result();

        foreach ($items as $item) {
            $file = 'data/sounds/writing/' . $item->ssound;
            $error = $this->valid_sound($file);

            if ($error != '') {
                echo '<div><strong>Writing ' . $item->writing_part . '</strong>: ' . $item->title . "</div>
                      <div><strong>Subject Sound</strong>: " . $file . " - <span style='color: #f00;'>Error: " . $error . "</span></div>";
            } else {
                echo '<div><strong>Writing ' . $item->writing_part . '</strong>: ' . $item->title . "</div>
                      <div><strong>Subject Sound</strong>: " . $file . " - <span style='color: #0f0;'>Ok!</span></div>";
            }

            if ($item->writing_part < 2) {
                $file = 'data/sounds/writing/' . $item->lsound;
                $error = $this->valid_sound($file);
                if ($error != '')
                    echo "<div><strong>Listening Sound</strong>: " . $file . " - <span style='color: #f00;'>Error: " . $error . "</span></div>";


                /* $file = 'data/sounds/speaking/' . $item->dsound;
                  $error = $this->valid_sound($file);
                  if ($error != '')
                  echo "<div><strong>Direction Sound</strong>: " . $file . " - <span style='color: #f00;'>Error: " . $error . "</span></div>"; */
            }

            echo '<br/>';
        }
        echo "------------------------<br/><br/>";
    }

}