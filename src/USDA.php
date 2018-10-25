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
     * @return Items
     */
    public function search(string $query='') {
        
        $result = $this->client->get('/ndb/search/', [
            'q' => $query,
            'format' => 'json',
            'sort' => 'n',
            'max' => 50,
            'offset' => 0,
        ]);
        
        return new Items($result['list']);
    }
    
    // /**
    //  * List items
    //  *
    //  * @return array
    //  */
    // public function list() {
    //
    //     $result = $this->client->get('/ndb/list/?', [
    //         'lt' => 'nr',
    //         'format' => 'json',
    //         'sort' => 'n',
    //         'max' => 50,
    //         'offset' => 0,
    //         'api_key' => config('services.usda_api.key'),
    //     ]);
    //     dd($result);
    //     return new Items($result['list']);
    // }
    
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