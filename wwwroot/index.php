<?php

define("DOCROOT", realpath(__DIR__ . "/../") . DIRECTORY_SEPARATOR);
define("PKGROOT", realpath(DOCROOT. "vendor/"). DIRECTORY_SEPARATOR);
define("APPROOT", realpath(DOCROOT. "nhpcc/"). DIRECTORY_SEPARATOR);
define("WEBROOR", realpath(DOCROOT. "wwwroot/"). DIRECTORY_SEPARATOR);

require_once(PKGROOT. "autoload.php");
require_once(APPROOT. "app.php");

$app = create_app();
$app->run();
