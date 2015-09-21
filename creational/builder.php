<?php

/*
Builder

In the Builder Pattern a director and a builder work together to build an object. The director controls the building and 
specifies what parts and variations will go into an object. The builder knows how to assemble the object given specification. 

In this example we have a director, HTMLPageDirector, which is given a builder, HTMLPageBuilder. The director tells the 
builder what the pageTitle will be, what the pageHeading will be, and gives multiple lines of text for the page. The 
director then has the bulder do a final assembly of the parts, and return the page. 

Note that the html tags I use in the example code have [ and ] instead of < and > so this page will display correctly.
AbstractPageBuilder.php
//copyright Lawrence Truett and FluffyCat.com 2006, all rights reserved
*/

abstract class AbstractPageBuilder
{

	abstract function getPage();

}

abstract class AbstractPageDirector
{

	abstract function __construct(AbstractPageBuilder $builder_in);

	abstract function buildPage();

	abstract function getPage();

}

class HTMLPage
{

	private $page = null;

	private $page_title = null;
	private $page_heading = null;
	private $page_text = null;

	function __construct()
	{
	}

	function showPage()
	{
		return $this->page;
	}

	function setTitle($title_in)
	{
		$this->page_title = $title_in;
	}

	function setHeading($heading_in)
	{
		$this->page_heading = $heading_in;
	}

	function setText($text_in)
	{
		$this->page_text .= $text_in;
	}

	function formatPage()
	{
		$this->page = '[html]';
		$this->page .=
			'[head][title]'.$this->page_title.'[/title][/head]';
		$this->page .= '[body]';
		$this->page .= '[h 1]'.$this->page_heading.'[/h 1]';
		$this->page .= $this->page_text;
		$this->page .= '[/body]';
		$this->page .= '[/html]';
	}

}

class HTMLPageBuilder extends AbstractPageBuilder
{

	private $page = null;

	function __construct()
	{
		$this->page = new HTMLPage();
	}

	function setTitle($title_in)
	{
		$this->page->setTitle($title_in);
	}

	function setHeading($heading_in)
	{
		$this->page->setHeading($heading_in);
	}

	function setText($text_in)
	{
		$this->page->setText($text_in);
	}

	function formatPage()
	{
		$this->page->formatPage();
	}

	function getPage()
	{
		return $this->page;
	}

}

class HTMLPageDirector extends AbstractPageDirector
{

	private $builder = null;

	public function __construct(AbstractPageBuilder $builder_in)
	{
		$this->builder = $builder_in;
	}

	public function buildPage()
	{
		$this->builder->setTitle('Testing the HTMLPage');
		$this->builder->setHeading('Testing the HTMLPage');
		$this->builder->setText('Testing, testing, testing!');
		$this->builder->setText('Testing, testing, testing, or!');
		$this->builder->setText('Testing, testing, testing, more!');
		$this->builder->formatPage();
	}

	public function getPage()
	{
		return $this->builder->getPage();
	}

}

$bb = new HTMLPageBuilder();
$page = new HTMLPageDirector($bb);
$page->buildPage();
$bb->getPage();

//__________________________________________

?>