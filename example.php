<?php

require_once __dir__ . '/Starbucks.php';

$Starbucks = new Starbucks('__STARBUCKS_USERNAME__', '__STARBUCKS_PASSWORD__');

printf("Hello %s, you have %s stars, %s rewards and $%s on your Starbucks account. (updated: %s)\n",
	$Starbucks->customer_name, $Starbucks->stars, $Starbucks->rewards, $Starbucks->dollar_balance, $Starbucks->dollar_balance_updated
);
