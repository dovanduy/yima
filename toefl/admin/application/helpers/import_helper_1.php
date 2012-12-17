<?php

if (!function_exists('import_source_test')) {

    function import_source_test($id = 0) {
        $handle = @fopen('data/import/' . $id . '/' . $id . '.txt', "r");
        if ($handle) {
            /* $source_test->id = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->title = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->level = str_replace("\n", '', fgets($handle, 1000000));

              $source_test->reading1 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->reading2 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->reading3 = str_replace("\n", '', fgets($handle, 1000000));

              $source_test->listening1 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->listening2 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->listening3 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->listening4 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->listening5 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->listening6 = str_replace("\n", '', fgets($handle, 1000000));

              $source_test->speaking1 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->speaking2 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->speaking3 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->speaking4 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->speaking5 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->speaking6 = str_replace("\n", '', fgets($handle, 1000000));

              $source_test->writing1 = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->writing2 = str_replace("\n", '', fgets($handle, 1000000));

              $source_test->keyword = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->source = str_replace("\n", '', fgets($handle, 1000000));
              $source_test->note = str_replace("\n", '', fgets($handle, 1000000)); */

            $source_test = unserialize(fgets($handle, 1000000));

            fclose($handle);

            $time = time();
            $source_test->author = current_user_id();
            $source_test->date_added = $time;
            $source_test->last_modified = $time;

            $CI = & get_instance();
            $CI->db->insert('_source_test', $source_test);

            return $source_test;
        }
    }

}

if (!function_exists('import_reading')) {

    function import_reading($id = 0, $rid = 0) {
        $handle = @fopen('data/import/' . $id . '/reading/' . $rid . '/' . $rid . '.txt', "r");

        if ($handle) {
            /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
              $item->content = read_file('data/import/' . $id . '/reading/' . $rid . '/' . $rid . '-content.txt');
              $item->title = str_replace("\n", '', fgets($handle, 1000000));
              $item->level = str_replace("\n", '', fgets($handle, 1000000));
              $item->test_time = str_replace("\n", '', fgets($handle, 1000000));
              $item->keyword = str_replace("\n", '', fgets($handle, 1000000));
              $item->source = str_replace("\n", '', fgets($handle, 1000000));
              $item->reading_part = str_replace("\n", '', fgets($handle, 1000000)); */

            $item = unserialize(fgets($handle, 1000000));

            fclose($handle);

            $time = time();
            $item->author = current_user_id();
            $item->date_added = $time;
            $item->last_modified = $time;

            $CI = & get_instance();
            $CI->db->insert('_reading', $item);

            import_reading_scq($id, $rid);
            import_reading_mcq($id, $rid);
            import_reading_iq($id, $rid);
            import_reading_ddq($id, $rid);
            import_reading_oq($id, $rid);

            return $item;
        }
    }

}

if (!function_exists('import_listening')) {

    function import_listening($id = 0, $lid = 0) {
        $handle = @fopen('data/import/' . $id . '/listening/' . $lid . '/' . $lid . '.txt', "r");

        if ($handle) {
            /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
              $item->title = str_replace("\n", '', fgets($handle, 1000000));
              $item->level = str_replace("\n", '', fgets($handle, 1000000));
              $item->test_time = str_replace("\n", '', fgets($handle, 1000000));
              $item->keyword = str_replace("\n", '', fgets($handle, 1000000));
              $item->source = str_replace("\n", '', fgets($handle, 1000000));
              $item->listening_part = str_replace("\n", '', fgets($handle, 1000000));
              $item->listening_type = str_replace("\n", '', fgets($handle, 1000000));
              $item->lsound = str_replace("\n", '', fgets($handle, 1000000)); */

            $item = unserialize(fgets($handle, 1000000));
            fclose($handle);

            $time = time();
            $item->author = current_user_id();
            $item->date_added = $time;
            $item->last_modified = $time;

            $CI = & get_instance();
            $CI->db->insert('_listening', $item);

            import_listening_video($id, $lid);
            import_listening_scq($id, $lid);
            import_listening_mcq($id, $lid);
            import_listening_cq($id, $lid);
            import_listening_oq($id, $lid);

            return $item;
        }
    }

}


if (!function_exists('import_speaking')) {

    function import_speaking($id = 0, $sid = 0) {
        $handle = @fopen('data/import/' . $id . '/speaking/' . $sid . '/' . $sid . '.txt', "r");

        if ($handle) {

            /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
              $item->title = str_replace("\n", '', fgets($handle, 1000000));
              $item->level = str_replace("\n", '', fgets($handle, 1000000));
              $item->keyword = str_replace("\n", '', fgets($handle, 1000000));
              $item->source = str_replace("\n", '', fgets($handle, 1000000));
              $item->speaking_part = str_replace("\n", '', fgets($handle, 1000000));

              $item->limg = str_replace("\n", '', fgets($handle, 1000000));
              $item->lsound = str_replace("\n", '', fgets($handle, 1000000));
              $item->subject = str_replace("\n", '', fgets($handle, 1000000));
              $item->ssound = str_replace("\n", '', fgets($handle, 1000000));
              $item->direction = str_replace("\n", '', fgets($handle, 1000000));
              $item->dsound = str_replace("\n", '', fgets($handle, 1000000));
              $item->introsound = str_replace("\n", '', fgets($handle, 1000000));

              $item->content = read_file('data/import/' . $id . '/speaking/' . $sid . '/' . $sid . '-content.txt'); */

            $item = unserialize(fgets($handle, 1000000));
            fclose($handle);

            $time = time();
            $item->author = current_user_id();
            $item->date_added = $time;
            $item->last_modified = $time;

            $CI = & get_instance();
            $CI->db->insert('_speaking', $item);

            return $item;
        }
    }

}


if (!function_exists('import_writing')) {

    function import_writing($id = 0, $wid = 0) {
        $handle = @fopen('data/import/' . $id . '/writing/' . $wid . '/' . $wid . '.txt', "r");

        if ($handle) {

            /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
              $item->title = str_replace("\n", '', fgets($handle, 1000000));
              $item->level = str_replace("\n", '', fgets($handle, 1000000));
              $item->keyword = str_replace("\n", '', fgets($handle, 1000000));
              $item->source = str_replace("\n", '', fgets($handle, 1000000));
              $item->writing_part = str_replace("\n", '', fgets($handle, 1000000));

              $item->limg = str_replace("\n", '', fgets($handle, 1000000));
              $item->lsound = str_replace("\n", '', fgets($handle, 1000000));
              $item->subject = str_replace("\n", '', fgets($handle, 1000000));
              $item->ssound = str_replace("\n", '', fgets($handle, 1000000));
              $item->direction = str_replace("\n", '', fgets($handle, 1000000));
              $item->dsound = str_replace("\n", '', fgets($handle, 1000000));

              $item->content = read_file('data/import/' . $id . '/writing/' . $wid . '/' . $wid . '-content.txt'); */
            $item = unserialize(fgets($handle, 1000000));
            fclose($handle);

            $time = time();
            $item->author = current_user_id();
            $item->date_added = $time;
            $item->last_modified = $time;

            $CI = & get_instance();
            $CI->db->insert('_writing', $item);

            return $item;
        }
    }

}


if (!function_exists('import_reading_scq')) {

    function import_reading_scq($id = 0, $rid = 0) {
        $dir = 'data/import/' . $id . '/reading/' . $rid . '/scq';
        $items;
        if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                    $items[] = $entry;
            }

            closedir($handle);
        }

        if (count($items) > 0) {
            $CI = & get_instance();

            foreach ($items as $data_id) {
                $handle = @fopen($dir . '/' . $data_id . '/' . $data_id . '.txt', "r");

                $filename = $dir . '/' . $data_id . '/' . $data_id . '.txt';

                if ($handle) {
                    /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
                      $item->rid = str_replace("\n", '', fgets($handle, 1000000));

                      $item->content = read_file($dir . '/' . $data_id . '/' . $data_id . '-content.txt');

                      $item->title = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice1 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice2 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice3 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice4 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->answer = str_replace("\n", '', fgets($handle, 1000000)); */

                    $item = unserialize(read_file($filename));

                    fclose($handle);

                    $time = time();
                    $item->author = current_user_id();
                    $item->date_added = $time;
                    $item->last_modified = $time;

                    $CI->db->insert('_reading_scq', $item);
                }
            }
        }
    }

}

if (!function_exists('import_reading_mcq')) {

    function import_reading_mcq($id = 0, $rid = 0) {
        $dir = 'data/import/' . $id . '/reading/' . $rid . '/mcq';
        $items;
        if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                    $items[] = $entry;
            }

            closedir($handle);
        }

        if (count($items) > 0) {
            $CI = & get_instance();

            foreach ($items as $data_id) {
                $handle = @fopen($dir . '/' . $data_id . '/' . $data_id . '.txt', "r");

                if ($handle) {
                    /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
                      $item->rid = str_replace("\n", '', fgets($handle, 1000000));

                      $item->content = read_file($dir . '/' . $data_id . '/' . $data_id . '-content.txt');

                      $item->title = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice1 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice2 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice3 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice4 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->answer = str_replace("\n", '', fgets($handle, 1000000)); */

                    $item = unserialize(fgets($handle, 1000000));

                    fclose($handle);

                    $time = time();
                    $item->author = current_user_id();
                    $item->date_added = $time;
                    $item->last_modified = $time;

                    $CI->db->insert('_reading_mcq', $item);
                }
            }
        }
    }

}

if (!function_exists('import_reading_iq')) {

    function import_reading_iq($id = 0, $rid = 0) {
        $dir = 'data/import/' . $id . '/reading/' . $rid . '/iq';
        $items;
        if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                    $items[] = $entry;
            }

            closedir($handle);
        }

        if (count($items) > 0) {
            $CI = & get_instance();

            foreach ($items as $data_id) {
                $handle = @fopen($dir . '/' . $data_id . '/' . $data_id . '.txt', "r");

                if ($handle) {
                    /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
                      $item->rid = str_replace("\n", '', fgets($handle, 1000000));

                      $item->content = read_file($dir . '/' . $data_id . '/' . $data_id . '-content.txt');

                      $item->title = str_replace("\n", '', fgets($handle, 1000000));
                      $item->answer = str_replace("\n", '', fgets($handle, 1000000)); */

                    $item = unserialize(fgets($handle, 1000000));

                    fclose($handle);

                    $time = time();
                    $item->author = current_user_id();
                    $item->date_added = $time;
                    $item->last_modified = $time;

                    $CI->db->insert('_reading_iq', $item);
                }
            }
        }
    }

}

if (!function_exists('import_reading_ddq')) {

    function import_reading_ddq($id = 0, $rid = 0) {
        $dir = 'data/import/' . $id . '/reading/' . $rid . '/ddq';
        $items;
        if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                    $items[] = $entry;
            }

            closedir($handle);
        }

        if (count($items) > 0) {
            $CI = & get_instance();

            foreach ($items as $data_id) {
                $handle = @fopen($dir . '/' . $data_id . '/' . $data_id . '.txt', "r");

                if ($handle) {
                    /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
                      $item->rid = str_replace("\n", '', fgets($handle, 1000000));

                      $item->content = read_file($dir . '/' . $data_id . '/' . $data_id . '-content.txt');

                      $item->title = str_replace("\n", '', fgets($handle, 1000000)); */

                    $item = unserialize(fgets($handle, 1000000));

                    fclose($handle);

                    $time = time();
                    $item->author = current_user_id();
                    $item->date_added = $time;
                    $item->last_modified = $time;

                    $CI->db->insert('_reading_ddq', $item);

                    import_reading_ddq_answer($id, $rid, $item->id);
                    import_reading_ddq_subjects($id, $rid, $item->id);
                }
            }
        }
    }

}

if (!function_exists('import_reading_ddq_answer')) {

    function import_reading_ddq_answer($id = 0, $rid = 0, $ddq_id = 0) {
        $dir = 'data/import/' . $id . '/reading/' . $rid . '/ddq/' . $ddq_id . '/answer';
        $items;
        if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                    $items[] = str_replace('.txt', '', $entry);
            }

            closedir($handle);
        }

        if (count($items) > 0) {
            $CI = & get_instance();

            foreach ($items as $data_id) {
                $handle = @fopen($dir . '/' . $data_id . '.txt', "r");

                if ($handle) {
                    /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
                      $item->ddqid = str_replace("\n", '', fgets($handle, 1000000));
                      $item->subid = str_replace("\n", '', fgets($handle, 1000000));
                      $item->title = str_replace("\n", '', fgets($handle, 1000000)); */

                    $item = unserialize(fgets($handle, 1000000));

                    fclose($handle);

                    $CI->db->insert('_reading_ddq_answer', $item);
                }
            }
        }
    }

}

if (!function_exists('import_reading_ddq_subjects')) {

    function import_reading_ddq_subjects($id = 0, $rid = 0, $ddq_id = 0) {
        $dir = 'data/import/' . $id . '/reading/' . $rid . '/ddq/' . $ddq_id . '/subjects';
        $items;
        if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                    $items[] = str_replace('.txt', '', $entry);
            }

            closedir($handle);
        }

        if (count($items) > 0) {
            $CI = & get_instance();

            foreach ($items as $data_id) {
                $handle = @fopen($dir . '/' . $data_id . '.txt', "r");

                if ($handle) {
                    /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
                      $item->ddqid = str_replace("\n", '', fgets($handle, 1000000));
                      $item->title = str_replace("\n", '', fgets($handle, 1000000)); */

                    $item = unserialize(fgets($handle, 1000000));

                    fclose($handle);

                    $CI->db->insert('_reading_ddq_subjects', $item);
                }
            }
        }
    }

}

if (!function_exists('import_reading_oq')) {

    function import_reading_oq($id = 0, $rid = 0) {
        
    }

}

if (!function_exists('import_listening_video')) {

    function import_listening_video($id = 0, $lid = 0) {
        $dir = 'data/import/' . $id . '/listening/' . $lid . '/video';
        $items;
        if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                    $items[] = $entry;
            }

            closedir($handle);
        }

        if (count($items) > 0) {
            $CI = & get_instance();

            foreach ($items as $data_id) {
                $handle = @fopen($dir . '/' . $data_id . '/' . $data_id . '.txt', "r");

                if ($handle) {
                    /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
                      $item->lid = str_replace("\n", '', fgets($handle, 1000000));

                      $item->title = str_replace("\n", '', fgets($handle, 1000000));
                      $item->limg = str_replace("\n", '', fgets($handle, 1000000));
                      $item->time = str_replace("\n", '', fgets($handle, 1000000)); */

                    $item = unserialize(fgets($handle, 1000000));

                    fclose($handle);

                    $time = time();
                    $item->author = current_user_id();
                    $item->date_added = $time;
                    $item->last_modified = $time;

                    $CI->db->insert('_listening_video', $item);
                }
            }
        }
    }

}

if (!function_exists('import_listening_scq')) {

    function import_listening_scq($id = 0, $lid = 0) {
        $dir = 'data/import/' . $id . '/listening/' . $lid . '/scq';
        $items;
        if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                    $items[] = $entry;
            }

            closedir($handle);
        }

        if (count($items) > 0) {
            $CI = & get_instance();

            foreach ($items as $data_id) {
                $handle = @fopen($dir . '/' . $data_id . '/' . $data_id . '.txt', "r");

                if ($handle) {
                    /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
                      $item->lid = str_replace("\n", '', fgets($handle, 1000000));

                      $item->title = str_replace("\n", '', fgets($handle, 1000000));
                      $item->lsound = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice1 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice2 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice3 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice4 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->answer = str_replace("\n", '', fgets($handle, 1000000));

                      $item->replay = str_replace("\n", '', fgets($handle, 1000000));
                      $item->replay_from = str_replace("\n", '', fgets($handle, 1000000));
                      $item->replay_to = str_replace("\n", '', fgets($handle, 1000000));
                      $item->replay_sound = str_replace("\n", '', fgets($handle, 1000000));
                      $item->sentence = str_replace("\n", '', fgets($handle, 1000000));
                      $item->sentence_sound = str_replace("\n", '', fgets($handle, 1000000)); */

                    $item = unserialize(fgets($handle, 1000000));

                    fclose($handle);

                    $time = time();
                    $item->author = current_user_id();
                    $item->date_added = $time;
                    $item->last_modified = $time;

                    $CI->db->insert('_listening_scq', $item);
                }
            }
        }
    }

}

if (!function_exists('import_listening_mcq')) {

    function import_listening_mcq($id = 0, $lid = 0) {
        $dir = 'data/import/' . $id . '/listening/' . $lid . '/mcq';
        $items;
        if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                    $items[] = $entry;
            }

            closedir($handle);
        }

        if (count($items) > 0) {
            $CI = & get_instance();

            foreach ($items as $data_id) {
                $handle = @fopen($dir . '/' . $data_id . '/' . $data_id . '.txt', "r");

                if ($handle) {
                    /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
                      $item->lid = str_replace("\n", '', fgets($handle, 1000000));

                      $item->title = str_replace("\n", '', fgets($handle, 1000000));
                      $item->lsound = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice1 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice2 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice3 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->choice4 = str_replace("\n", '', fgets($handle, 1000000));
                      $item->answer = str_replace("\n", '', fgets($handle, 1000000));

                      $item->replay = str_replace("\n", '', fgets($handle, 1000000));
                      $item->replay_from = str_replace("\n", '', fgets($handle, 1000000));
                      $item->replay_to = str_replace("\n", '', fgets($handle, 1000000));
                      $item->replay_sound = str_replace("\n", '', fgets($handle, 1000000));
                      $item->sentence = str_replace("\n", '', fgets($handle, 1000000));
                      $item->sentence_sound = str_replace("\n", '', fgets($handle, 1000000)); */

                    $item = unserialize(fgets($handle, 1000000));

                    fclose($handle);

                    $time = time();
                    $item->author = current_user_id();
                    $item->date_added = $time;
                    $item->last_modified = $time;

                    $CI->db->insert('_listening_mcq', $item);
                }
            }
        }
    }

}

if (!function_exists('import_listening_cq')) {

    function import_listening_cq($id = 0, $lid = 0) {
        $dir = 'data/import/' . $id . '/listening/' . $lid . '/cq';
        $items;
        if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                    $items[] = $entry;
            }

            closedir($handle);
        }

        if (count($items) > 0) {
            $CI = & get_instance();

            foreach ($items as $data_id) {
                $handle = @fopen($dir . '/' . $data_id . '/' . $data_id . '.txt', "r");

                if ($handle) {
                    /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
                      $item->lid = str_replace("\n", '', fgets($handle, 1000000));

                      $item->title = str_replace("\n", '', fgets($handle, 1000000));

                      $item->content = read_file($dir . '/' . $data_id . '/' . $data_id . '-content.txt');

                      $item->lsound = str_replace("\n", '', fgets($handle, 1000000));

                      $item->replay = str_replace("\n", '', fgets($handle, 1000000));
                      $item->replay_from = str_replace("\n", '', fgets($handle, 1000000));
                      $item->replay_to = str_replace("\n", '', fgets($handle, 1000000));
                      $item->replay_sound = str_replace("\n", '', fgets($handle, 1000000));
                      $item->sentence = str_replace("\n", '', fgets($handle, 1000000));
                      $item->sentence_sound = str_replace("\n", '', fgets($handle, 1000000)); */

                    $item = unserialize(fgets($handle, 1000000));

                    fclose($handle);

                    $time = time();
                    $item->author = current_user_id();
                    $item->date_added = $time;
                    $item->last_modified = $time;

                    $CI->db->insert('_listening_cq', $item);

                    import_listening_cq_column($id, $lid, $item->id);
                    import_listening_cq_row($id, $lid, $item->id);
                }
            }
        }
    }

}

if (!function_exists('import_listening_cq_column')) {

    function import_listening_cq_column($id = 0, $lid = 0, $cq_id = 0) {
        $dir = 'data/import/' . $id . '/listening/' . $lid . '/cq/' . $cq_id . '/column';
        $items;
        if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                    $items[] = str_replace('.txt', '', $entry);
            }

            closedir($handle);
        }

        if (count($items) > 0) {
            $CI = & get_instance();

            foreach ($items as $data_id) {
                $handle = @fopen($dir . '/' . $data_id . '.txt', "r");

                if ($handle) {
                    /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
                      $item->cqid = str_replace("\n", '', fgets($handle, 1000000));
                      $item->title = str_replace("\n", '', fgets($handle, 1000000)); */

                    $item = unserialize(fgets($handle, 1000000));

                    fclose($handle);

                    $CI->db->insert('_listening_cq_column', $item);
                }
            }
        }
    }

}

if (!function_exists('import_listening_cq_row')) {

    function import_listening_cq_row($id = 0, $lid = 0, $cq_id = 0) {
        $dir = 'data/import/' . $id . '/listening/' . $lid . '/cq/' . $cq_id . '/row';
        $items;
        if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..')
                    $items[] = str_replace('.txt', '', $entry);
            }

            closedir($handle);
        }

        if (count($items) > 0) {
            $CI = & get_instance();

            foreach ($items as $data_id) {
                $handle = @fopen($dir . '/' . $data_id . '.txt', "r");

                if ($handle) {
                    /* $item->id = str_replace("\n", '', fgets($handle, 1000000));
                      $item->cqid = str_replace("\n", '', fgets($handle, 1000000));
                      $item->title = str_replace("\n", '', fgets($handle, 1000000));
                      $item->col = str_replace("\n", '', fgets($handle, 1000000)); */

                    $item = unserialize(fgets($handle, 1000000));

                    fclose($handle);

                    $CI->db->insert('_listening_cq_row', $item);
                }
            }
        }
    }

}

if (!function_exists('import_listening_oq')) {

    function import_listening_oq($id = 0, $lid = 0) {
        
    }

}


if (!function_exists('migrate_db')) {

    function migrate_db() {
        $CI = & get_instance();

        $CI->db->empty_table('listening');
        $CI->db->empty_table('listening_cq');
        $CI->db->empty_table('listening_cq_column');
        $CI->db->empty_table('listening_cq_row');
        $CI->db->empty_table('listening_mcq');
        $CI->db->empty_table('listening_oq');
        $CI->db->empty_table('listening_scq');
        $CI->db->empty_table('listening_video');
        $CI->db->empty_table('reading');
        $CI->db->empty_table('reading_ddq');
        $CI->db->empty_table('reading_ddq_answer');
        $CI->db->empty_table('reading_ddq_subjects');
        $CI->db->empty_table('reading_iq');
        $CI->db->empty_table('reading_mcq');
        $CI->db->empty_table('reading_oq');
        $CI->db->empty_table('reading_scq');
        $CI->db->empty_table('source_test');
        $CI->db->empty_table('speaking');
        $CI->db->empty_table('writing');

        $convert;

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_reading');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $CI->db->insert('reading', $item);
            $convert['reading'][$old_id] = $CI->db->insert_id();
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_listening');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $CI->db->insert('listening', $item);
            $convert['listening'][$old_id] = $CI->db->insert_id();
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_speaking');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $CI->db->insert('speaking', $item);
            $convert['speaking'][$old_id] = $CI->db->insert_id();
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_writing');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $CI->db->insert('writing', $item);
            $convert['writing'][$old_id] = $CI->db->insert_id();
        }


        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_source_test');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;

            $item->reading1 = $convert['reading'][$item->reading1];
            $item->reading2 = $convert['reading'][$item->reading2];
            $item->reading3 = $convert['reading'][$item->reading3];

            $item->listening1 = $convert['listening'][$item->listening1];
            $item->listening2 = $convert['listening'][$item->listening2];
            $item->listening3 = $convert['listening'][$item->listening3];
            $item->listening4 = $convert['listening'][$item->listening4];
            $item->listening5 = $convert['listening'][$item->listening5];
            $item->listening6 = $convert['listening'][$item->listening6];

            $item->speaking1 = $convert['speaking'][$item->speaking1];
            $item->speaking2 = $convert['speaking'][$item->speaking2];
            $item->speaking3 = $convert['speaking'][$item->speaking3];
            $item->speaking4 = $convert['speaking'][$item->speaking4];
            $item->speaking5 = $convert['speaking'][$item->speaking5];
            $item->speaking6 = $convert['speaking'][$item->speaking6];

            $item->writing1 = $convert['writing'][$item->writing1];
            $item->writing2 = $convert['writing'][$item->writing2];

            $CI->db->insert('source_test', $item);
            $convert['source_test'][$old_id] = $CI->db->insert_id();
        }
    }

}

if (!function_exists('migrate_files')) {

    function migrate_files() {
        
    }

}

