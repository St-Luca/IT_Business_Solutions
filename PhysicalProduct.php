<?php
class PhysicalProduct extends Product
{
    private $quantity;

    public function __construct($name, $basePrice, $quantity)
    {
        parent::__construct($name, $basePrice);
        $this->quantity = $quantity;
    }

    public function calculateFinalPrice()
    {
        return $this->basePrice * $this->quantity;
    }
}
