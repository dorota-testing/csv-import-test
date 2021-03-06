<?php
spl_autoload_register(function ($className) {
	$path = __DIR__ . '/src/' . str_replace('\\', '/', $className) . '.php';
	if (file_exists($path)) {
		require $path;
	}
});

$arrConfig = json_decode(file_get_contents('config.json'), true);
$arrConfig['mode'] =  (isset($argv[1]) && $argv[1] == 'test' ? 'test' : '');

/* echo '<pre>';
print_r($arrConfig);
echo '</pre>'; */
