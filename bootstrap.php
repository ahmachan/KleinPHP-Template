<?php
//defines and settings
define('SITE_PATH', dirname(__FILE__));
//define('SITE_PATH', __DIR__);
date_default_timezone_set('PRC');

# Constants
define('DEBUG', TRUE);
define('APP_DIR', __DIR__.'/app');
define('VENDOR_DIR', SITE_PATH . '/vendor');
define('CACHE_DIR', APP_DIR . '/cache');
define('VIEW_DIR', APP_DIR . '/view');

// Register loaders
require_once SITE_PATH . '/vendor/autoload.php';
//require_once APP_DIR . '/loader.php';


