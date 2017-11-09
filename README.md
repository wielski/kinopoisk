# /Kinopoisk
Kinopoisk protected API Laravel client
Author: [@wielski](http://telegram.me/wielski "@wielski")

## Installing
Require package using composer
```
composer require wielski/kinopoisk
```

And thats all! :rainbow: Unicorn from magicland will arrive on his own rainbow, and will install all Service Providers and Aliases.

## Using
First of all import Service using alias in the top of your class

```
<?php
...
use Kinopoisk;
```

Then just call methods like this:
```
$film = Kinopoisk::films()->getFilm(301);
```
