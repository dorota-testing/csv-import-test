<?php
require __DIR__.'/bootstrap.php';
use Service\Container;
$container = new Container($arrConfig);
$objUserHandler = $container->getUserHandler();
$arrAllUsers = $objUserHandler->get_users();

echo '<pre>';
print_r($arrAllUsers);
echo '</pre>';

