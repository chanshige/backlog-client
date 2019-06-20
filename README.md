# backlog-client

It internally uses Symfony HttpClient component.

### Usage

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Chanshige\Backlog\Factory;
use Symfony\Contracts\HttpClient\ResponseInterface;

$backlog = (new Factory)->newInstance(
    'space.backlog-uri.example',
    'your-api-key'
);

// スペース情報の取得
$space = $backlog->space();

/**
 * @see https://symfony.com/doc/current/components/http_client.html 
 * @var ResponseInterface $response 
 */
$response = $space->get();

try {
    // HTTP status code
    $statusCode = $response->getStatusCode();
    
    // Response body as a string
    $body = $response->getContent();
    
    // Response body decoded as array, typically from a JSON payload.
    $toArray = $response->toArray();
} catch (Throwable $e) {
    echo $e->getMessage();
}
```

### QA
    composer test  // run unit test with coverage
    composer cs    // fix the coding standard (dry-run)

## License
MIT

## Author

[chanshige](https://github.com/chanshige)
