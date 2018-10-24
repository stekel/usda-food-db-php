<?php

namespace stekel\FoodDatabase\Tests\Stubs;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use stekel\FoodDatabase\USDA;
use stekel\FoodDatabase\USDAClient;

class Fake {
    
    /**
     * Build fake USDA class
     *
     * @param  string $jsonResponseFile
     * @return USDA
     */
    public static function usda(string $jsonResponseFile) {
    
        $client = new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(200, [], file_get_contents('tests/Stubs/Responses/'.$jsonResponseFile)),
            ]))
        ]);
        
        return new USDA(new USDAClient('', $client));
    }
}