<?php

namespace Occsz\OccszApi\HTTP;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class OCCSZClient implements \Occsz\OccszApi\Contracts\Request
{

    /**
     * @var GuzzleHttp\Client
     */
    private $client;

    /** @var array */
    private $config;

    /**
     * Request constructor.
     *
     * @param $options
     */
    public function __construct($options = null)
    {
        if ($options == null) {
            $this->config = config('occsz-api');
            $options = $this->config['accounts'][$this->config['accountName']];
        }
        
        $base_uri = "://{$options['userName']}:{$options['password']}@{$options['partUrl']}";

        if ($options['isHttps'] == 1)
            $base_uri = 'https'.$base_uri;
        else
            $base_uri = 'http'.$base_uri;

        $this->client = new Client([
            'base_uri' => $base_uri,
            'verify'   => false,
            'auth'     => [
                $options['userName'],
                $options['password']
            ]
        ]);
    }

    /**
     * Make a request to the OCCSZ API.
     *
     * @param $method
     * @param $uri
     * @param array $data
     *
     * @return mixed|array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $uri, $data = [])
    {
        // get the key to use for the query
        if ($method == strtoupper('GET') || $method == strtoupper('DELETE')) {
            $queryKey = 'query';
        } 

        $response = $this->client->request($method, $uri, $data);
 
        if (200 != $response->getStatusCode()) {
            throw new RequestErrorException('Error: ', $response->getStatusCode());
        }

        return $response;
    }

    /**
     * GET.
     *
     * @param $uri
     * @param array $data
     *
     * @return mixed|ResponseInterface
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($uri, $data = [])
    {
        return $this->request('GET', $uri, $data);
    }

    /**
     * POST.
     *
     * @param $uri
     * @param array $data
     *
     * @return mixed|ResponseInterface
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($uri, $data = [])
    {
        return $this->request('POST', $uri, $data);
    }

}