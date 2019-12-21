<?php

require('simple_html_dom.php');


/**
 * usage:
 * $wallets = UrlWallet::getWalletsFromUrl(<url>);
 **/
class UrlWallet {
	static function getWalletsFromUrl($url)
	{
		$wallets = [];
		$html = file_get_html($url);
		foreach($html->find('meta') as $element) {
			if ($element->hasAttribute('name') && $element->hasAttribute('content')) {
				$name = strtolower(trim($element->getAttribute('name')));
				$address = trim($element->getAttribute('content'));
				if (strpos($name, 'wallet:') === 0){
					$wallet['denomination'] = trim(explode(':', $name)[1]);
					$wallet['address'] = $address;

					foreach ($element->getAllAttributes() as $attr => $value) {
						if (strpos($attr, 'data-') === 0) {
							$key = str_replace('data-', '', $attr);
							$wallet[$key] = $value;
						}
					}
					$wallets[] = $wallet;
				}
			}
		}

		return $wallets;
	}
}
