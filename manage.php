<?php

use local_newplugin\lib\manage_lib;

require_once(__DIR__.'/../../config.php');
require_login();

$context = context_system::instance();
$url = new moodle_url('/local/newplugin/manage.php');
$title = get_string('manage', 'local_newplugin');

$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_heading($title);
$PAGE->set_title($title);

$delete = optional_param('delete', 0, PARAM_INT);
$confirm = optional_param('confirm', 0, PARAM_INT);

echo $OUTPUT->header();

if ($delete) {
    if (!$confirm) {
        echo $OUTPUT->confirm(get_string('confirmdelete', 'local_newplugin'), 
        '?delete=' . $delete . '&confirm=1', '$delete=0&confirm=0');    
    } else {
        manage_lib::delete($delete);
        \core\notification::success(get_string('deleted'));
    }
}

$data = array_values(manage_lib::get_np_table_data());

echo $OUTPUT->render_from_template('local_newplugin/manage', ['rows' => $data]);
echo $OUTPUT->footer();

