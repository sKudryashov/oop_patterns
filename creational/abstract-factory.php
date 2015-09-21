<?php

/*

In the Abstract Factory Pattern, an abstract factory defines what objects the non-abstract or
concrete factory will need to be
able to create.

The concrete factory must create the correct objects for it's context, insuring that all objects created by the concrete 
factory have been chosen to be able to work correctly for a given circumstance.

In this example we have an abstract factory, AbstractBookFactory, that specifies two classes, AbstractPHPBook and 
AbstractMySQLBook, which will need to be created by the concrete factory.

The concrete class OReillyBookfactory extends AbstractBookFactory, and can create the OReillyMySQLBook and 
OReillyPHPBook classes, which are the correct classes for the context of OReilly. 
*/

abstract class AbstractBookFactory
{

	abstract function makePHPBook();

	abstract function makeMySQLBook();

}

class OReillyBookFactory extends AbstractBookFactory
{
	private $context = "OReilly";

	function makePHPBook()
	{
		return new OReillyPHPBook;
	}

	function makeMySQLBook()
	{
		return new OReillyMySQLBook;
	}
}

class OReillyMySQLBook extends AbstractMySQLBook
{

	private $author;

	private $title;

	function __construct()
	{

		$this->author = 'George Reese, Randy Jay Yarger, and Tim King';
		$this->title = 'Managing and Using MySQL';

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

class SamsBookFactory extends AbstractBookFactory
{

	private $context = "Sams";

	function makePHPBook()
	{
		return new SamsPHPBook;
	}

	function makeMySQLBook()
	{
		return new SamsMySQLBook;
	}

}

abstract class AbstractBook
{

	abstract function getAuthor();

	abstract function getTitle();

}

abstract class AbstractMySQLBook
{

	private $subject = "MySQL";

}

class SamsMySQLBook extends AbstractMySQLBook
{

	private $author;

	private $title;

	function __construct()
	{

		$this->author = 'Paul Dubois';
		$this->title = 'MySQL, 3rd Edition';

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

echo tagins("html");
echo tagins("head");
echo tagins("/head");
echo tagins("body");

echo "BEGIN TESTING ABSTRACT FACTORY PATTERN";
echo tagins("br").tagins("br");

echo 'testing OReillyBookFactory'.tagins("br");
$bookFactoryInstance = new OReillyBookFactory;
testConcreteFactory($bookFactoryInstance);

echo tagins("br");

echo 'testing SamsBookFactory'.tagins("br");
$bookFactoryInstance = new SamsBookFactory;
testConcreteFactory($bookFactoryInstance);

echo tagins("br");
echo "END TESTING ABSTRACT FACTORY PATTERN";
echo tagins("br");

echo tagins("/body");
echo tagins("/html");

function testConcreteFactory($bookFactoryInstance)
{
	$phpBookOne = $bookFactoryInstance->makePHPBook();
	echo 'first php Author: '.
		$phpBookOne->getAuthor().tagins("br");
	echo 'first php Title: '.
		$phpBookOne->getTitle().tagins("br");

	$phpBookTwo = $bookFactoryInstance->makePHPBook();
	echo 'second php Author: '.
		$phpBookTwo->getAuthor().tagins("br");
	echo 'second php Title: '.
		$phpBookTwo->getTitle().tagins("br");

	$mySqlBook = $bookFactoryInstance->makeMySQLBook();
	echo 'MySQL Author: '.
		$mySqlBook->getAuthor().tagins("br");
	echo 'MySQL Title: '.
		$mySqlBook->getTitle().tagins("br");
}

//doing this so code can be displayed without breaks
function tagins($stuffing)
{
	return "<".$stuffing.">";
}

?>