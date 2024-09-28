<h1>Coin Comparer</h1>

Coin comparer designed in Laravel 8.

You can see a working copy <a href="https://coincomparer.agustinbottos.com.ar/">here</a>.

To make it work you need to have Laravel 8 installed.

In your .env file define variable <code>CMC_API_KEY</code> with your CoinMarketCap API key.

Run the following commands inside folder:

<code>php artisan migrate --seed</code> // This will generate the coin list / User Factory with mock data <br/>
<code>php artisan make:link</code> // This will generate symlinks between public and Storage folder

Think that's all.
