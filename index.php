<?php
require __DIR__.'/bootstrap.php';
use Service\Container;
$container = new Container($arrConfig);
$objProductImport = $container->getProductImport();
$result = $objProductImport->processImportFile('stock.csv');


$result['report']->printReport();