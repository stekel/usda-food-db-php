<?php

namespace stekel\FoodDatabase;

class Items {
    
    public $query;
    public $releaseVersion;
    public $start;
    public $end;
    public $total;
    public $foodGroup;
    public $sort;
    
    /**
     * Items collection
     *
     * @var Collection
     */
    public $items;
    
    /**
     * Constructor
     *
     * @param array $content
     */
    public function __construct(array $content) {
    
        $this->query = $content['q'];
        $this->releaseVersion = $content['sr'];
        $this->start = $content['start'];
        $this->end = $content['end'];
        $this->total = $content['total'];
        $this->foodGroup = $content['group'];
        $this->sort = $content['sort'];
        $this->items = new ItemCollection($content['item']);
    }
}