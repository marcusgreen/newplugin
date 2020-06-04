<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Plugin upgrade steps are defined here.
 *
 * @package     local_newplugin * 
 * @category    upgrade
 * @copyright   2020 Jo Beaver <myemail@example.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Execute local_newplugin upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_local_newplugin_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2020050800) {

        // Define table newtable to be created.
        $table = new xmldb_table('np_newtable');

        // Adding fields to table newtable.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $table->add_field('type', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, null);
        $table->add_field('nplevel', XMLDB_TYPE_INTEGER, '2', null, null, null, null);
        $table->add_field('duedate', XMLDB_TYPE_INTEGER, '11', null, null, null, null);

        // Adding keys to table newtable.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for newtable.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Newplugin savepoint reached.
        upgrade_plugin_savepoint(true, 2020050800, 'local', 'newplugin');
    }

    return true;
}