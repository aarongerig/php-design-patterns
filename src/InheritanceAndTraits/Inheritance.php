<?php

namespace InheritanceAndTraits;

require __DIR__ . '/../TablePrinter.php';

// Classes
class A
{
    public $setting = 'nope';
    public $anotherSetting = 'nope';

    public function __construct()
    {
        $this->setting = $this->anotherSetting = 'yep';
    }

    public function aGenericMethod(): int
    {
        return 42;
    }
}

class B extends A
{
    public function __construct()
    {
        $this->setting = 'yep';
    }

    public function doSomething(): string
    {
        return 'Did Something';
    }

    public function doSomethingElse(): string
    {
        return 'Did Something Else';
    }
}

class C extends B
{
    public function __construct()
    {
        parent::__construct();
        $this->anotherSetting = 'tacos';
    }

    public function doSomething(): string
    {
        return 'Something';
    }

    public function aGenericMethod(): int
    {
        return 9000;
    }

    public function mixItUp(): string
    {
        return parent::aGenericMethod() . ' ' . parent::doSomething() . ' ' . $this->doSomething();
    }
}

// Instantiation of classes
$a = new A();
$b = new B();
$c = new C();

// Print Method => Result
$p = new \TablePrinter(['Method', 'Result']);
$p->addRow('A::aGenericMethod()', $a->aGenericMethod());
$p->addRow('B::aGenericMethod()', $b->aGenericMethod());
$p->addRow('C::aGenericMethod()', $c->aGenericMethod());
$p->addRow('B::doSomething()', $b->doSomething());
$p->addRow('C::doSomething()', $c->doSomething());
$p->addRow('C::mixItUp()', $c->mixItUp());
$p->output();
echo "\n\n";

// Print Class => setting => anotherSetting
$p = new \TablePrinter(['Class', 'setting', 'anotherSetting']);
$p->addRow('A', print_r($a->setting, true), print_r($a->anotherSetting, true));
$p->addRow('B', print_r($b->setting, true), print_r($b->anotherSetting, true));
$p->addRow('C', print_r($c->setting, true), print_r($c->anotherSetting, true));
$p->output();
