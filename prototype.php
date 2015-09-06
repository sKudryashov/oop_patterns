<?php

/*

About the Prototype

In the Prototype Pattern we create one standard object for each class, and clone that object to create new instances.

In this example we have an abstract BookPrototype class, with two specific or concrete subclasses, PHPBookPrototype
and SQLBookPrototype.
To create a object using either PHPBookPrototype or SQLBookPrototype we call the clone method.
*/


abstract class BookPrototype
{


    protected $title;
    protected $topic;


    abstract function __clone();


    function getTitle()
    {
        return $this->title;
    }

    function setTitle($titleIn)
    {
        $this->title = $titleIn;
    }


    function getTopic()
    {
        return $this->topic;
    }


}


class PHPBookPrototype extends BookPrototype
{


    function __construct()
    {
        $this->topic = 'PHP';
    }


    function __clone()
    {
    }


}


class SQLBookPrototype extends BookPrototype
{


    function __construct()
    {
        $this->topic = 'SQL';
    }


    function __clone()
    {
    }


}


define('BR', '<' . 'BR' . '>');


echo 'BEGIN TESTING PROTOTYPE PATTERN' . BR;
echo BR;


$phpProto = new PHPBookPrototype();
$sqlProto = new SQLBookPrototype();


$book1 = clone $sqlProto;
$book1->setTitle('SQL For Cats');
echo 'Book 1 topic: ' . $book1->getTopic() . BR;
echo 'Book 1 title: ' . $book1->getTitle() . BR;


echo BR;


$book2 = clone $phpProto;
$book2->setTitle('OReilly Learning PHP 5');
echo 'Book 2 topic: ' . $book2->getTopic() . BR;
echo 'Book 2 title: ' . $book2->getTitle() . BR;


echo BR;


$book3 = clone $sqlProto;
$book3->setTitle('OReilly Learning SQL');
echo 'Book 3 topic: ' . $book3->getTopic() . BR;
echo 'Book 3 title: ' . $book3->getTitle() . BR;


echo BR . BR;
echo 'END TESTING PROTOTYPE PATTERN' . BR;



?>