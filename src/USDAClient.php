<?php

namespace stekel\FoodDatabase;

use GuzzleHttp\Client;

class USDAClient {
    
    /**
     * Guzzle Client
     *
     * @var Client
     */
    protected $client;
    
    /**
     * Api key
     *
     * @var string
     */
    protected $apiKey;
    
    /**
     * Constructor
     */
    public function __construct(string $apiKey, Client $client=null) {
        
        $this->apiKey = $apiKey;
        $this->client = $client ?? new Client([
            'base_uri' => 'https://api.nal.usda.gov/',
        ]);
    }
    
    /**
     * Get
     *
     * @param  string $url
     * @param  array  $parameters
     * @return array
     */
    public function get(string $url, array $parameters=[]) {
        
        $parameters['api_key'] = $this->apiKey;
        
        $response = $this->client->get($url.'?'.http_build_query($parameters));
        
        return json_decode((string) $response->getBody(), true);
    }
}