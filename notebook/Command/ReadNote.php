<?php

namespace App\Command;

use App\Entities\Note;
use PDO;

class ReadNote
{
    public function readNote($database, $class)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $className = $class->getTableName();
        $sql = "SELECT * FROM {$className}";
        $note = $database->queryAll($sql);

        if (count($note) > 0) {

            http_response_code(200);
            echo json_encode($note);

        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Записей нет.'], JSON_UNESCAPED_UNICODE);
        }
    }
}