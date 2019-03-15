# backlog-client

## Usage

```php
<?php
require __DIR__ . '/vendor/autoload.php';

// backlog config
$config = [
    'spaceUri' => 'space.backlog-uri.example',
    'apiKey' => 'your-api-key'
];

$backlog = (new \Chanshige\Backlog\Factory)->newInstance(
    \Chanshige\Backlog\Client::class,
    $config
);

//[GET] backlog info
$response = $backlog->space()->get();

// toArray
var_dump(json_decode($response, true));
```
