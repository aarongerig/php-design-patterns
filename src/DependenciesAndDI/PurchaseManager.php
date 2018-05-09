<?php

namespace DependenciesAndDI;

class NullLog
{
    public function log($message): void
    {
    }
}

class PurchaseManager
{
    protected $purchases;
    protected $logger;

    public function __construct()
    {
        $this->logger = new NullLog();
    }

    public function purchaseDiscountedProduct(Product $product, $discountPercentage): void
    {
        $origPrice = $product->getPrice();
        $newPrice = $origPrice - (($discountPercentage / 100) * $origPrice);

        $discountedProduct = new Product($product->getName(), $newPrice);
        $this->logger->log("Applying {$discountPercentage}% discount to " . $product->getName());
        $this->purchase($discountedProduct);
    }

    public function purchase(Product $product): void
    {
        $this->purchases[] = $product;
        $log = 'Purchased ' . $product->getName() . ' for $' . $product->getPrice();
        $this->logger->log($log);
    }

    public function purchaseHistory()
    {
        return $this->purchases;
    }

    public function setLogger($logger): void
    {
        $this->logger = $logger;
    }
}