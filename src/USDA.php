<?php

namespace App\Nutrition;

use GuzzleHttp\Client;

class USDA {
    
    /**
     * Search for items
     *
     * @param  string $query
     * @return array
     */
    public function search(string $query='') {
    
        $client = new Client([
            'base_uri' => 'https://api.nal.usda.gov/',
        ]);
        
        $parameters = [
            'q' => $query,
            'format' => 'json',
            'sort' => 'n',
            'max' => 50,
            'offset' => 0,
            'api_key' => config('services.usda_api.key'),
        ];
        
        $response = $client->get('/ndb/search/?'.http_build_query($parameters));
         
        return json_decode((string) $response->getBody(), true);
    }
    
    /**
     * List items
     *
     * @return array
     */
    public function list() {
    
        $client = new Client([
            'base_uri' => 'https://api.nal.usda.gov/',
        ]);
        
        $parameters = [
            'lt' => 'nr', // list type: d = derivation codes, f = food , n = all nutrients, ns = speciality nutrients, nr = standard release nutrients only,g = food group
            'format' => 'json',
            'sort' => 'n',
            'max' => 50,
            'offset' => 0,
            'api_key' => config('services.usda_api.key'),
        ];
        
        $response = $client->get('/ndb/list/?'.http_build_query($parameters));
         
        return json_decode((string) $response->getBody(), true);
    }
    
    /**
     * Get item by NBD number
     *
     * @param  string $ndbno
     * @return array
     */
    public function getItem($ndbno) {
        
        $client = new Client([
            'base_uri' => 'https://api.nal.usda.gov/',
        ]);
        
        $parameters = [
            'ndbno' => $ndbno,
            'format' => 'json',
            'type' => 'b', // [b]asic or [f]ull or [s]tats
            'api_key' => config('services.usda_api.key'),
        ];
        
        $response = $client->get('/ndb/V2/reports?'.http_build_query($parameters));
         
        return json_decode((string) $response->getBody(), true);
    }
}