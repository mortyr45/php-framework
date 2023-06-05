<?php
// BASE CONFIG
mb_internal_encoding('utf8');
define('BASEPATH', __DIR__.DIRECTORY_SEPARATOR);

require_once BASEPATH.'library'.DIRECTORY_SEPARATOR.'load.php';

//============================================
require_once BASEPATH.'packages'.DIRECTORY_SEPARATOR.'Mustache'.DIRECTORY_SEPARATOR.'Autoloader.php';
//============================================

// EXECUTE FRAMEWORK
pmpStart();
exit;