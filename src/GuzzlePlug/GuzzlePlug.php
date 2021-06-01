<?php

namespace GuzzlePlug;

abstract class GuzzlePlug
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $actualResponse;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var array
     */
    protected $headers;

    public function __construct($url)
    {
        $this->url = $url;

        $this->headers = [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $config
     * @param bool $async
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request(string $method, string $url, array $config = array(), bool $async = false)
    {
        if (function_exists('logger')) {
            logger('GuzzleInterface request: ' . $url);
        }
        $client = new \GuzzleHttp\Client(array_merge($config, $this->headers));

        $start = microtime(true);
        $response = $client->request($method, $url, $config);
        if (function_exists('logger')) {
            logger('GuzzleInterface request duration: ' . round(microtime(true) - $start, 2) . ' s');
        }
        $this->actualResponse = $response;
        return json_decode($response->getBody()->getContents());
    }
}
