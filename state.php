<?php

/*
 . PHP Design Patterns . PHP Design Patterns State
PHP Design Patterns State
About the State
In the State Pattern a class will change it's behavior when circumstances change.

In this example, the BookContext class holds an implementation of the BookTitleStateInterface,
 starting with BookTitleStateStars. BookTitleStateStars and BookTitleStateExclaim will then replace each 
other in BookContext depending on how many times they are called.
* * */


class BookContext
{

    private $book = null;
    private $bookTitleState = null;

    //bookList is not instantiated at construct time
    public function __construct($book_in)
    {
        $this->book = $book_in;
        $this->setTitleState(new BookTitleStateStars());
    }


    public function getBookTitle()
    {
        return $this->bookTitleState->showTitle($this);
    }


    public function getBook()
    {
        return $this->book;
    }


    public function setTitleState($titleState_in)
    {
        $this->bookTitleState = $titleState_in;
    }


}


interface BookTitleStateInterface
{

    public function showTitle($context_in);


}

class BookTitleStateExclaim implements BookTitleStateInterface
{

    private $titleCount = 0;

    public function showTitle($context_in)
    {
        $title = $context_in->getBook()->getTitle();
        $this->titleCount++;
        $context_in->setTitleState(new BookTitleStateStars());
        return Str_replace(' ', '!', $title);
    }
}


class BookTitleStateStars implements BookTitleStateInterface
{

    private $titleCount = 0;

    public function showTitle($context_in)
    {
        $title = $context_in->getBook()->getTitle();
        $this->titleCount++;
        if (1 < $this->titleCount) {
            $context_in->setTitleState(new BookTitleStateExclaim);
        }
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


echo 'BEGIN TESTING STATE PATTERN' . BR;
echo BR;

$book = new Book('PHP for Cats', 'Larry Truett');;

$context = new bookContext($book);

echo 'test 1 - show name' . BR;
echo $context->getBookTitle();
echo BR . BR;


echo 'test 2 - show name' . BR;
echo $context->getBookTitle();
echo BR . BR;

echo 'test 3 - show name' . BR;
echo $context->getBookTitle();
echo BR . BR;

echo 'test 4 - show name' . BR;
echo $context->getBookTitle();
echo BR . BR;


echo 'END TESTING STATE PATTERN' . BR;

?>