<?php

/*

* About the Flyweight
In the flyweight pattern instances of a class which are identical are shared in an implementation instead of creating a new 
instance of that class for every instance.

This is done largely to assist performance, and works best when a large number of the exact same instance of a class would
 otherwise be created.

In this example, the FlyweightBook class stores only author and title, with only three possible author title combinations being
 used by the system, and yet the system may have a large number of duplicate books.

FlyweightFactory is in charge of distributing instances of FlyweightBook, and only creates a new instance when necessary. 


* */

class FlyweightBook
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

class FlyweightFactory
{

	private $books = array ();

	function __construct()
	{
		$this->books[1] = null;
		$this->books[2] = null;
		$this->books[3] = null;
	}

	function getBook($bookKey)
	{
		if (null == $this->books[$bookKey]) {
			$makeFunction = 'makeBook'.$bookKey;
			$this->books[$bookKey] = $this->$makeFunction();
		}

		return $this->books[$bookKey];
	}

	//Sort of an long way to do this, but hopefully easy to follow.
	//How you really want to make flyweights would depend on what
	//your application needs.  This, while a little clumbsy looking,
	//does work well.
	function makeBook1()
	{
		$book = new FlyweightBook('Larry Truett', 'PHP For Cats');

		return $book;
	}

	function makeBook2()
	{
		$book = new FlyweightBook('Larry Truett', 'PHP For Dogs');

		return $book;
	}

	function makeBook3()
	{
		$book = new FlyweightBook('Larry Truett', 'PHP For Parakeets');

		return $book;
	}

}

class FlyweightBookShelf
{

	private $books = array ();

	function addBook($book)
	{
		$this->books[] = $book;
	}

	function showBooks()
	{
		$return_string = null;
		foreach ($this->books as $book) {
			$return_string .= 'title: '.$book->getAuthor().
				'  author: '.$book->getTitle();
		};

		return $return_string;
	}

}

define('BR', '<'.'BR'.'>');

echo 'BEGIN TESTING FLYWEIGHT PATTERN'.BR;
echo BR;

$flyweightFactory = new FlyweightFactory();
$flyweightBookShelf1 = new FlyweightBookShelf();
$flyweightBook1 = $flyweightFactory->getBook(1);
$flyweightBookShelf1->addBook($flyweightBook1);
$flyweightBook2 = $flyweightFactory->getBook(1);
$flyweightBookShelf1->addBook($flyweightBook2);

echo 'test 1 - show the two books are the same book'.BR;
if ($flyweightBook1 === $flyweightBook2) {
	echo '1 and 2 are the same';
} else {
	echo '1 and 2 are not the same';
}
echo BR.BR;

echo 'test 2 - with one book on one self twice'.BR;
echo $flyweightBookShelf1->showBooks();
echo BR;

$flyweightBookShelf2 = new FlyweightBookShelf();
$flyweightBook1 = $flyweightFactory->getBook(2);
$flyweightBookShelf2->addBook($flyweightBook1);
$flyweightBookShelf1->addBook($flyweightBook1);

echo 'test 3 - book shelf one'.BR;
echo $flyweightBookShelf1->showBooks();
echo BR;
echo 'test 3 - book shelf two'.BR;
echo $flyweightBookShelf2->showBooks();
echo BR.BR;

echo 'END TESTING FLYWEIGHT PATTERN'.BR;
s
?>