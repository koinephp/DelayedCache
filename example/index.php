<?php

require_once 'functions.php';

$getAction = function () {
    return isset($_REQUEST['action']) ? $_REQUEST['action'] : 'zend-cache';
};

$action = $getAction();

if ($action == 'clear-cache') {
    $clearCache();
    die('Cache cleared');
}

if ($action == 'zend-cache') {
    $result = $zendCacheResult();
}

if ($action == 'delayed-cache') {
    $result = $delayedCacheResult();
}
?>

<h1>Expansive Calculation restult: <?php echo $result ?> </h1>
<h2>Execution time: <?php echo $getExecutionTime(); ?> seconds</h2>

<ul>
    <li><a href='?action=clear-cache'>Clear cache</a></li>
    <li><a href='?action=zend-cache'>Zend Cache</a></li>
    <li><a href='?action=delayed-cache'>Delayed Cache</a></li>
</ul>
