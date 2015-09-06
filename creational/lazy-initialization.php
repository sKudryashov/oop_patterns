<?php
/**
 * Created by PhpStorm.
 * User: kudryashov
 * Date: 9/4/15
 * Time: 1:00 PM
 * In computer programming, lazy initialization is the tactic of delaying the creation of an object,
 * the calculation of a value, or some other expensive process until the first time it is needed.

This is typically accomplished by maintaining a flag indicating whether the process has taken place[citation needed].
 * Each time the desired object is summoned, the flag is tested. If it is ready, it is returned. If not, it is
 * initialized on the spot. In multithreaded code, access to the flag must be synchronized to guard
 * against a race condition.

See lazy evaluation for a general treatment of this idea. In heavily imperative languages this pattern carries hidden
 * dangers, as does any programming habit that relies on shared state.
 *
 *
 */
//In a software design pattern view, lazy initialization is often used together with a factory method pattern.
//This combines three ideas:
//Using a factory method to get instances of a class (factory method pattern)
//Store the instances in a map, so you get the same instance the next time you ask for an instance with
//same parameter (multiton pattern)
//Using lazy initialization to instantiate the object the first time it is requested (lazy initialization pattern)

header('Content-type:text/plain; charset=utf-8');

class Fruit {
    private $type;
    private static $types = array();

    private function __construct($type) {
        $this->type = $type;
    }

    public static function getFruit($type) {
        // Lazy initialization takes place here
        if (!isset(self::$types[$type])) {
            self::$types[$type] = new Fruit($type);
        }

        return self::$types[$type];
    }

    public static function printCurrentTypes() {
        echo 'Number of instances made: ' . count(self::$types) . "\n";
        foreach (array_keys(self::$types) as $key) {
            echo "$key\n";
        }
        echo "\n";
    }
}

Fruit::getFruit('Apple');
Fruit::printCurrentTypes();

Fruit::getFruit('Banana');
Fruit::printCurrentTypes();

Fruit::getFruit('Apple');
Fruit::printCurrentTypes();