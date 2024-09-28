<?php
class Admin extends User
{
    public $role = 'Admin';

    public function banUser(User $user)
    {
        echo "User {$user->name} заблокирован.";
    }

    public function addProduct(Product $product)
    {
        echo "Продукт {$product->name} добавлен.";
    }
}
