<?php

use main\Application;


require_once $_SERVER["DOCUMENT_ROOT"]. "/main/avtoload.php";

$app = new Application();
$app->run();

?>