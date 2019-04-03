# backlog-client

## Usage

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Chanshige\Backlog\Client;
use Chanshige\Backlog\Factory;

// backlog config
$config = [
    'spaceUri' => 'space.backlog-uri.example',
    'apiKey' => 'your-api-key'
];

$backlog = (new Factory)->newInstance(Client::class, $config);

//[GET] backlog info
$response = $backlog->space()->get();

// toArray
var_dump(json_decode($response, true));
```