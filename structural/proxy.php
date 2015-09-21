<?php

/*
About the Proxy
In the proxy pattern one class stands in for and handles all access to another class.

This can be because the real subject is in a different location (server, platform, etc), 
the real subject is cpu or memory intensive to create and is only created if necessary, 
or to control access to the real subject. [Design Patterns by Gamma et al p. 208 - 209] 
A proxy can also be used to add additional access functionality, such as recording the number
 of times the real subject is actually called.

In this example, the ProxyBookList is created in place of the more resource intensive BookList. 
ProxyBookList will only instantiate BookList the first time a method in BookList is called.
 *  */

class ProxyBookList
{

	private $bookList = null;

	//bookList is not instantiated at construct time
	function __construct()
	{
	}

	function getBookCount()
	{
		if (null == $this->bookList) {
			$this->makeBookList();
		}

		return $this->bookList->getBookCount();
	}

	function addBook($book)
	{
		if (null == $this->bookList) {
			$this->makeBookList();
		}

		return $this->bookList->addBook($book);
	}

	function getBook($bookNum)
	{
		if (null == $this->bookList) {
			$this->makeBookList();
		}

		return $this->bookList->getBook($bookNum);
	}

	function removeBook($book)
	{
		if (null == $this->bookList) {
			$this->makeBookList();
		}

		return $this->bookList->removeBook($book);
	}

	//Create
	function makeBookList()
	{
		$this->bookList = new bookList();
	}

}

class BookList
{

	private $books = array ();
	private $bookCount = 0;

	public function __construct()
	{
	}

	public function getBookCount()
	{
		return $this->bookCount;
	}

	private function setBookCount($newCount)
	{
		$this->bookCount = $newCount;
	}

	public function getBook($bookNumberToGet)
	{
		if ((is_numeric($bookNumberToGet)) &&
			($bookNumberToGet <= $this->getBookCount())
		) {
			return $this->books[$bookNumberToGet];
		} else {
			return null;
		}
	}

	public function addBook(Book $book_in)
	{
		$this->setBookCount($this->getBookCount() + 1);
		$this->books[$this->getBookCount()] = $book_in;

		return $this->getBookCount();
	}

	public function removeBook(Book $book_in)
	{
		$counter = 0;
		while (++$counter <= $this->getBookCount()) {
			if ($book_in->getAuthorAndTitle() ==
				$this->books[$counter]->getAuthorAndTitle()
			) {
				for ($x = $counter; $x < $this->getBookCount(); $x++) {
					$this->books[$x] = $this->books[$x + 1];
				}
				$this->setBookCount($this->getBookCount() - 1);
			}
		}

		return $this->getBookCount();
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

echo 'BEGIN TESTING PROXY PATTERN'.BR;
echo BR;

$proxyBookList = new ProxyBookList();

$inBook = new Book('PHP for Cats', 'Larry Truett');

$proxyBookList->addBook($inBook);

echo 'test 1 - show the book count after a book is added'.BR;
echo $proxyBookList->getBookCount();
echo BR.BR;

echo 'test 2 - show the book'.BR;
$outBook = $proxyBookList->getBook(1);
echo $outBook->getAuthorAndTitle();
echo BR.BR;

$proxyBookList->removeBook($outBook);

echo 'test 3 - show the book count after a book is removed'.BR;
echo $proxyBookList->getBookCount();
echo BR.BR;

echo 'END TESTING PROXY PATTERN'.BR;

?>