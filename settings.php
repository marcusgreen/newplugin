<?php

/**
 * Local plugin "newplugin" - settings
 * 
 * @package local_newplugin
 * @copyright Jo Beaver 2020
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $ADMIN->add('localplugins', new admin_externalpage('newplugin', get_string('pluginname', 'local_newplugin'), 
    "$CFG->wwwroot/local/newplugin/manage.php"));
}