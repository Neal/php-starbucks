<?php

class Starbucks {

	private $username;
	private $password;
	private $cookies_location;

	public $customer_name;
	public $stars;
	public $rewards;
	public $dollar_balance;
	public $dollar_balance_updated;

	const TIMEOUT = 15;
	const CONNECTIONTIMEOUT = 10;

	public function __construct($username, $password, $update = true) {
		if (!extension_loaded('curl')) {
			throw new exception('PHP extension cURL is not loaded.');
		}
		$this->username = $username;
		$this->password = $password;
		$this->cookies_location = 'cookies.'.md5($username.$password);
		if ($update) $this->update();
	}

	public function cleanup() {
		file_put_contents($this->cookies_location, null);
	}

	public function update() {
		$html = $this->login();

		$this->customer_name = $this->parse_data($html, 'customer_full_name');
		$this->stars = $this->parse_data($html, 'cumulative_star_balance');
		$this->rewards = $this->parse_data($html, 'num_unredeemed_rewards');
		$this->dollar_balance = $this->parse_data($html, 'card_dollar_balance');
		$this->dollar_balance_updated = $this->parse_data($html, 'card_balance_date') . ' ' . $this->parse_data($html, 'card_balance_time');
	}

	public function login() {
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_TIMEOUT => self::TIMEOUT,
			CURLOPT_CONNECTTIMEOUT => self::CONNECTIONTIMEOUT,
			CURLOPT_COOKIE => 'acceptscookies=ok;',
			CURLOPT_COOKIEFILE => $this->cookies_location,
			CURLOPT_COOKIEJAR => $this->cookies_location,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => sprintf('Account.UserName=%s&Account.PassWord=%s', $this->username, $this->password),
			CURLOPT_URL => 'https://www.starbucks.com/account/signin'
		));
		$http_result = curl_exec($ch);
		curl_close($ch);
		return $http_result;
	}

	public function force_login() {
		$this->cleanup();
		return $this->login();
	}

	private function parse_data($html, $key) {
		$val = substr($html, strpos($html, $key.': \'') + strlen($key.': \''), strlen($html));
		$val = substr($val, 0, strpos($val, '\''));
		return $val;
	}
}
