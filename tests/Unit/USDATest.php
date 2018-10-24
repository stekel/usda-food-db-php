<?php

namespace Tests\Unit\Nutrition;

use stekel\FoodDatabase\ItemCollection;
use stekel\FoodDatabase\Items;
use stekel\FoodDatabase\Tests\Stubs\Fake;
use stekel\FoodDatabase\Tests\TestCase;

class USDATest extends TestCase {

    /** @test **/
    public function can_search_the_api_for_an_item_based_on_name() {
        
        $result = Fake::usda('search.json')->search('Buttery Spread, Smart Balance');
        
        $this->assertInstanceOf(Items::class, $result);
        $this->assertInstanceOf(ItemCollection::class, $result->items);
        $this->assertEquals(12, $result->items->count());
        $this->assertEquals('Buttery Spread, Smart Balance', $result->query);
        $this->assertEquals('1', $result->releaseVersion);
        $this->assertEquals(0, $result->start);
        $this->assertEquals(12, $result->end);
        $this->assertEquals(12, $result->total);
        $this->assertEquals('', $result->foodGroup);
        $this->assertEquals('n', $result->sort);
    }
    //
    // /** @test **/
    // public function can_get_an_items_details_by_ndbno() {
    //
    //     $api = new USDA();
    //
    //     // dd($api->getItem('45059792'));
    //
    //     $this->assertArrayHasKey('foods', $api->getItem('45059792'));
    // }
    //
    // /** @test **/
    // public function can_get_a_list_of_items() {
    //
    //     $api = new USDA();
    //
    //     // dd($api->list());
    //
    //     $this->assertArrayHasKey('foods', $api->getItem('45059792'));
    // }
}