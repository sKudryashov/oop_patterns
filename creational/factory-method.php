<?php

/*
 
 About the Factory Method

In the Factory Method Pattern, a factory method defines what functions must be available in the non-abstract or concrete factory. These functions must be able to create objects that are extensions of a specific class. Which exact subclass is created will depend on the value of a parameter passed to the function.

In this example we have a factory method, AbstractFactoryMethod, that specifies the function, makePHPBook($param).

The concrete class OReillyFactoryMethod factory extends AbstractFactoryMethod, and can create the correct the extension of the AbstractPHPBook class for a given value of $param.

 */

abstract class AbstractFactoryMethod
{

	abstract function makePHPBook($param);

}

class OReillyFactoryMethod extends AbstractFactoryMethod
{
	private $context = "OReilly";

	function makePHPBook($param)
	{
		$book = null;
		switch ($param) {
			case "us":
				$book = new OReillyPHPBook;
				break;
			case "other":
				$book = new SamsPHPBook;
				break;
			default:
				$book = new OReillyPHPBook;
				break;
		}

		return $book;
	}
}

class SamsFactoryMethod extends AbstractFactoryMethod
{
	private $context = "Sams";

	function makePHPBook($param)
	{
		$book = null;
		switch ($param) {
			case "us":
				$book = new SamsPHPBook;
				break;
			case "other":
				$book = new OReillyPHPBook;
				break;
			case "otherother":
				$book = new VisualQuickstartPHPBook;
				break;
			default:
				$book = new SamsPHPBook;
				break;
		}

		return $book;
	}
}

abstract class AbstractBook
{

	abstract function getAuthor();

	abstract function getTitle();

}

abstract class AbstractPHPBook
{

	private $subject = "PHP";

}

class OReillyPHPBook extends AbstractPHPBook
{

	private $author;

	private $title;

	private static $oddOrEven = 'odd';

	function __construct()
	{
		//alternate between 2 books
		if ('odd' == self::$oddOrEven) {
			$this->author = 'Rasmus Lerdorf and Kevin Tatroe';
			$this->title = 'Programming PHP';
			self::$oddOrEven = 'even';
		} else {
			$this->author = 'David Sklar and Adam Trachtenberg';
			$this->title = 'PHP Cookbook';
			self::$oddOrEven = 'odd';
		}
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

class SamsPHPBook extends AbstractPHPBook
{

	private $author;

	private $title;

	function __construct()
	{

		//alternate randomly between 2 books

		mt_srand((double)microtime() * 10000000);
		$rand_num = mt_rand(0, 1);

		if (1 > $rand_num) {
			$this->author = 'George Schlossnagle';
			$this->title = 'Advanced PHP Programming';
		} else {
			$this->author = 'Christian Wenz';
			$this->title = 'PHP Phrasebook';
		}
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

class VisualQuickstartPHPBook extends AbstractPHPBook
{

	private $author;

	private $title;

	function __construct()
	{
		$this->author = 'Larry Ullman';
		$this->title = 'PHP for the World Wide Web';
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

echo tagins("html");
echo tagins("head");
echo tagins("/head");
echo tagins("body");

echo "BEGIN TESTING FACTORY METHOD PATTERN";
echo tagins("br").tagins("br");

echo 'testing OReillyFactoryMethod'.tagins("br");
$factoryMethodInstance = new OReillyFactoryMethod;
testFactoryMethod($factoryMethodInstance);

echo tagins("br");

echo 'testing SamsFactoryMethod'.tagins("br");
$factoryMethodInstance = new SamsFactoryMethod;
testFactoryMethod($factoryMethodInstance);

echo tagins("br");
echo "END TESTING FACTORY METHOD PATTERN";
echo tagins("br");

echo tagins("/body");
echo tagins("/html");

function testFactoryMethod($factoryMethodInstance)
{

	$phpUs = $factoryMethodInstance->makePHPBook("us");
	echo 'us php Author: '.
		$phpUs->getAuthor().tagins("br");
	echo 'us php Title: '.
		$phpUs->getTitle().tagins("br");

	$phpUs = $factoryMethodInstance->makePHPBook("other");
	echo 'other php Author: '.
		$phpUs->getAuthor().tagins("br");
	echo 'other php Title: '.
		$phpUs->getTitle().tagins("br");

	$phpUs = $factoryMethodInstance->makePHPBook("otherother");
	echo 'otherother php Author: '.
		$phpUs->getAuthor().tagins("br");
	echo 'otherother php Title: '.
		$phpUs->getTitle().tagins("br");

}

//doing this so code can be displayed without breaks
function tagins($stuffing)
{
	return "<".$stuffing.">";
}

?>