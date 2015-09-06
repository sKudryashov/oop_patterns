<?php

/*
About the Strategy
In the Strategy Pattern a context will choose the appropriate concrete extension of a class interface.

In this example, the StrategyContext class will set a strategy of StrategyCaps, StrategyExclaim, or
StrategyStars depending on a
paramter StrategyContext receives at instantiation. When the showName() method is called in StrategyContext it
will call the showName()
 method in the Strategy that it set. 
*/


class StrategyContext
{

    private $strategy = null;

    //bookList is not instantiated at construct time
    public function __construct($strategy_ind_id)
    {
        switch ($strategy_ind_id) {
            case "C":
                $this->strategy = new StrategyCaps();
                break;
            case "E":
                $this->strategy = new StrategyExclaim();
                break;
            case "S":
                $this->strategy = new StrategyStars();
                break;
        }
    }


    public function showBookTitle($book)
    {
        return $this->strategy->showTitle($book);
    }


}


interface StrategyInterface
{

    public function showTitle($book_in);


}


class StrategyCaps implements StrategyInterface
{

    public function showTitle($book_in)
    {
        $title = $book_in->getTitle();
        $this->titleCount++;
        return strtoupper($title);
    }
}


class StrategyExclaim implements StrategyInterface
{

    public function showTitle($book_in)
    {
        $title = $book_in->getTitle();
        $this->titleCount++;
        return Str_replace(' ', '!', $title);
    }
}


class StrategyStars implements StrategyInterface
{

    public function showTitle($book_in)
    {
        $title = $book_in->getTitle();
        $this->titleCount++;
        return Str_replace(' ', '*', $title);
    }
}


class Book
{


    private $author;
    private $title;


    function __construct($title_in, $author_in)
    {
        $this->author = $author_in;
        $this->title = $title_in;
    }


    function getAuthor()
    {
        return $this->author;
    }


    function getTitle()
    {
        return $this->title;
    }


    function getAuthorAndTitle()
    {
        return $this->getTitle() . ' by ' . $this->getAuthor();
    }


}


define('BR', '<' . 'BR' . '>');


echo 'BEGIN TESTING STRATEGY PATTERN' . BR;
echo BR;

$book = new Book('PHP for Cats', 'Larry Truett');

$strategyContextC = new StrategyContext('C');
$strategyContextE = new StrategyContext('E');
$strategyContextS = new StrategyContext('S');

echo 'test 1 - show name context C' . BR;
echo $strategyContextC->showBookTitle($book);
echo BR . BR;


echo 'test 2 - show name context E' . BR;
echo $strategyContextE->showBookTitle($book);
echo BR . BR;

echo 'test 3 - show name context S' . BR;
echo $strategyContextS->showBookTitle($book);
echo BR . BR;


echo 'END TESTING STRATEGY PATTERN' . BR;

?>