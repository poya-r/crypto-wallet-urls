import urllib.request
from html.parser import HTMLParser


class WalletUrl(object):

    def get_wallets_from_url(self, url: str):
        try:
            html = urllib.request.urlopen(url).read()
            reader = WalletUrlParser()
            reader.feed(str(html))
            return reader.get_wallet_list()
        except:
            return dict()


class WalletUrlParser(HTMLParser):

    wallets = None

    def feed(self, data):
        # clear out extracted data
        self.wallets = list()
        super().feed(data)

    def handle_starttag(self, startTag, attrs):
        if str(startTag).lower() == 'meta':
            denomination = None
            address = None
            for attr in attrs:
                if str(attr[0]).lower() == "name" and str(attr[1]).lower().startswith("wallet:"):
                    denomination = str(attr[1]).split(':')[1].strip().lower()
                if str(attr[0]).lower() == "content":
                    address = attr[1]

            if denomination and address:
                wallet = dict()
                wallet['denomination'] = denomination
                wallet['address'] = address
                for attr in attrs:
                    if str(attr[0]).strip().lower().startswith("data-"):
                        name = str(attr[0]).strip().lower().replace("data-", "").strip()
                        wallet[name] = attr[1]
                self.wallets.append(wallet)

    def get_wallet_list(self):
        return self.wallets



