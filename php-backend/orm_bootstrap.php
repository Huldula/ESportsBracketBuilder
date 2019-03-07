<?php

use Doctrine\ORM\EntityManager;
use \Doctrine\ORM\Configuration;

require_once "vendor/autoload.php";
require_once 'environment.php';

$isDevMode = true;


if ($isDevMode) {
    $cache = new \Doctrine\Common\Cache\ArrayCache;
} else {
    $cache = new \Doctrine\Common\Cache\ApcuCache();
}

$config = new Configuration();
$config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver(__DIR__ . '/src//Entities');
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);
$config->setProxyDir('/src/Proxies');
$config->setProxyNamespace('ESportsBracketBuilder\Proxies');

if ($isDevMode) {
    $config->setAutoGenerateProxyClasses(true);
} else {
    $config->setAutoGenerateProxyClasses(false);
}

$entityManager = EntityManager::create($dBConnectionParams, $config);
