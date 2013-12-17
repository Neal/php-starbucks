# php-starbucks

A simple class to get your Starbucks account details, including the dollar balance, date-time when it was updated, the number of stars and the number of rewards. With an API available too.

Check `example.php` for example usage.

### Example API Usage

Assuming this repo is at `http://ineal.me/starbucks/`, the API will be at `http://ineal.me/starbucks/api.php`.

	$ curl -i -X POST http://ineal.me/starbucks/api.php --data "username=__USERNAME__&password=__PASSWORD__"

	> POST /starbucks/api.php HTTP/1.1
	> Host: ineal.me
	> Accept: */*
	> Content-Length: 49
	> Content-Type: application/x-www-form-urlencoded
	>
	< HTTP/1.1 200 OK
	< Server: nginx/1.4.4
	< Date: Tue, 17 Dec 2013 06:22:28 GMT
	< Content-Type: application/json
	< Content-Length: 161
	< Transfer-Encoding: chunked
	< Content-MD5: WHwom6kZwnd+QkSUjfrM0g==
	<
	{
	    "customer_name": "Neal",
	    "stars": "42",
	    "rewards": "1",
	    "dollar_balance": "36.25",
	    "dollar_balance_datestamp": "12/16/2013 2:23:25 AM"
	}

## License

php-starbucks is available under the MIT license. See the LICENSE file for more info.
