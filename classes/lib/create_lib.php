<?php

namespace local_newplugin\lib;

defined('MOODLE_INTERNAL') || die;

class create_lib { 

    const NP_TYPES = [0 => 'choose', 1 => 'nptype:type1', 2 => 'nptype:type2', 3 => 'nptype:type3'];
    const NP_LEVELS = [1 => 'Level 1', 2 => 'Level 2', 3 => 'Level 3'];

    public static function get_np_types() {
        foreach(self::NP_TYPES as $key => $value) {
            $result[$key] = get_string($value, 'local_newplugin');
        }  
        return $result;  
    }    
}