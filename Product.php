<?php
abstract class Product
{
    protected $name;
    protected $basePrice;

    public function __construct($name, $basePrice)
    {
        $this->name = $name;
        $this->basePrice = $basePrice;
    }

    abstract public function calculateFinalPrice();

    public function calculatePriceForSale($quantity)
    {
        return $this->calculateFinalPrice() * $quantity;
    }
}
