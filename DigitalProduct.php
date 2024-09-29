<?php
class DigitalProduct extends Product
{
    public function calculateFinalPrice()
    {
        return $this->basePrice / 2;
    }
}
