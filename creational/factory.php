<?php
/**
 * Created by PhpStorm.
 * User: kudryashov
 * Date: 9/4/15
 * Time: 1:12 PM
 */
/* Factory and car interfaces */

interface CarFactory {
    public function makeCar();
}


interface Car {
    public function getType();
}

/* Concrete implementations of the factory and car */

class SedanFactory implements CarFactory {
    public function makeCar() {
        return new Sedan();
    }
}

class Sedan implements Car {
    public function getType() {
        return 'Sedan';
    }
}

/* Client */

$factory = new SedanFactory(); // it should be usually static
$car = $factory->makeCar();
print $car->getType();