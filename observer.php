<?php
/*
About the Observer
In the Observer pattern a subject object will notify an observer object if the subject's state changes.

In this example, the PatternSubject is the subject, and the PatternObserver is the observer. For the observer to 
be notified of changes in the subject it must first be registered with the subject using the attach method. For
 the observer to no longer be notified of changes in the subject it must be unregistered with the detatch method.

When the subject changes it calls the observer's update method with itself. The observer can then take the subject
and use whatever methods have been made available for it to determine the subjects current state.

The Observer Pattern is often called Publish-Subscribe, where the subject would be the publisher, and the observer 
would be the subscriber. 

* */

/// example 1

interface Observer
{
    function notify($obj);
}

class ExchangeRate
{
    static private $instance = null;
    private $observers = array();
    private $exchange_rate;

    private function ExchangeRate()
    {
    }

    static public function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ExchangeRate();
        }
        return self::$instance;
    }

    public function getExchangeRate()
    {
        return $this->exchange_rate;
    }

    public function setExchangeRate($new_rate)
    {
        $this->exchange_rate = $new_rate;
        $this->notifyObservers();
    }

    public function registerObserver($obj)
    {
        $this->observers[] = $obj;
    }

    function notifyObservers()
    {
        foreach ($this->observers as $obj) {
            $obj->notify($this);
        }
    }
}

class ProductItem implements Observer
{

    public function __construct()
    {
        ExchangeRate::getInstance()->registerObserver($this);
    }

    public function notify($obj)
    {
        if ($obj instanceof ExchangeRate) {
            // Update exchange rate data
            print "Received update!\n";
        }
    }
}

$product1 = new ProductItem();
$product2 = new ProductItem();

ExchangeRate::getInstance()->setExchangeRate(4.5);


/// --------

// example 2


abstract class AbstractObserver
{


    abstract function update(AbstractSubject $subject_in);


}


abstract class AbstractSubject
{


    abstract function attach(AbstractObserver $observer_in);

    abstract function detach(AbstractObserver $observer_in);


    abstract function notify();


}


define('BR', '<' . 'BR' . '>');


class PatternObserver extends AbstractObserver
{


    public function __construct()
    {
    }


    public function update(AbstractSubject $subject)
    {
        echo BR . BR;
        echo '*IN PATTERN OBSERVER - NEW PATTERN GOSSIP ALERT*' . BR;
        echo ' new favorite patterns: ' . $subject->getFavorites() . BR;
        echo '*IN PATTERN OBSERVER - PATTERN GOSSIP ALERT OVER*' . BR;
    }


}


class PatternSubject extends AbstractSubject
{


    private $favoritePatterns = null;


    private $observers = array();


    function __construct()
    {
    }


    function attach(AbstractObserver $observer_in)
    {
        //could also use array_push($this->observers, $observer_in);
        $this->observers[] = $observer_in;
    }


    function detach(AbstractObserver $observer_in)
    {
        //$key = array_search($this->observers, $observer_in);
        foreach ($this->observers as $okey => $oval) {
            if ($oval == $observer_in) {
                unset($this->observers[$okey]);
            }
        }
    }


    function notify()
    {
        foreach ($this->observers as $obs) {
            $obs->update($this);
        }
    }


    function updateFavorites($newFavorites)
    {
        $this->favorites = $newFavorites;
        $this->notify();
    }


    function getFavorites()
    {
        return $this->favorites;
    }


}


define('BR', '<' . 'BR' . '>');


echo 'BEGIN TESTING OBSERVER PATTERN' . BR;
echo BR;


$patternGossiper = new PatternSubject();
$patternGossipFan = new PatternObserver();
$patternGossiper->attach($patternGossipFan);


$patternGossiper->updateFavorites(
    'abstract factory, decorator, visitor'
);


$patternGossiper->updateFavorites(
    'abstract factory, observer, decorator'
);
$patternGossiper->detach($patternGossipFan);


$patternGossiper->updateFavorites(
    'abstract factory, observer, paisley'
);


echo BR . BR;
echo 'END TESTING OBSERVER PATTERN' . BR;


?>