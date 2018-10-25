<?php

namespace stekel\FoodDatabase;

class Item {
    
    public $releaseVersion;
    public $ndbno;
    public $name;
    public $manufacturer;
    public $reportingUnit;
    public $ingredients;
    public $ingredientsLastUpdatedAt;
    
    /**
     * Nutrients
     *
     * @var NutrientCollection
     */
    public $nutrients;
    
    /**
     * Constructor
     *
     * @param array $attributes
     */
    public function __construct(array $attributes=[]) {
        
        $this->releaseVersion = $attributes['sr'];
        $this->ndbno = $attributes['desc']['ndbno'];
        $this->name = $attributes['desc']['name'];
        $this->manufacturer = $attributes['desc']['manu'];
        $this->reportingUnit = $attributes['desc']['ru'];
        $this->ingredients = $attributes['ing']['desc'] ?? '';
        $this->ingredientsLastUpdatedAt = $attributes['ing']['upd'] ?? '';
        $this->nutrients = new NutrientCollection($attributes['nutrients'] ?? []);
    }
}