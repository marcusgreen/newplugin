<?php

use local_newplugin\form\create_form;

require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir . '/formslib.php');
require_login();

$context = context_system::instance();
$url = new moodle_url('/local/newplugin/create.php');
$id = optional_param('id', 0, PARAM_INT);

$PAGE->set_context($context);
$PAGE->set_url($url);

$mform = new create_form();

if ($mform->is_cancelled()) {    
    redirect(new moodle_url('/local/newplugin/manage.php'));
} else if ($fromform = $mform->get_data()) {
    if ($fromform->id) {        
        $recordid = $fromform->id;
        $DB->update_record('np_newtable', $fromform);
    } else {        
        $recordid = $DB->insert_record('np_newtable', $fromform);
    }    
    redirect(new moodle_url('/local/newplugin/manage.php'), get_string('success'), 5);
} 

// Set data if already created.
if ($id != 0) {
    $record = $DB->get_record('np_newtable', ['id' => $id]); 
    $mform->set_data($record);
    $title = get_string('edit', 'local_newplugin');
    $PAGE->set_heading($title);
    $PAGE->set_title($title);
} else {
    $title = get_string('create', 'local_newplugin');
    $PAGE->set_heading($title);
    $PAGE->set_title($title);
}

echo $OUTPUT->header();

$mform->display();

echo $OUTPUT->footer();

