<?php
require_once __DIR__ . '/bootstrap.php';

//require_once VENDOR_DIR.'/smarty/smarty/libs/Smarty.class.php';

// Create klein.php
$klein = new \Klein\Klein();
$service = $klein->service();

// Register Smarty
/*
$smarty = new \App\Service\SmartyService();
$smarty->setCacheDir(CACHE_DIR . '/cache');
$smarty->setCompileDir(CACHE_DIR . '/compile');
$smarty->setCaching(defined('CACHE_DIR'));
$smarty->setCachingLifetime(120);
$service->smarty = $smarty->create();
$service->smartyParams = [
		'basePath' => trim($_SERVER['REQUEST_URI'], '/'),
];
*/

// Register parameters
$service->cacheDir = CACHE_DIR;
$service->viewDir = VIEW_DIR;

$service->base64Crypt=new \SecretCrypt\Base64Crypt("wowubuntu",30);

// Register routers
(new \App\Router\PortfolioRouter())->create($klein);

// Run!
$klein->dispatch();
