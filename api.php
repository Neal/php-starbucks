<?php

require_once __dir__ . '/Starbucks.php';

function get_array_key($array, $key, $default = NULL) {
	return array_key_exists($key, $array) ? $array[$key] : $default;
}

$username = get_array_key($_POST, 'username');
$password = get_array_key($_POST, 'password');

if (!$username || !$password) {
	header('HTTP/1.1 400 Bad Request');
	exit();
}

$Starbucks = new Starbucks($username, $password);

if (!$Starbucks->customer_name) {
	header('HTTP/1.1 401 Unauthorized');
	exit();
}

$return_data = json_encode(array(
	'customer_name' => $Starbucks->customer_name,
	'stars' => $Starbucks->stars,
	'rewards' => $Starbucks->rewards,
	'dollar_balance' => $Starbucks->dollar_balance,
	'dollar_balance_updated' => $Starbucks->dollar_balance_updated
), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

$Starbucks->cleanup();

header('Content-MD5: ' . base64_encode(md5($return_data, true)));
header('Content-Type: application/json');
header('Content-Length: ' . strlen($return_data));

print $return_data;
