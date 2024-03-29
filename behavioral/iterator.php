<?php

/*
About the Iterator
In the Iterator pattern a class will be able to traverse the elements of another class.

In this example, the BookList class will have stored zero to many elements of the Book class. 
The BookListIterator can return all of the Books in the BookList one by one and in the sequential order 
that the Book elements were added to the BookList.

I also show a BookListReverseIterator. The BookListReverseIterator can return all of the Books in the BookList 
one by one and in the reverse sequential order that the Book elements were added to the BookList. This is added to 
show that custom iterators can be quite useful when you need to process a list in an sequence other than sequentially 
first to last. While this Iterator is reverse, I could have also shown an iterator that returned, for example, only odd numbered elements.

Note that the Iterators shown are not "robust", and would yield unpredicatable results if the List the Iterator is processing 
has elements removed while the Iterator is traversing the List.

* */

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

class BookListIterator
{

	protected $bookList;
	protected $currentBook = 0;

	public function __construct(BookList $bookList_in)
	{
		$this->bookList = $bookList_in;
	}

	public function getCurrentBook()
	{
		if (($this->currentBook > 0) &&
			($this->bookList->getBookCount() >= $this->currentBook)
		) {
			return $this->bookList->getBook($this->currentBook);
		}
	}

	public function getNextBook()
	{
		if ($this->hasNextBook()) {
			return $this->bookList->getBook(++$this->currentBook);
		} else {
			return null;
		}
	}

	public function hasNextBook()
	{
		if ($this->bookList->getBookCount() > $this->currentBook) {
			return true;
		} else {
			return false;
		}
	}

}

class BookListReverseIterator extends BookListIterator
{

	public function __construct(BookList $bookList_in)
	{
		$this->bookList = $bookList_in;
		$this->currentBook = $this->bookList->getBookCount() + 1;
	}

	public function getNextBook()
	{
		if ($this->hasNextBook()) {
			return $this->bookList->getBook(--$this->currentBook);
		} else {
			return null;
		}
	}

	public function hasNextBook()
	{
		if (1 < $this->currentBook) {
			return true;
		} else {
			return false;
		}
	}

}

echo tagins("html");
echo tagins("head");
echo tagins("/head");
echo tagins("body");

echo "BEGIN TESTING ITERATOR PATTERN";
echo tagins("br").tagins("br");

$firstBook =
	new Book("Core PHP Programming, Third Edition",
		"Atkinson and Suraski");
$secondBook =
	new Book("PHP Bible",
		"Converse and Park");
$thirdBook =
	new Book("Design Patterns",
		"Gamma, Helm, Johnson, and Vlissides");

$books = new BookList();
$books->addBook($firstBook);
$books->addBook($secondBook);
$books->addBook($thirdBook);

echo "Testing the Iterator".tagins("br");

$booksIterator = new BookListIterator($books);

while ($booksIterator->hasNextBook()) {
	$book = $booksIterator->getNextBook();
	echo "getting next book with iterator : ".tagins("br");
	echo $book->getAuthorAndTitle();
	echo tagins("br").tagins("br");
}

$book = $booksIterator->getCurrentBook();
echo "getting current book with iterator : ".tagins("br");
echo $book->getAuthorAndTitle();
echo tagins("br").tagins("br");

echo tagins("br");
echo "Testing the Reverse Iterator".tagins("br");

$booksReverseIterator = new BookListReverseIterator($books);

while ($booksReverseIterator->hasNextBook()) {
	$book = $booksReverseIterator->getNextBook();
	echo "getting next book with reverse iterator : ".tagins("br");
	echo $book->getAuthorAndTitle();
	echo tagins("br").tagins("br");
}

$book = $booksReverseIterator->getCurrentBook();
echo "getting current book with reverse iterator : ".tagins("br");
echo $book->getAuthorAndTitle();
echo tagins("br").tagins("br");

echo tagins("br");
echo "END TESTING ITERATOR PATTERN";
echo tagins("br");

echo tagins("/body");
echo tagins("/html");

//doing this so code can be displayed without breaks
function tagins($stuffing)
{
	return "<".$stuffing.">";
}

?>