<?php
date_default_timezone_set('Europe/Paris');
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('display_errors', 1);
ini_set('memory_limit', '8096M');
set_time_limit(3600);
ini_set('error_log', APP_LOG . '/php-error.log');
ini_set('precision', 15);
