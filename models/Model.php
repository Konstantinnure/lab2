<?php

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

class Model {
    private $collection;

    public function __construct() {
        $this->collection = (new MongoDB\Client())->book_library->literatures;
    }

    public function get_publishers() {
        return $this->collection->distinct('publisher');
    }

    public function get_authors() {
        return $this->collection->distinct('author');
    }

    public function get_books_by_publisher($publisher) {
        return $this->collection->find(['publisher' => $publisher])->toArray();
    }

    public function get_books_by_author($author) {
        return $this->collection->find(['author' => $author])->toArray();
    }

    public function get_literature_by_date($from, $to) {
        return $this->collection->find(
        [
            '$or' =>
            [
                [
                    'date' => ['$gte' => $from, '$lte' => $to]
                ],
                [
                    'year' => ['$gte' => intval(date('Y', strtotime($from))), '$lte' => intval(date('Y', strtotime($to)))]
                ]
            ]
        ])->toArray();
    }
}