<?php

require __DIR__ . '/../../src/DependenciesAndDI/Product.php';
require __DIR__ . '/../../src/DependenciesAndDI/Loggr.php';
require __DIR__ . '/../../src/DependenciesAndDI/Loggr/EchoOut.php';
require __DIR__ . '/../../src/DependenciesAndDI/PurchaseManager.php';

use DependenciesAndDI\Product;
use DependenciesAndDI\PurchaseManager;
use PHPUnit\Framework\TestCase;

class PurchaseManagerTest extends TestCase
{
    public function setUp()
    {
        $this->product = new Product('Water', 5.99);
    }

    public function testCanMakePurchase(): void
    {
        $mockLogger = $this->getMockBuilder('stdClass')->setMethods(['log'])->getMock();
        $pm = new PurchaseManager();
        $pm->setLogger($mockLogger);
        $pm->purchase($this->product);

        $this->assertContains($this->product, $pm->purchaseHistory());
    }
}