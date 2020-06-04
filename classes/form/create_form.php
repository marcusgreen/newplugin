<?php

namespace local_newplugin\form;

use moodleform;
use local_newplugin\lib\create_lib;

defined('MOODLE_INTERNAL') || die;

class create_form extends moodleform 
{
    public function definition() {

        $mform = $this->_form;

        $createintro = '<p>' . get_string('createintro', 'local_newplugin') . '</p>';
        $nptypes = create_lib::get_np_types();
        
        // Intoduction.
        $mform->addElement('html', $createintro);

        // Main form fields.
        $mform->addElement('hidden', 'id', 0);
        $mform->setType('id', PARAM_INT);

        $mform->addElement('text', 'name', get_string('name', 'local_newplugin'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', get_string('required'), 'required'); 

        $mform->addElement('select', 'type', get_string('type', 'local_newplugin'), $nptypes);
        $mform->setType('type', PARAM_ALPHANUM);
        $mform->addRule('type', get_string('required'), 'required'); 
        $mform->addRule('type', get_string('required'), 'nonzero');

        $mform->addElement('select', 'nplevel', get_string('level', 'local_newplugin'), [0 => get_string('choose')] + create_lib::NP_LEVELS);
        
        $mform->addElement('date_selector', 'duedate', get_string('duedate', 'local_newplugin'), array('optional' => true));   
        
        // Action buttons.
        $this->add_action_buttons();
    } 
}