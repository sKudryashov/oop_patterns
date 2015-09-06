<?php

class Interpreter
{

    private $bookList;


    public function __construct($bookListIn)
    {
        $this->bookList = $bookListIn;
    }


    public function interpret($stringIn)
    {

        $arrayIn = explode(" ", $stringIn);

        $returnString = null;

        //go through the array validating
        //  and if possible calling a book method
        //could use refactoring, some duplicate logic
        if ('book' == $arrayIn[0]) {
            if ('author' == $arrayIn[1]) {
                if (is_numeric($arrayIn[2])) {
                    $book = $this->bookList->getBook($arrayIn[2]);
                    if (null == $book) {
                        $returnString = 'Can not process, there is no book # ' .
                            $arrayIn[2];
                    } else {
                        $returnString = $book->getAuthor();
                    }
                } elseif ('title' == $arrayIn[2]) {
                    if (is_numeric($arrayIn[3])) {
                        $book = $this->bookList->getBook($arrayIn[3]);
                        if (null == $book) {
                            $returnString = 'Can not process, there is no book # ' .
                                $arrayIn[3];
                        } else {
                            $returnString = $book->getAuthorAndTitle();
                        }
                    } else {
                        $returnString =
                            'Can not process, book # must be numeric.';
                    }
                } else {
                    $returnString = 'Can not process, book # must be numeric.';
                }
            }
            if ('title' == $arrayIn[1]) {
                if (is_numeric($arrayIn[2])) {
                    $book = $this->bookList->getBook($arrayIn[2]);
                    if (null == $book) {
                        $returnString = 'Can not process, there is no book # ' .
                            $arrayIn[2];
                    } else {
                        $returnString = $book->getTitle();
                    }
                } else {
                    $returnString = 'Can not process, book # must be numeric.';
                }
            }
        } else {
            $returnString = 'Can not process, ' .
                'can only process book author #,  ' .
                'book title #, or book author title #';
        }

        return $returnString;
    }


}


class BookList
{

    private $books = array();
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
        return $this->getTitle() . ' by ' . $this->getAuthor();
    }


}


define('BR', '<' . 'BR' . '>');


echo 'BEGIN TESTING INTERPRETER PATTERN' . BR;
echo BR;

//load BookList for test data
$bookList = new BookList();
$inBook1 = new Book('PHP for Cats', 'Larry Truett');
$inBook2 = new Book('MySQL for Cats', 'Larry Truett');
$bookList->addBook($inBook1);
$bookList->addBook($inBook2);

$interpreter = new Interpreter($bookList);

echo 'test 1 - invalid request missing "book"' . BR;
echo $interpreter->interpret('author 1');
echo BR . BR;

echo 'test 2 - valid book author request' . BR;
echo $interpreter->interpret('book author 1');
echo BR . BR;


echo 'test 3 - valid book title request' . BR;
echo $interpreter->interpret('book title 2');
echo BR . BR;


echo 'test 4 - valid book author title request' . BR;
echo $interpreter->interpret('book author title 1');
echo BR . BR;


echo 'test 5 - invalid request with invalid book number' . BR;
echo $interpreter->interpret('book title 3');
echo BR . BR;


echo 'test 6 - invalid request with nuo numeric book number' . BR;
echo $interpreter->interpret('book title one');
echo BR . BR;


echo 'END TESTING INTERPRETER PATTERN' . BR;



?>