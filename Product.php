<?php
class Product
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $category;
    public $stock;
    public $rating;

    public function __construct($id, $name, $description, $price, $category, $stock, $rating)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
        $this->stock = $stock;
        $this->rating = $rating;
    }

    public function updateStock($quantity)
    {
        $this->stock = $quantity;
    }

    public function applyDiscount($percentage)
    {
        $this->price -= $this->price * ($percentage / 100);
    }

    public function getDeliveryDetails()
    {
        return "This product will be delivered in standard packaging.";
    }

    public function returnPolicy()
    {
        return "Standard return policy: You can return the product within 30 days.";
    }
}
