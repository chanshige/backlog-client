# backlog-client

It internally uses Symfony HttpClient component.

### Usage

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Chanshige\Backlog\Factory;
use Symfony\Contracts\HttpClient\ResponseInterface;

/** @var \Chanshige\Backlog\Provider\ResourceProvider $backlog */
$backlog = (new Factory)->newInstance(
    'space.backlog-uri.example',
    'your-api-key'
);

/** スペース情報の取得 [GET] **/
$space = $backlog->space();

try {
    /**
     * @var ResponseInterface $response 
     */
    $response = $space->get();

    // HTTP status code
    $statusCode = $response->getStatusCode();
    
    // Response body as a string
    $body = $response->getContent();
    
    // Response body decoded as array, typically from a JSON payload.
    $toArray = $response->toArray();
} catch (Throwable $e) {
    echo $e->getMessage();
}

/** 課題の追加 [POST] */

// POSTするパラメーターの配列を生成
$param = new \Chanshige\Backlog\Collection\ArrayList();
$param->set('projectId', 123456)
    ->set('summary', 'api_post')
    ->set('issueTypeId', 123456)
    ->set('priorityId', 3);

// withParameters メソッドにセット
$issues = $backlog->issues()->withParameters($param);

try {
    //POST request.
    $response = $issues->post();
    
    // Response body as a string
    $body = $response->getContent();
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
