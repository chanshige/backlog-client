# backlog-client

It internally uses Symfony HttpClient component.

## Usage

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Chanshige\Backlog\Factory;
use Symfony\Contracts\HttpClient\ResponseInterface;

$backlog = (new Factory)->newInstance(
    'space.backlog-uri.example',
    'your-api-key'
);

//[GET] backlog info
/**
 * @see https://symfony.com/doc/current/components/http_client.html 
 * @var ResponseInterface $response 
 */
$response = $backlog->space()->get();

// raw data.
var_dump($response->getContent());

// array data.
var_dump($response->toArray());
```