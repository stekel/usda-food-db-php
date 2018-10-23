<?php

namespace Tests\Unit\Nutrition;

use App\Nutrition\USDA;
use Tests\TestCase;

class USDATest extends TestCase {

    /** @test **/
    public function can_search_the_api_for_an_item_based_on_name() {
        
        $api = new USDA();
        
        dd($api->search('Buttery Spread, Smart Balance'));
        
        $this->assertArrayHasKey('list', $api->search('Buttery Spread, Smart Balance'));
    }
    
    /** @test **/
    public function can_get_an_items_details_by_ndbno() {
        
        $api = new USDA();
        
        // dd($api->getItem('45059792'));
        
        $this->assertArrayHasKey('foods', $api->getItem('45059792'));
    }
    
    /** @test **/
    public function can_get_a_list_of_items() {
        
        $api = new USDA();
        
        dd($api->list());
        
        // $this->assertArrayHasKey('foods', $api->getItem('45059792'));
    }
}