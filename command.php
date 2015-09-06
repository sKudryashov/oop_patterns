<?php

/*

About the Command
In the Command Pattern an object encapsulates everything needed to execute a method in another object.

In this example, a BookStarsOnCommand object is instantiated with an instance of the BookComandee class. 
The BookStarsOnCommand object will call that BookComandee object's bookStarsOn() function when it's execute() function is called. 

* */


class BookCommandee
{


    private $author;
    private $title;


    function __construct($title_in, $author_in)
    {
        $this->setAuthor($author_in);
        $this->setTitle($title_in);
    }


    function getAuthor()
    {
        return $this->author;
    }

    function setAuthor($author_in)
    {
        $this->author = $author_in;
    }


    function getTitle()
    {
        return $this->title;
    }

    function setTitle($title_in)
    {
        $this->title = $title_in;
    }


    function setStarsOn()
    {
        $this->setAuthor(Str_replace(' ', '*', $this->getAuthor()));
        $this->setTitle(Str_replace(' ', '*', $this->getTitle()));
    }


    function setStarsOff()
    {
        $this->setAuthor(Str_replace('*', ' ', $this->getAuthor()));
        $this->setTitle(Str_replace('*', ' ', $this->getTitle()));
    }


    function getAuthorAndTitle()
    {
        return $this->getTitle() . ' by ' . $this->getAuthor();
    }


}


abstract class BookCommand
{


    protected $bookCommandee;


    function __construct($bookCommandee_in)
    {
        $this->bookCommandee = $bookCommandee_in;
    }


    abstract function execute();


}


class BookStarsOnCommand extends BookCommand
{


    function execute()
    {
        $this->bookCommandee->setStarsOn();
    }


}


class BookStarsOffCommand extends BookCommand
{


    function execute()
    {
        $this->bookCommandee->setStarsOff();
    }


}


echo tagins("html");
echo tagins("head");
echo tagins("/head");
echo tagins("body");


echo "BEGIN TESTING COMMAND PATTERN";
echo tagins("br") . tagins("br");

$book =
    new BookCommandee("Design Patterns",
        "Gamma, Helm, Johnson, and Vlissides");
echo "book after creation: ";
echo tagins("br");
echo $book->getAuthorAndTitle();
echo tagins("br") . tagins("br");

$starsOn = new BookStarsOnCommand($book);
callCommand($starsOn);
echo "book after stars on: ";
echo tagins("br");
echo $book->getAuthorAndTitle();
echo tagins("br") . tagins("br");

$starsOff = new BookStarsOffCommand($book);
callCommand($starsOff);
echo "book after stars off: ";
echo tagins("br");
echo $book->getAuthorAndTitle();
echo tagins("br");


echo tagins("br");
echo "END TESTING COMMAND PATTERN";
echo tagins("br");


echo tagins("/body");
echo tagins("/html");

//the callCommand function demonstrates that a specified
//  function in BookCommandee can be executed with only
//  an instance of BookCommand.
function callCommand(BookCommand $bookCommand_in)
{
    $bookCommand_in->execute();
}


//doing this so code can be displayed without breaks
function tagins($stuffing)
{
    return "<" . $stuffing . ">";
}

?>