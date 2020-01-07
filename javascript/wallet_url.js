

export function getWalletsFromUrl()
{
  const wallets = [];
  const metas = document.getElementsByTagName('meta');

  for (let i = 0; i < metas.length; i++) {
    if (metas[i].getAttribute('name')
        && metas[i].getAttribute('name').startsWith('crypto:wallet:'))
    {
      const denomination = metas[i].getAttribute('name').split(':')[1].trim().toLowerCase();
      const address = metas[i].getAttribute('content');
      const wallet = {
        denomination: denomination,
        address: address
      };

      const attrs = metas[i].getAttributeNames();
      for (let j = 0; j < attrs.length; j++) {
        if (attrs[j].startsWith('data-')) {
          const label = attrs[j].replace('data-', '');
          wallet[label] = metas[i].getAttribute(attrs[j]);
        }
      }
      wallets.push(wallet);
    }
  }
  
  return wallets;
}
