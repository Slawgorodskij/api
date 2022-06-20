<?php

namespace App\Command;

class ReadPaging
{
    const RANGE = 2;
    const RECORDS_PER_PAGE = 2;
    const HOME_URL = "http://localhost/api/notebook";

    public function __construct(
        private object $database,
        private object $class,
        private int    $page
    )
    {
    }

    private function getClassName()
    {
        return $this->class->getTableName();
    }

    private function fromRecordNum()
    {
        return (static::RECORDS_PER_PAGE * $this->page) - static::RECORDS_PER_PAGE;
    }

    private function count()
    {
        $sql = "SELECT COUNT(*) as total_rows FROM {$this->getClassName()}";
        $row = $this->database->queryOneObject($sql);

        return $row->total_rows;
    }

    public function allNotes()
    {
        $start = $this->fromRecordNum();
        $end = static::RECORDS_PER_PAGE;
        $sql = "SELECT * FROM {$this->getClassName()}
             ORDER BY
                name DESC
             LIMIT ?, ?";

        return $this->database->queryLimit($sql, $start, $end);
    }

    private function getPaging()
    {
        $paging_arr = [];

        $paging_arr["first"] = $this->page > 1 ? static::HOME_URL . "&page = 1" : "";

        $total_pages = ceil($this->count() / static::RECORDS_PER_PAGE);

        $range = self::RANGE;

        $initial_num = $this->page - $range;
        $condition_limit_num = ($this->page + $range) + 1;

        $paging_arr["pages"] = array();
        $page_count = 0;

        for ($i = $initial_num; $i < $condition_limit_num; $i++) {
            if (($i > 0) && ($i <= $total_pages)) {
                $paging_arr["pages"][$page_count]["page"] = $i;
                $paging_arr["pages"][$page_count]["url"] = static::HOME_URL . "&page = {$i}";
                $paging_arr["pages"][$page_count]["current_page"] = $i == $this->page ? "yes" : "no";

                $page_count++;
            }
        }

        $paging_arr["last"] = $this->page < $total_pages ? static::HOME_URL . "&page = {$total_pages}" : "";

        return $paging_arr;
    }


    public function readPaging()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $note = $this->allNotes();

        if (count($note) > 0) {

            $notes['records'] = $note;
            $notes['paging'] = $this->getPaging();

            http_response_code(200);
            echo json_encode($notes);

        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Пользователи не найдены.'], JSON_UNESCAPED_UNICODE);
        }
    }

}