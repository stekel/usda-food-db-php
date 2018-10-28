<?php

namespace stekel\FoodDatabase;

use stekel\FoodDatabase\Items;
use stekel\FoodDatabase\USDAClient;

class USDA {
    
    /**
     * USDA Client
     *
     * @var USDAClient
     */
    protected $client;
    
    /**
     * Constructor
     *
     * @param USDAClient $client
     */
    public function __construct(USDAClient $client) {
    
        $this->client = $client;
    }
    
    /**
     * Search for items
     *
     * @param  string $query
     * @param  array  $parameters
     * @return Items
     */
    public function search(string $query='', array $parameters=[]) {
        
        $result = $this->client->get('/ndb/search/', array_merge([
            'q' => $query,
            'format' => 'json',
            'sort' => 'r',
            'max' => 25,
        ], $parameters));
        
        return new Items($result['list']);
    }
    
    /**
     * Get item by NBD number
     *
     * @param  string $ndbno
     * @return Item
     */
    public function getItem($ndbno) {
        
        $result = $this->client->get('/ndb/V2/reports/', [
            'ndbno' => $ndbno,
            'format' => 'json',
            'type' => 'b', // [b]asic or [f]ull or [s]tats
        ]);
        
        return new Item($result['foods'][0]['food']);
    }
}