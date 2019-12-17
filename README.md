# Wallet Urls for Cryptocurrencies
This is a suggested specification to allow for URLs to be used as an alias to crypto wallets. Any feedback/suggested are welcome 

#### The Problem
Sending and receiving crypto assets currently is a scary move for anyone not used to wallet addresses and hence is a huge roadblock to mass adoption of crypto currencies.
On top of that the fact that you'd lose your money if you enter a wrong address, prevents all but few non-technical users to even go near it.
There's been many attempts to alleviate this issue using various methods such as QR codes, easy copy/paste features, etc on most wallet softwares but it seems we still need a way for smoother transactions.

#### The Idea
What if you could share your wallet address using a web accessible URL? What if this URL could hold not just one wallet address but many wallets for different cryptocurrencies?
For example if I need to receive money from someone I could just give them my url such as `https://www.mywebsite.com/`

That address can not only hold your Bitcoin address but also your Ethereum, Ripple or any other crypto addresses.

This can be done by adding `<meta />` tags inside any page's HTML header.
Example meta tag:

`<meta name="crypto:btc" content="<wallet address>" data-label="My BTC Wallet" />`

#### How it works:
As a user you would just enter `https://mywebsite.com` in the "Send To" field of your wallet app (if it supports this specification) and the wallet app will be able to automatically fetch the correct receiving wallet address from that url.
The app can then either input the wallet address automatically or further prompt the user to confirm.
From the developers side of things, it is very simple to implement and has absolutely no downsides for their app. And will ultimately improve the user experience on the app.
For more info see "For Developers".

To make things easier, I intend to provide basic classes in various languages to make life for developers easier.
p.s. If you'd like to contribute to this, it is much appreciated.

#### Fallback
So what happens if a user shares their url but other person's wallet software doesn't support wallet urls? 
In this case there could be an actual web page at the url address that visually lists the wallet addresses for the visitor along with QR codes or copy/paste features. 
So the sending person can simply type the url in any browser and manually grab the wallet address from the webpage.


## For Developers
The general process of extracting wallet addresses is as follows:

1. make a `GET` call to the url to retrieve HTML code
2. parse HTML to extract all `meta` tags with `name` attribute containing `crypto:`
3. generate a list of addresses available
4. select the desired wallet address 

As a demonstration, I've included simple parsers in the `python` and `php` folders

Python snippet usage:
```python
from url_wallet import UrlWallet
wallets = UrlWallet().get_wallets_from_url(<url>)
print(wallets)
```

PHP snippet usage:
```PHP
require('UrlWallet.php');
$wallets = UrlWallet::getWalletsFromUrl(<url>);
var_dump($wallets);
```

Note:
It is strongly recommended for you to write your own parser code. 
The provided snippets are intended for reference only and might not cover all edge cases.


## Specification
As mentioned above this proposal makes the use of HTML `meta` tags and `crypto:` namespace along with attributes described below.
The `crpto:` namespace is used to avoid collisions with other meta tags and make this specification more scalable. 

#### `name` attribute: 
For all crypto related meta tags we use the namespace `crpto:` followed by the currency's symbol such as `btc`. 
The `name` attribute is not case-sensitive so `crypto:btc` is same as `crpto:BTC`.
In cases of a currency having multiple symbols, you can use multiple meta tags to cover all cases such as `BTC` and `XBT` in the case of bitcoin.

Ultimately it'll be up to the community and wallet apps to support/decide what symbols will be considered valid. See "Requirements"

#### `content` attribute:
Content attribute will hold the address itself. and should not be concatenated with any other information.

#### `data-<name>` attributes:
Any extra metadata can be stored using `data-` attributes such as `data-label` to hold an optional Label for this wallet.
Again it's up to developers of supporting apps to decide what `data-` attributes to read.

Why `data-<name>` format? This format has been chosen in order to stay in compliance with wider HTML specifications.

#### Requirements
The adoption of this specification is ultimately dependant on wallet Apps and Websites to implement this specification. 
Doing so will certainly give their users one more way of easily and confidently send crypto using their app and hopefully benefit their app.

I intend to keep an up to date list of all wallet apps that have implemented this specification to make it easier for users to find them.

#### Safety
With crypto and online money transfer, there's always the issue of safety. This method is inherently safe because of safety of the https protocol.
As long as the wallets or any api adopting this specification requests the HTML content directly from the url (not through a third party library/entity), they can be sure that the data is not tampered with.


## Contact
I by no means hold any rights to this and would like to leave it to the community to develop and grow this idea.
However I created this page as a centralized place for any discussions or feedback from the community so that we can all stay on the same page.
This will ultimately outgrow this page and evolve on its own but for the time being feel free to share your thoughts in the discussion or issues sections or reach out directly to me at:
 
 `https://poya-r.com`
 
 Also as mentioned above if you like this specification and would like to help me spread the word or add support code for new languages I encourage you to reach out.


