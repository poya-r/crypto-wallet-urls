# crypto-wallet-urls
This is a suggested specification to allow for URLs to be used as an alias to crypto wallets. Any feedback/suggested are welcome 

#### The Problem
Sending and receiving crypto assets currently is a scary move for anyone not used to wallet addresses and hence is a huge roadblock to mass adoption of crypto currencies.
On top of that the fact that you'd lose your money if you enter a wrong address, has all but prevent many non-technical users to even go near it.
There's been many attempts to alleviate this issue using various methods such as QR codes, easy copy/paste features, etc on most wallet softwares but it seems we still need a way for smoother transactions.

#### The Idea
What if you could share your wallet address using a web accessible URL? What if this URL could hold not just one wallet address but many wallets for different cryptocurrencies?
For example if I need to receive money from someone I could just give them my url such as `https://www.mywebsite.com/`

That address can not only hold your bitcoin address but also your ethereum, ripple or any other crypto addresses.
This can be done by adding `<meta />` tags inside any page's HTML header.

Example meta tag:

`<meta name="crypto:btc" content="<wallet address>" data-label="My BTC Wallet" />`

##### How it works:
As a user you would just enter `https://mywebsite.com` in the "Send To" field of your wallet app (if it supports this specification) and the wallet app will be able to automatically fetch the correct receiving wallet address from that url.
The app can then either input the wallet address automatically or further prompt the user to confirm.
From the developers side of things, it is very simple to implement and has absolutely no downsides for their app.
For more info see "For Developers".

To make things easier, I intend to provide basic classes in various languages to make life for developers easier.
For more info see "For Developers"

p.s. If you'd like to contribute to this, it is much appreciated.



## Specification
#### Attributes
##### `name`: 
For all crypto related meta tags we use the namespace `crpto:` followed by the currency's symbol such as `btc`. 
The `name` attribute is not case-sensitive so `crypto:btc` is same as `crpto:BTC`.
In cases of a currency having multiple symbols, you can use multiple meta tags to cover all cases such as `BTC` and `XBT` in the case of bitcoin.

Ultimately it'll be up to the community and wallet apps to support/decide what symbols will be considered valid. See "Requirements"

##### `content`:
Content attribute will hold the address itself. and should not be concatenated with any other information.

##### `data-<name>`:
Any extra meta data can be stored using `data-` attributes such as `data-label` to hold an optional Label for this wallet.
Again it's up to developers of supporting apps to decide what `data-` attributes to read.

Why `data-<name>` format? This format has been chosen in order to stay in compliance with wider HTML specifications.

#### Requirements
The adoption of this specification is ultimately dependant on wallet Apps and Websites to implement this specification. 
Doing so will certainly give their users one more way of easily and confidently send crypto using their app and hopefully benefit their app.

#### Safety
With crypto and online money transfer, there's always the issue of safety. This method is inherently safe because of safety of the https protocol.
As long as the wallets or any api adopting this specification requests the HTML content directly from the url (not through a third party library/entity), they can be sure that the data is not tampered with.

#### Fallback
So what happens if a user shares their url but other person's wallet software doesn't support wallet urls? 
In this case the could be an actual web page at the url address that visually lists the wallet addresses for the visitor along with QR codes or copy/paste features. 
So the sending person can simply type the url in any browser and manually grab the wallet address from the webpage.

#### For Developers


