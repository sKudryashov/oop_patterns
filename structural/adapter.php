<?php

/*
 * 
 * 
 * About the Adapter

In the Adapter Design Pattern, a class converts the interface of one class to be what another class expects.

In this example we have a SimpleBook class that has a getAuthor() and getTitle() methods. 
The client, testAdapter.php, expects a getAuthorAndTitle() method. 
To "adapt" SimpleBook for testAdapter we have an adapter class, BookAdapter, which takes in an instance of SimpleBook, 
and uses the SimpleBook getAuthor() and getTitle() methods in it's own getAuthorAndTitle() method.

Adapters are helpful if you want to use a class that doesn't have quite the exact methods you need, and you can't
change the orignal class.
The adapter can take the methods you can access in the original class, and adapt them into the methods you need. 

* 
*  
* */

class SimpleBook
{

	private $author;
	private $title;

	function __construct($author_in, $title_in)
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

}

class BookAdapter
{

	private $book;

	function __construct(SimpleBook $book_in)
	{
		$this->book = $book_in;
	}

	function getAuthorAndTitle()
	{
		return $this->book->getTitle().' by '.$this->book->getAuthor();
	}

}

define('BR', '<'.'BR'.'>');

echo 'BEGIN TESTING ADAPTER PATTERN'.BR;
echo BR;

$book = new SimpleBook("Gamma, Helm, Johnson, and Vlissides",
	"Design Patterns");

$bookAdapter = new BookAdapter($book);

echo 'Author and Title: '.$bookAdapter->getAuthorAndTitle();

echo BR.BR;
echo 'END TESTING ADAPTER PATTERN'.BR;

?>