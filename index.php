<?php
define('THE_PATH', __DIR__);

//load the configuration of application
require '/application/config/config.php';

// includ the autoload script
require '/application/config/Autoload.php';

//run the application
$app = new \App\Application();
echo "App Started";
