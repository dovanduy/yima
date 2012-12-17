<?php

if (!function_exists('import_source_test')) {

    function import_source_test($id = 0) {
        $filename = 'data/import/' . $id . '/' . $id . '.txt';
        $source_test = unserialize(read_file($filename));

        $time = time();
        $source_test->author = current_user_id();
        $source_test->date_added = $time;
        $source_test->last_modified = $time;

        $CI = & get_instance();
        $CI->db->insert('_source_test', $source_test);

        return $source_test;
    }

}

if (!function_exists('import_reading')) {

    function import_reading($id = 0, $rid = 0) {
        $filename = 'data/import/' . $id . '/reading/' . $rid . '/' . $rid . '.txt';
        $item = unserialize(read_file($filename));


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

if (!function_exists('import_listening')) {

    function import_listening($id = 0, $lid = 0) {
        $filename = 'data/import/' . $id . '/listening/' . $lid . '/' . $lid . '.txt';
        $item = unserialize(read_file($filename));

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


if (!function_exists('import_speaking')) {

    function import_speaking($id = 0, $sid = 0) {
        $filename = 'data/import/' . $id . '/speaking/' . $sid . '/' . $sid . '.txt';
        $item = unserialize(read_file($filename));

        $time = time();
        $item->author = current_user_id();
        $item->date_added = $time;
        $item->last_modified = $time;

        $CI = & get_instance();
        $CI->db->insert('_speaking', $item);

        return $item;
    }

}


if (!function_exists('import_writing')) {

    function import_writing($id = 0, $wid = 0) {
        $filename = 'data/import/' . $id . '/writing/' . $wid . '/' . $wid . '.txt';
        $item = unserialize(read_file($filename));

        $time = time();
        $item->author = current_user_id();
        $item->date_added = $time;
        $item->last_modified = $time;

        $CI = & get_instance();
        $CI->db->insert('_writing', $item);

        return $item;
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
                $filename = $dir . '/' . $data_id . '/' . $data_id . '.txt';
                $item = unserialize(read_file($filename));

                $time = time();
                $item->author = current_user_id();
                $item->date_added = $time;
                $item->last_modified = $time;

                $CI->db->insert('_reading_scq', $item);
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
                $filename = $dir . '/' . $data_id . '/' . $data_id . '.txt';
                $item = unserialize(read_file($filename));

                $time = time();
                $item->author = current_user_id();
                $item->date_added = $time;
                $item->last_modified = $time;

                $CI->db->insert('_reading_mcq', $item);
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
                $filename = $dir . '/' . $data_id . '/' . $data_id . '.txt';
                $item = unserialize(read_file($filename));

                $time = time();
                $item->author = current_user_id();
                $item->date_added = $time;
                $item->last_modified = $time;

                $CI->db->insert('_reading_iq', $item);
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
                $filename = $dir . '/' . $data_id . '/' . $data_id . '.txt';
                $item = unserialize(read_file($filename));

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
                $filename = $dir . '/' . $data_id . '.txt';
                $item = unserialize(read_file($filename));

                $CI->db->insert('_reading_ddq_answer', $item);
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
                $filename = $dir . '/' . $data_id . '.txt';
                $item = unserialize(read_file($filename));

                $CI->db->insert('_reading_ddq_subjects', $item);
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
                $filename = $dir . '/' . $data_id . '/' . $data_id . '.txt';
                $item = unserialize(read_file($filename));

                $time = time();
                $item->author = current_user_id();
                $item->date_added = $time;
                $item->last_modified = $time;

                $CI->db->insert('_listening_video', $item);
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
                $filename = $dir . '/' . $data_id . '/' . $data_id . '.txt';
                $item = unserialize(read_file($filename));

                $time = time();
                $item->author = current_user_id();
                $item->date_added = $time;
                $item->last_modified = $time;

                $CI->db->insert('_listening_scq', $item);
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
                $filename = $dir . '/' . $data_id . '/' . $data_id . '.txt';
                $item = unserialize(read_file($filename));

                $time = time();
                $item->author = current_user_id();
                $item->date_added = $time;
                $item->last_modified = $time;

                $CI->db->insert('_listening_mcq', $item);
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
                $filename = $dir . '/' . $data_id . '/' . $data_id . '.txt';
                $item = unserialize(read_file($filename));

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
                $filename = $dir . '/' . $data_id . '.txt';
                $item = unserialize(read_file($filename));

                $CI->db->insert('_listening_cq_column', $item);
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
                $filename = $dir . '/' . $data_id . '.txt';
                $item = unserialize(read_file($filename));

                $CI->db->insert('_listening_cq_row', $item);
            }
        }
    }

}

if (!function_exists('import_listening_oq')) {

    function import_listening_oq($id = 0, $lid = 0) {
        
    }

}


if (!function_exists('migrate_db')) {

    function migrate_db($source_test_id = 0) {
        $CI = & get_instance();

        /*$CI->db->empty_table('listening');
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
        $CI->db->empty_table('writing');*/

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

            // copy files
            $item->id = $convert['listening'][$old_id];

            $new_name = str_replace($old_id, $item->id, $item->lsound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_id . '/' . $item->lsound, 'data/sounds/listening/listening_page/' . $new_name);
            $item->lsound = $new_name;

            $CI->db->update('listening', $item, array('id' => $item->id));
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

            // copy files
            $item->id = $convert['speaking'][$old_id];

            $new_name = str_replace($old_id, $item->id, $item->limg);
            @copy('data/import/' . $source_test_id . '/speaking/' . $old_id . '/' . $item->limg, 'data/images/speaking/' . $new_name);
            $item->limg = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->lsound);
            @copy('data/import/' . $source_test_id . '/speaking/' . $old_id . '/' . $item->lsound, 'data/sounds/speaking/' . $new_name);
            $item->lsound = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->ssound);
            @copy('data/import/' . $source_test_id . '/speaking/' . $old_id . '/' . $item->ssound, 'data/sounds/speaking/' . $new_name);
            $item->ssound = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->dsound);
            @copy('data/import/' . $source_test_id . '/speaking/' . $old_id . '/' . $item->dsound, 'data/sounds/speaking/' . $new_name);
            $item->dsound = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->introsound);
            @copy('data/import/' . $source_test_id . '/speaking/' . $old_id . '/' . $item->introsound, 'data/sounds/speaking/' . $new_name);
            $item->introsound = $new_name;

            $CI->db->update('speaking', $item, array('id' => $item->id));
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

            // copy files
            $item->id = $convert['writing'][$old_id];

            $new_name = str_replace($old_id, $item->id, $item->limg);
            @copy('data/import/' . $source_test_id . '/writing/' . $old_id . '/' . $item->limg, 'data/images/writing/' . $new_name);
            $item->limg = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->lsound);
            @copy('data/import/' . $source_test_id . '/writing/' . $old_id . '/' . $item->lsound, 'data/sounds/writing/' . $new_name);
            $item->lsound = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->ssound);
            @copy('data/import/' . $source_test_id . '/writing/' . $old_id . '/' . $item->ssound, 'data/sounds/writing/' . $new_name);
            $item->ssound = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->dsound);
            @copy('data/import/' . $source_test_id . '/writing/' . $old_id . '/' . $item->dsound, 'data/sounds/writing/' . $new_name);
            $item->dsound = $new_name;

            $CI->db->update('writing', $item, array('id' => $item->id));
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

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_reading_scq');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $item->rid = $convert['reading'][$item->rid];
            $CI->db->insert('reading_scq', $item);
            $convert['reading_scq'][$old_id] = $CI->db->insert_id();
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_reading_mcq');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $item->rid = $convert['reading'][$item->rid];
            $CI->db->insert('reading_mcq', $item);
            $convert['reading_mcq'][$old_id] = $CI->db->insert_id();
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_reading_iq');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $item->rid = $convert['reading'][$item->rid];
            $CI->db->insert('reading_iq', $item);
            $convert['reading_iq'][$old_id] = $CI->db->insert_id();
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_reading_ddq');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $item->rid = $convert['reading'][$item->rid];
            $CI->db->insert('reading_ddq', $item);
            $convert['reading_ddq'][$old_id] = $CI->db->insert_id();
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_reading_ddq_subjects');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $item->ddqid = $convert['reading_ddq'][$item->ddqid];
            $CI->db->insert('reading_ddq_subjects', $item);
            $convert['reading_ddq_subjects'][$old_id] = $CI->db->insert_id();
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_reading_ddq_answer');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $item->ddqid = $convert['reading_ddq'][$item->ddqid];
            if ($item->subid != 0)
                $item->subid = $convert['reading_ddq_subjects'][$item->subid];
            $CI->db->insert('reading_ddq_answer', $item);
            $convert['reading_ddq_answer'][$old_id] = $CI->db->insert_id();
        }


        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_reading_oq');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $item->rid = $convert['reading'][$item->rid];
            $CI->db->insert('reading_oq', $item);
            $convert['reading_oq'][$old_id] = $CI->db->insert_id();
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_listening_video');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $old_lid = $item->lid;
            $item->id = null;
            $item->lid = $convert['listening'][$item->lid];
            $CI->db->insert('listening_video', $item);
            $convert['listening_video'][$old_id] = $CI->db->insert_id();

            // copy files
            $item->id = $convert['listening_video'][$old_id];

            $new_name = str_replace($old_id, $item->id, $item->limg);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/video/' . $old_id . '/' . $item->limg, 'data/images/listening/' . $new_name);
            $item->limg = $new_name;

            $CI->db->update('listening_video', $item, array('id' => $item->id));
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_listening_scq');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $old_lid = $item->lid;
            $item->id = null;
            $item->lid = $convert['listening'][$item->lid];
            $CI->db->insert('listening_scq', $item);
            $convert['listening_scq'][$old_id] = $CI->db->insert_id();

            // copy files
            $item->id = $convert['listening_scq'][$old_id];

            $new_name = str_replace($old_id, $item->id, $item->lsound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/scq/' . $old_id . '/' . $item->lsound, 'data/sounds/listening/scq/' . $new_name);
            $item->lsound = $new_name;
            
            $new_name = str_replace($old_id, $item->id, $item->replay_sound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/scq/' . $old_id . '/' . $item->replay_sound, 'data/sounds/listening/replay_sound/scq/' . $new_name);
            $item->replay_sound = $new_name;
            
            $new_name = str_replace($old_id, $item->id, $item->sentence_sound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/scq/' . $old_id . '/' . $item->sentence_sound, 'data/sounds/listening/sentence_sound/scq/' . $new_name);
            $item->sentence_sound = $new_name;

            $CI->db->update('listening_scq', $item, array('id' => $item->id));
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_listening_mcq');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $old_lid = $item->lid;
            $item->id = null;
            $item->lid = $convert['listening'][$item->lid];
            $CI->db->insert('listening_mcq', $item);
            $convert['listening_mcq'][$old_id] = $CI->db->insert_id();
            
             // copy files
            $item->id = $convert['listening_mcq'][$old_id];

            $new_name = str_replace($old_id, $item->id, $item->lsound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/mcq/' . $old_id . '/' . $item->lsound, 'data/sounds/listening/mcq/' . $new_name);
            $item->lsound = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->replay_sound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/mcq/' . $old_id . '/' . $item->replay_sound, 'data/sounds/listening/replay_sound/mcq/' . $new_name);
            $item->replay_sound = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->sentence_sound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/mcq/' . $old_id . '/' . $item->sentence_sound, 'data/sounds/listening/sentence_sound/mcq/' . $new_name);
            $item->sentence_sound = $new_name;

            $CI->db->update('listening_mcq', $item, array('id' => $item->id));
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_listening_cq');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $old_lid = $item->lid;
            $item->id = null;
            $item->lid = $convert['listening'][$item->lid];
            $CI->db->insert('listening_cq', $item);
            $convert['listening_cq'][$old_id] = $CI->db->insert_id();
            
            
             // copy files
            $item->id = $convert['listening_cq'][$old_id];

            $new_name = str_replace($old_id, $item->id, $item->lsound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/cq/' . $old_id . '/' . $item->lsound, 'data/sounds/listening/cq/' . $new_name);
            $item->lsound = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->replay_sound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/cq/' . $old_id . '/' . $item->replay_sound, 'data/sounds/listening/replay_sound/cq/' . $new_name);
            $item->replay_sound = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->sentence_sound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/cq/' . $old_id . '/' . $item->sentence_sound, 'data/sounds/listening/sentence_sound/cq/' . $new_name);
            $item->sentence_sound = $new_name;

            $CI->db->update('listening_cq', $item, array('id' => $item->id));
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_listening_cq_column');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $item->cqid = $convert['listening_cq'][$item->cqid];
            $CI->db->insert('listening_cq_column', $item);
            $convert['listening_cq_column'][$old_id] = $CI->db->insert_id();
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_listening_cq_row');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $item->id = null;
            $item->cqid = $convert['listening_cq'][$item->cqid];
            if ($item->col != 0)
                $item->col = $convert['listening_cq_column'][$item->col];
            $CI->db->insert('listening_cq_row', $item);
            $convert['listening_cq_row'][$old_id] = $CI->db->insert_id();
        }

        $CI->db->select('*');
        $CI->db->where('deleted', 0);
        $query = $CI->db->get('_listening_oq');
        $items = $query->result();
        foreach ($items as $item) {
            $old_id = $item->id;
            $old_lid = $item->lid;
            $item->id = null;
            $item->lid = $convert['listening'][$item->lid];
            $CI->db->insert('listening_oq', $item);
            $convert['listening_oq'][$old_id] = $CI->db->insert_id();
            
             // copy files
            $item->id = $convert['listening_oq'][$old_id];

            $new_name = str_replace($old_id, $item->id, $item->lsound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/oq/' . $old_id . '/' . $item->lsound, 'data/sounds/listening/oq/' . $new_name);
            $item->lsound = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->replay_sound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/oq/' . $old_id . '/' . $item->replay_sound, 'data/sounds/listening/replay_sound/oq/' . $new_name);
            $item->replay_sound = $new_name;

            $new_name = str_replace($old_id, $item->id, $item->sentence_sound);
            @copy('data/import/' . $source_test_id . '/listening/' . $old_lid . '/oq/' . $old_id . '/' . $item->sentence_sound, 'data/sounds/listening/sentence_sound/oq/' . $new_name);
            $item->sentence_sound = $new_name;

            $CI->db->update('listening_oq', $item, array('id' => $item->id));
        }
    }

}

if (!function_exists('migrate_files')) {

    function migrate_files() {
        
    }

}


    