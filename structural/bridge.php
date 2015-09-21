<?php

/*
 * About the Bridge

In the Bridge Design Pattern, functionality abstraction and implementation are in separate class hierarchies.

In this example we have BridgeBook which uses either BridgeBookCapsImp or BridgeBookStarsImp. 
BridgeBook will assign one implementation or the other each time BridgeBook is instantiated.

The bridge pattern is helpful when you want to decouple a class from it's implementation. 

*/

abstract class BridgeBook
{

	private $bbAuthor;
	private $bbTitle;
	private $bbImp;

	function __construct($author_in, $title_in, $choice_in)
	{
		$this->bbAuthor = $author_in;
		$this->bbTitle = $title_in;
		if ('STARS' == $choice_in) {
			$this->bbImp = new BridgeBookStarsImp();
		} else {
			$this->bbImp = new BridgeBookCapsImp();
		}
	}

	function showAuthor()
	{
		return $this->bbImp->showAuthor($this->bbAuthor);
	}

	function showTitle()
	{
		return $this->bbImp->showTitle($this->bbTitle);
	}

}

class BridgeBookAuthorTitle extends BridgeBook
{

	function showAuthorTitle()
	{
		return $this->showAuthor()."'s ".$this->showTitle();
	}

}

class BridgeBookTitleAuthor extends BridgeBook
{

	function showTitleAuthor()
	{
		return $this->showTitle().' by '.$this->showAuthor();
	}

}

abstract class BridgeBookImp
{

	abstract function showAuthor($author);

	abstract function showTitle($title);

}

class BridgeBookCapsImp extends BridgeBookImp
{

	function showAuthor($author_in)
	{
		return strtoupper($author_in);
	}

	function showTitle($title_in)
	{
		return strtoupper($title_in);
	}

}

class BridgeBookStarsImp extends BridgeBookImp
{

	function showAuthor($author_in)
	{
		return Str_replace(" ", "*", $author_in);
	}

	function showTitle($title_in)
	{
		return Str_replace(" ", "*", $title_in);
	}

}

define('BR', '<'.'BR'.'>');

echo 'BEGIN TESTING BRIDGE PATTERN'.BR;
echo BR;

echo 'test 1 - author title with caps'.BR;
$book = new BridgeBookAuthorTitle('Larry Truett', 'PHP for Cats', 'CAPS');
echo $book->showAuthorTitle();
echo BR.BR;

echo 'test 2 - author title with stars'.BR;
$book = new BridgeBookAuthorTitle('Larry Truett', 'PHP for Cats', 'STARS');
echo $book->showAuthorTitle();
echo BR.BR;

echo 'test 3 - title author with caps'.BR;
$book = new BridgeBookTitleAuthor('Larry Truett', 'PHP for Cats', 'CAPS');
echo $book->showTitleAuthor();
echo BR.BR;

echo 'test 4 - title author with stars'.BR;
$book =
	new BridgeBookTitleAuthor('Larry Truett', 'PHP for Cats', 'STARS');
echo $book->showTitleAuthor();
echo BR.BR;

?>