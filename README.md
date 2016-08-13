# SEO ID

SEO ID generation and decoding library.

Accepts a numeric ID an some additional data to combine into a "SEO-friendly" ID that it later can decode to retrieve the original ID.

Takes some inspiration from:
http://stackoverflow.com/questions/820493/can-an-seo-friendly-url-contain-a-unique-id

Create a SEO-friendly ID from a numeric ID and some random strings:

```php
\Dream\SeoID::build(123, 'Some Random NAME', 'More information'); // '123-some-random-name-more-information'
```

You can use this ID in the URL, knowing that if the user provides this URL again, you can parse the original ID:

```php
\Dream\SeoID::parse('123-some-random-name-more-information'); // 123
```
