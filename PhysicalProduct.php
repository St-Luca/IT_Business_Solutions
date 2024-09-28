<?php
class PhysicalProduct extends Product
{
    public $weight;
    public $height;

    public function __construct($id, $name, $description, $price, $category, $stock, $rating, $weight, $height)
    {
        parent::__construct($id, $name, $description, $price, $category, $stock, $rating);
        $this->weight = $weight;
        $this->height = $height;
    }

    public function getDeliveryDetails()
    {
        return "This product will be delivered in a package weighing {$this->weight} kg with height {$this->height}.";
    }

    public function returnPolicy()
    {
        return "Physical product return policy: You can return this product within 14 days in original packaging.";
    }
}
