<?php

require('simple_html_dom.php');

class UrlWallet {
	static function getWalletsFromUrl($url)
	{
		$wallets = [];
//		$html_string = self::getHtml($url);
		$html = file_get_html($url);
		foreach($html->find('meta') as $element) {
			if ($element->hasAttribute('name') && $element->hasAttribute('content')) {
				$denomination = strtolower(trim($element->getAttribute('name')));
				$address = trim($element->getAttribute('content'));
				if (strpos($denomination, 'crypto:') === 0){
					$wallet['denomination'] = trim(str_replace('crypto:', '', $denomination));
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

var_dump(UrlWallet::processUrl("http://bittrail.me/p/popo"));
