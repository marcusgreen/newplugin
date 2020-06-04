<?php

namespace local_newplugin\lib;

defined('MOODLE_INTERNAL') || die;

class manage_lib {

    public static function get_np_table_data() {
        global $DB;
        
        $records = $DB->get_records('np_newtable');

        foreach ($records as $record) { 
            if($record->duedate != 0) {
                $record->duedate = userdate($record->duedate);
            } else {
                $record->duedate = '';
            } 
        }
        return $records;
    }

    public static function delete(int $row_id) {
        global $DB;
        $DB->delete_records('np_newtable', ['id' => $row_id]);
    }
}

