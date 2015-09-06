<?php

class BookReader
{

    private $title;

    private $page;

    function __construct($title_in, $page_in)
    {
        $this->setPage($page_in);
        $this->setTitle($title_in);
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page_in)
    {
        $this->page = $page_in;
    }


    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title_in)
    {
        $this->title = $title_in;
    }

}


class BookMark
{

    private $title;

    private $page;

    function __construct(BookReader $bookReader)
    {
        $this->setPage($bookReader);
        $this->setTitle($bookReader);
    }

    public function getPage(BookReader $bookReader)
    {
        $bookReader->setPage($this->page);
    }

    public function setPage(BookReader $bookReader)
    {
        $this->page = $bookReader->getPage();
    }

    public function getTitle(BookReader $bookReader)
    {
        $bookReader->setTitle($this->title);
    }

    public function setTitle(BookReader $bookReader)
    {
        $this->title = $bookReader->getTitle();
    }

}


echo tagins("html");
echo tagins("head");
echo tagins("/head");
echo tagins("body");


echo "BEGIN TESTING MEMENTO PATTERN";
echo tagins("br") . tagins("br");

$bookReader =
    new BookReader("Core PHP Programming, Third Edition", "103");
$bookMark =
    new BookMark($bookReader);

echo "(at beginning) bookReader title: " .
    $bookReader->getTitle() . tagins("br");
echo "(at beginning) bookReader page: " .
    $bookReader->getPage() . tagins("br");

$bookReader->setPage("104");
$bookMark->setPage($bookReader);

echo "(one page later) bookReader page: " .
    $bookReader->getPage() . tagins("br");

$bookReader->setPage('2005'); //oops! a typo

echo "(after typo) bookReader page: " .
    $bookReader->getPage() . tagins("br");

$bookMark->getPage($bookReader);

echo "(back to one page later) bookReader page: " .
    $bookReader->getPage() . tagins("br");


echo tagins("br");
echo "END TESTING MEMENTO PATTERN";
echo tagins("br");

echo tagins("/body");
echo tagins("/html");

//doing this so code can be displayed without breaks
function tagins($stuffing)
{
    return "<" . $stuffing . ">";
}

?>