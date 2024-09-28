<?php
class DigitalProduct extends Product
{
    public $fileSize;
    public $format;

    public function __construct($id, $name, $description, $price, $category, $stock, $rating, $fileSize, $format)
    {
        parent::__construct($id, $name, $description, $price, $category, $stock, $rating);
        $this->fileSize = $fileSize;
        $this->format = $format;
    }

    public function getDeliveryDetails()
    {
        return "This product is available for download in {$this->format} format with a file size of {$this->fileSize} MB.";
    }

    public function returnPolicy()
    {
        return "Digital product return policy: Refunds are not available once the product is downloaded.";
    }
}
