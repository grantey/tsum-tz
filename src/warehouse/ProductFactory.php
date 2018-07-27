<?php

namespace App\Warehouse;

class ProductFactory
{
    public static function build($productType,  $sku, $name)
    {
        $product = 'Product' . ucfirst($productType);

        if (class_exists($product)) {
            return new $product($sku, $name);
        } else {
            throw new \Exception("Неверный тип продукта");
        }
    }
}