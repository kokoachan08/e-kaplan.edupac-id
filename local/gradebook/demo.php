<?php
// This file is part of Moodle - http://moodle.org/
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
//
// @author Daniel Tome <danieltomefer@gmail.com>.

require_once('../../config.php');
require_once($CFG->dirroot . '/grade/lib.php');
require_once($CFG->dirroot . '/grade/edit/tree/lib.php');
require_once($CFG->dirroot . '/local/' . local_gradebook\Constants::PLUGIN_NAME . '/lib.php');
require_once($CFG->dirroot . '/local/' . local_gradebook\Constants::PLUGIN_NAME . '/locallib.php');

$courseid = required_param('id', PARAM_INT);

// Make sure they can even access this course
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('nocourseid');
}

require_login($course);
$context = context_course::instance($course->id);

$url = new moodle_url('/local/gradebook/demo.php', array('id' => $courseid));
$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');
$PAGE->add_body_class('path-grade-edit-tree');
$PAGE->set_title(get_string('pluginname', 'local_gradebook'));
$PAGE->requires->js('/local/gradebook/js/demo.js');
$PAGE->requires->js_call_amd('local_gradebook/democalc', 'initialise');

// return tracking object
$gpr = new grade_plugin_return(array('type' => 'edit', 'plugin' => 'tree', 'courseid' => $courseid));
$returnurl = $gpr->get_return_url(null);

// get the grading tree object
// note: total must be first for moving to work correctly, if you want it last moving code must be rewritten!
// get the grading tree object
// note: total must be first for moving to work correctly, if you want it last moving code must be rewritten!
$gtree = new grade_tree($courseid, false, false);

$strgrades = get_string('grades');
$strgraderreport = get_string('graderreport', 'grades');

$gradeedittree = new local_gradebook\grade\tree\GradebookDemoTree($gtree, false, $gpr);

$output = $PAGE->get_renderer('local_gradebook');

echo $output->header();

echo $OUTPUT->box_start('gradetreebox generalbox');
echo html_writer::start_tag('form', ['id' => 'gradetreeform']);
echo html_writer::start_div();
echo html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'sesskey', 'value' => sesskey()]);
echo html_writer::table($gradeedittree->table);
echo html_writer::end_div();
echo html_writer::end_tag('form');
echo $OUTPUT->box_end();
echo $output->build_parameters_to_send_by_ajax($courseid);
echo $output->get_demo_buttons();

echo $output->footer();
