<?php

//Goal: Represent an operation to be performed on the elements of an object structure.
// Visitor lets you define a new operation without changing the classes of the elements on which it operates.

//In the Visitor pattern, one class calls a function in another class with the current instance of itself. The called
//class has special functions for each class that can call it.
//
//In this example, the BookVisitee can call the visitBook function in any function extending the Visitor class. By doing
//this new Visitors which format the BookVisitee information can easily be added without changing the BookVisitee at all.

abstract class Visitee
{

	abstract function accept(Visitor $visitorIn);

}

class BookVisitee extends Visitee
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

	function accept(Visitor $visitorIn)
	{
		$visitorIn->visitBook($this);
	}

}

class SoftwareVisitee extends Visitee
{
	private $title;
	private $softwareCompany;
	private $softwareCompanyURL;

	function __construct(
		$title_in,
		$softwareCompany_in,
		$softwareCompanyURL_in
	) {
		$this->title = $title_in;
		$this->softwareCompany = $softwareCompany_in;
		$this->softwareCompanyURL = $softwareCompanyURL_in;
	}

	function getSoftwareCompany()
	{
		return $this->softwareCompany;
	}

	function getSoftwareCompanyURL()
	{
		return $this->softwareCompanyURL;
	}

	function getTitle()
	{
		return $this->title;
	}

	function accept(Visitor $visitorIn)
	{
		$visitorIn->visitSoftware($this);
	}
}

abstract class Visitor
{
	abstract function visitBook(BookVisitee $bookVisitee_In);

	abstract function visitSoftware(SoftwareVisitee $softwareVisitee_In);
}

class PlainDescriptionVisitor extends Visitor
{
	private $description = null;

	function getDescription()
	{
		return $this->description;
	}

	function setDescription($descriptionIn)
	{
		$this->description = $descriptionIn;
	}

	function visitBook(BookVisitee $bookVisiteeIn)
	{
		$this->setDescription(
			$bookVisiteeIn->getTitle()
			.'
. written by '.$bookVisiteeIn->getAuthor()
		);
	}

	function visitSoftware(SoftwareVisitee $softwareVisiteeIn)
	{
		$this->setDescription(
			$softwareVisiteeIn->getTitle()
			.'
.  made by '.$softwareVisiteeIn->getSoftwareCompany()
			.'
.  website at '.$softwareVisiteeIn->getSoftwareCompanyURL()
		);
	}

}

class FancyDescriptionVisitor extends Visitor
{

	private $description = null;

	function getDescription()
	{
		return $this->description;
	}

	function setDescription($descriptionIn)
	{
		$this->description = $descriptionIn;
	}

	function visitBook(BookVisitee $bookVisiteeIn)
	{
		$this->setDescription(
			$bookVisiteeIn->getTitle()
			.'
...!*@*! written !*! by !@! '.$bookVisiteeIn->getAuthor()
		);
	}

	function visitSoftware(SoftwareVisitee $softwareVisiteeIn)
	{
		$this->setDescription(
			$softwareVisiteeIn->getTitle()
			.'
...!!! made !*! by !@@! '.
			$softwareVisiteeIn->getSoftwareCompany()
			.'
...www website !**! at http://'.
			$softwareVisiteeIn->getSoftwareCompanyURL()
		);
	}

}

echo tagins("html");
echo tagins("head");
echo tagins("/head");
echo tagins("body");

echo "BEGIN TESTING VISITOR PATTERN";
echo tagins("br").tagins("br");

$book =
	new BookVisitee(
		"Design Patterns",
		"Gamma, Helm, Johnson, and Vlissides"
	);

$software =
	new SoftwareVisitee(
		"Zend Studio",
		"Zend Technologies",
		"www.Zend.com"
	);

$plainVisitor = new PlainDescriptionVisitor();

acceptVisitor($book, $plainVisitor);
echo "plain description of book: ".$plainVisitor->getDescription();
echo tagins("br");
acceptVisitor($software, $plainVisitor);
echo "plain description of software: ".$plainVisitor->getDescription();
echo tagins("br");

echo tagins("br");

$fancyVisitor = new FancyDescriptionVisitor();

acceptVisitor($book, $fancyVisitor);
echo "fancy description of book: ".$fancyVisitor->getDescription();
echo tagins("br");

acceptVisitor($software, $fancyVisitor);
echo "fancy description of software: ".$fancyVisitor->getDescription();
echo tagins("br");

echo tagins("br");
echo "END TESTING VISITOR PATTERN";
echo tagins("br");

echo tagins("/body");
echo tagins("/html");

//double dispatch any visitor and visitee objects
function acceptVisitor(Visitee $visitee_in, Visitor $visitor_in)
{
	$visitee_in->accept($visitor_in);
}

//doing this so code can be displayed without breaks
function tagins($stuffing)
{
	return "<".$stuffing.">";
}

?>