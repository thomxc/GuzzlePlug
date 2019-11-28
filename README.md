### Example
```php
<?php

class Service extends GuzzlePlug\GuzzlePlug
{
    public function __construct($url = 'https://api.myservice.com')
    {
        $this->url = $url;
    }
    
    public function getRequest()
    {
        $response = $this->request('GET', $this->url);
        if ($this->actualResponse->getStatusCode() == 200) {
            return $response;
        } else {
            throw new Exception('Response status code != 200');
        }
    }
}

```