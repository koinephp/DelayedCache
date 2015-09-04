<?php

require_once 'functions.php';

$getAction = function () use ($argv) {
    $action = array_pop($argv);

    if (in_array($action, ['clear-cache', 'zend-cache', 'delayed-cache'])) {
        return $action;
    }

    echo "Usage: php cli.php action\n\n";
    echo "Avaliable actions:\n";
    echo "\tclear-cache\n";
    echo "\tzend-cache\n";
    echo "\tdelayed-cache\n";
    exit(1);
};

$action = $getAction();
echo 'Executed action: ' , $getAction(), "\n";

if ($action == 'clear-cache') {
    $clearCache();
    echo("Cache cleared\n");
    return;
}

if ($action == 'zend-cache') {
    $result = $zendCacheResult();
}

if ($action == 'delayed-cache') {
    $result = $delayedCacheResult();
}

echo implode(
    "\n",
    array(
        'Result: ' . $result,
        'Execution Time: ' . $getExecutionTime(),
    )
);
