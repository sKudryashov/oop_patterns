<?php

/*
About the Template
In the Template Pattern an abstract class will define a method with an algorithm, and methods which the algorithm will use. 
The methods the algorithm uses can be either required or optional. 
The optional method should by default do nothing.

The Template Pattern is unusual in that the Parent class has a lot of control.

In this example, the TemplateAbstract class has the showBookTitleInfo() method, which will call the methods getTitle() 
and getAuthor(). The method getTitle() must be overridden, while the method getAuthor() is not required.

* */

abstract class TemplateAbstract
{

	//the template method
	//  sets up a general algorithm for the whole class
	public final function showBookTitleInfo($book_in)
	{
		$title = $book_in->getTitle();
		$author = $book_in->getAuthor();
		$processedTitle = $this->processTitle($title);
		$processedAuthor = $this->processAuthor($author);
		if (null == $processedAuthor) {
			$processed_info = $processedTitle;
		} else {
			$processed_info = $processedTitle.' by '.$processedAuthor;
		}

		return $processed_info;
	}

	//the primitive operation
	//  this function must be overridded
	abstract function processTitle($title);

	//the hook operation
	//  this function may be overridden,
	//  but does nothing if it is not
	function processAuthor($author)
	{
		return null;
	}

}

class TemplateExclaim extends TemplateAbstract
{

	function processTitle($title)
	{
		return Str_replace(' ', '!!!', $title);
	}

	function processAuthor($author)
	{
		return Str_replace(' ', '!!!', $author);
	}
}

class TemplateStars extends TemplateAbstract
{

	function processTitle($title)
	{
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
		return $this->getTitle().' by '.$this->getAuthor();
	}

}

define('BR', '<'.'BR'.'>');

echo 'BEGIN TESTING TEMPLATE PATTERN'.BR;
echo BR;

$book = new Book('PHP for Cats', 'Larry Truett');

$exclaimTemplate = new TemplateExclaim();
$starsTemplate = new TemplateStars();

echo 'test 1 - show exclaim template'.BR;
echo $exclaimTemplate->showBookTitleInfo($book);
echo BR.BR;

echo 'test 2 - show stars template'.BR;
echo $starsTemplate->showBookTitleInfo($book);
echo BR.BR;

echo 'END TESTING TEMPLATE PATTERN'.BR;

?>