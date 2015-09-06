<?php

/*
About the Composite
In the Composite pattern an idividual object or a group of that object will have similar behaviors.

In this example, the OneBook class is the individual object. The SeveralBooks class is a group of zero or more OneBook objects.

Both the OneBook and SeveralBooks can return information about the books title and author. OneBook can only return this 
information about one single book, while 
SeveralBooks will return this information one at a time about as many OneBooks as it holds.

While both classes have addBook and removeBook functions, they are only functional on SeveralBooks. OneBook will merely return FALSE when
 these functions are called.

* */


abstract class OnTheBookShelf
{


    abstract function getBookInfo($previousBook);


    abstract function getBookCount();

    abstract function setBookCount($new_count);


    abstract function addBookk($oneBook);


    abstract function removeBook($oneBook);


}


class OneBook extends OnTheBookShelf
{


    private $title;
    private $author;


    function __construct($title, $author)
    {
        $this->title = $title;
        $this->author = $author;
    }


    function getBookInfo($bookToGet)
    {
        if (1 == $bookToGet) {
            return $this->title . " by " . $this->author;
        } else {
            return false;
        }
    }


    function getBookCount()
    {
        return 1;
    }


    function setBookCount($newCount)
    {
        return false;
    }


    function addBook($oneBook)
    {
        return false;
    }


    function removeBook($oneBook)
    {
        return false;
    }


}


class SeveralBooks extends OnTheBookShelf
{


    private $oneBooks = array();
    private $bookCount;


    public function __construct()
    {
        $this->setBookCount(0);
    }


    public function getBookCount()
    {
        return $this->bookCount;
    }

    public function setBookCount($newCount)
    {
        $this->bookCount = $newCount;
    }


    public function getBookInfo($bookToGet)
    {
        if ($bookToGet <= $this->bookCount) {
            return $this->oneBooks[$bookToGet]->getBookInfo(1);
        } else {
            return false;
        }
    }


    public function addBookk($oneBook)
    {
        $this->setBookCount($this->getBookCount() + 1);
        $this->oneBooks[$this->getBookCount()] = $oneBook;
        return $this->getBookCount();
    }


    public function removeBook($oneBook)
    {
        $counter = 0;
        while (++$counter <= $this->getBookCount()) {
            if ($oneBook->getBookInfo(1) ==
                $this->oneBooks[$counter]->getBookInfo(1)
            ) {
                for ($x = $counter; $x < $this->getBookCount(); $x++) {
                    $this->oneBooks[$x] = $this->oneBooks[$x + 1];
                }
                $this->setBookCount($this->getBookCount() - 1);
            }
        }
        return $this->getBookCount();
    }


}


echo tagins("html");
echo tagins("head");
echo tagins("/head");
echo tagins("body");


echo "BEGIN TESTING COMPOSITE PATTERN";
echo tagins("br") . tagins("br");

$firstBook =
    new OneBook("Core PHP Programming, Third Edition",
        "Atkinson and Suraski");
echo "(after creating first book) oneBook info: " . tagins("br");
echo $firstBook->getBookInfo(1);
echo tagins("br") . tagins("br");

$secondBook =
    new OneBook("PHP Bible",
        "Converse and Park");
echo "(after creating second book) oneBook info: " . tagins("br");
echo $secondBook->getBookInfo(1);
echo tagins("br") . tagins("br");


$thirdBook =
    new OneBook("Design Patterns",
        "Gamma, Helm, Johnson, and Vlissides");
echo "(after creating third book) oneBook info: " . tagins("br");
echo $thirdBook->getBookInfo(1);
echo tagins("br") . tagins("br");


$books = new SeveralBooks();


$booksCount = $books->addBookk($firstBook);
echo "(after adding firstBook to books) SeveralBooks info : "
    . tagins("br");
echo $books->getBookInfo($booksCount);
echo tagins("br") . tagins("br");


$booksCount = $books->addBookk($secondBook);
echo "(after adding secondBook to books) SeveralBooks info : "
    . tagins("br");
echo $books->getBookInfo($booksCount);
echo tagins("br") . tagins("br");


$booksCount = $books->addBookk($thirdBook);
echo "(after adding thirdBook to books) SeveralBooks info : "
    . tagins("br");
echo $books->getBookInfo($booksCount);
echo tagins("br") . tagins("br");


$booksCount = $books->removeBook($firstBook);
echo "(after removing firstBook from books) SeveralBooks count : ";
echo $books->getBookCount();
echo tagins("br") . tagins("br");

echo "(after removing firstBook from books) SeveralBooks info 1 : "
    . tagins("br");
echo $books->getBookInfo(1);
echo tagins("br") . tagins("br");

echo "(after removing firstBook from books) SeveralBooks info 2 : "
    . tagins("br");
echo $books->getBookInfo(2);
echo tagins("br") . tagins("br");


echo tagins("br");
echo "END TESTING COMPOSITE PATTERN";
echo tagins("br");

echo tagins("/body");
echo tagins("/html");

//doing this so code can be displayed without breaks
function tagins($stuffing)
{
    return "<" . $stuffing . ">";
}


/*
download source, use right-click and "Save Target As..." to save with a .php extension.
output of testComposite.php

BEGIN TESTING COMPOSITE PATTERN


(after creating first book) oneBook info: 
Core PHP Programming, Third Edition by Atkinson and Suraski


(after creating second book) oneBook info: 
PHP Bible by Converse and Park


(after creating third book) oneBook info: 
Design Patterns by Gamma, Helm, Johnson, and Vlissides


(after adding firstBook to books) SeveralBooks info : 
Core PHP Programming, Third Edition by Atkinson and Suraski


(after adding secondBook to books) SeveralBooks info : 
PHP Bible by Converse and Park


(after adding thirdBook to books) SeveralBooks info : 
Design Patterns by Gamma, Helm, Johnson, and Vlissides


(after removing firstBook from books) SeveralBooks count : 2


(after removing firstBook from books) SeveralBooks info 1 : 
PHP Bible by Converse and Park


(after removing firstBook from books) SeveralBooks info 2 : 
Design Patterns by Gamma, Helm, Johnson, and Vlissides


END TESTING COMPOSITE PATTERN
*/

?>