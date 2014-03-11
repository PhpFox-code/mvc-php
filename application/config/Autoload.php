<?php

require '/application/config/SplClassLoader.php';


$loader = new SplClassLoader('Nation', 'vendor');
$loader->register();

$loader = new SplClassLoader('App', 'application');
$loader->register();

$loader = new SplClassLoader('Controller', 'application');
$loader->register();

$loader = new SplClassLoader('Controller', 'application');
$loader->register();

$loader = new SplClassLoader('View', 'application');
$loader->register();
