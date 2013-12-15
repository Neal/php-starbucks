<?php

require_once __dir__ . '/Starbucks.php';

$Starbucks = new Starbucks('__STARBUCKS_USERNAME__', '__STARBUCKS_PASSWORD__');

$Starbucks->update();

printf("Hello %s, you have %s stars and $%s on your Starbucks account. (updated: %s)\n",
	$Starbucks->customer_name, $Starbucks->star_balance, $Starbucks->dollar_balance, $Starbucks->dollar_balance_datestamp
);
