<?php

/*

Copyright:: 2013, Sebastian Grewe

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

 */

// MODIFY THIS
// We need to find our include files so set this properly
define("BASEPATH", "../public/");


/*****************************************************
 * No need to change beyond this point               *
 *****************************************************/
// Our cron name
$cron_name = basename($_SERVER['PHP_SELF'], '.php');

// Our security check
define("SECURITY", 1);

// Include our configuration (holding defines for the requires)
require_once(BASEPATH . 'include/config/global.inc.php');

// We include all needed files here, even though our templates could load them themself
require_once(INCLUDE_DIR . '/autoloader.inc.php');

// Load 3rd party logging library for running crons
$log = new KLogger ( 'logs/' . $cron_name . '.txt' , KLogger::INFO );
$log->LogDebug('Starting ' . $cron_name);

// Load the start time for later runtime calculations for monitoring
$cron_start[$cron_name] = microtime(true);

// Mark cron as running for monitoring
$log->logDebug('Marking cronjob as running for monitoring');
$monitoring->setStatus($cron_name . '_active', 'yesno', 1);
$monitoring->setStatus($cron_name . '_starttime', 'date', time());
?>
