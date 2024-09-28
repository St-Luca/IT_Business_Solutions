<?php
class Cart
{
    public $products = [];
    public $totalPrice = 0;

    public function addProduct(Product $product, $quantity)
    {
        $this->products[] = ['product' => $product, 'quantity' => $quantity];
        $this->updateTotalPrice();
    }

    public function removeProduct($productId)
    {
        foreach ($this->products as $index => $item) {
            if ($item['product']->id === $productId) {
                unset($this->products[$index]);
                break;
            }
        }
        $this->updateTotalPrice();
    }

    private function updateTotalPrice()
    {
        $this->totalPrice = 0;
        foreach ($this->products as $item) {
            $this->totalPrice += $item['product']->price * $item['quantity'];
        }
    }

    public function clearCart()
    {
        $this->products = [];
        $this->totalPrice = 0;
    }
}
