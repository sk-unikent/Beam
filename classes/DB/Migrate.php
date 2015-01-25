<?php
/**
 * Yet another blogging system.
 *
 * @license Apache 2.0 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Skylar Kelty <skylarkelty@gmail.com>
 */

namespace Beam\DB;

class Migrate
{
    /**
     * Run migrations.
     */
    public function run() {
        global $CFG, $OUTPUT;

    	$CFG->old_version = 0;
        if (isset($CFG->version)) {
        	$OUTPUT->send("Current version: {$CFG->version}.");
        	$CFG->old_version = $CFG->version;
        }

        if (!isset($CFG->version) || $CFG->version < 2015012500) {
            $OUTPUT->send(" -> Migrating to version: 2015012500.");
            $this->migration_2015012500();
        	\Beam\Config::set('version', 2015012500);
        }

        if ($CFG->old_version != $CFG->version) {
	        $OUTPUT->send("Migrated to version: {$CFG->version}.");
	    } else {
	    	$OUTPUT->send("Nothing to do!");
	    }
    }

    /**
     * Initial table layout.
     */
    public function migration_2015012500() {
        global $DB;

        // Create config table.
        $DB->execute("
            CREATE TABLE IF NOT EXISTS {config} (
              `id` int(11) NOT NULL,
              `name` varchar(255) COLLATE utf8_unicode_ci NULL,
              `value` varchar(255) COLLATE utf8_unicode_ci NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ");

        // Indexes.
        $DB->execute("
            ALTER TABLE {config}
                ADD PRIMARY KEY (`id`),
                ADD UNIQUE KEY `name` (`name`);
        ");

        // Auto increment.
        $DB->execute("
            ALTER TABLE {config}
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        ");
    }
}
