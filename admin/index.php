<?php
/**
 * Yet another blogging system.
 *
 * @license Apache 2.0 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Skylar Kelty <skylarkelty@gmail.com>
 */

require_once(dirname(__FILE__) . '/../config.php');

$PAGE->set_title('Beam - Admin');
$PAGE->set_url('/admin/index.php');

echo $OUTPUT->header();
echo $OUTPUT->heading();

echo $OUTPUT->footer();
