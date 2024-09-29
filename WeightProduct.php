<?php
class WeightProduct extends Product
{
    private $weight;

    public function __construct($name, $basePrice, $weight)
    {
        parent::__construct($name, $basePrice);
        $this->weight = $weight;
    }

    public function calculateFinalPrice()
    {
        return $this->basePrice * $this->weight;
    }
}
