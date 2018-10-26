<?php

namespace Tests\Unit\Nutrition;

use stekel\FoodDatabase\Item;
use stekel\FoodDatabase\ItemCollection;
use stekel\FoodDatabase\NutrientCollection;
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
    
    /** @test **/
    public function can_get_item_details_by_ndbno_from_the_api() {
        
        $result = Fake::usda('get_item.json')->getItem('Buttery Spread, Smart Balance');
        
        $this->assertInstanceOf(Item::class, $result);
        $this->assertInstanceOf(NutrientCollection::class, $result->nutrients);
        $this->assertEquals(10, $result->nutrients->count());
        $this->assertEquals('July, 2018', $result->releaseVersion);
        $this->assertEquals('45059792', $result->ndbno);
        $this->assertEquals('PINNACLE FOODS GROUP LLC', $result->manufacturer);
        $this->assertEquals('g', $result->reportingUnit);
        $this->assertEquals('OIL BLEND (PALM FRUIT, CANOLA, SAFFLOWER, FLAX, AND OLIVE OILS), WATER, CONTAINS LESS THAN 2% OF SALT, NATURAL FLAVOR*, PEA PROTEIN, SUNFLOWER LECITHIN, LACTIC ACID (NON-DAIRY), AND NATURALLY EXTRACTED ANNATTO (COLOR).', $result->ingredients);
        $this->assertEquals('01/15/2018', $result->ingredientsLastUpdatedAt);
    }
}