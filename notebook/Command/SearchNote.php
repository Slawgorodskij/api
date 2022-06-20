<?php

namespace App\Command;

use App\Config\Database;
use App\Entities\Note;

class SearchNote
{
    public function searchNote($parameter)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $database = new Database();
        $note = new Note();

        $className = $note->getTableName();

        $sql = "SELECT * FROM {$className}
            WHERE name LIKE :name 
               OR company LIKE :company 
               OR phone LIKE :phone 
               OR email LIKE :email 
               OR birthday LIKE :birthday
            ORDER BY
                name DESC";

        $keywords = htmlspecialchars(strip_tags($parameter));

        $keywords = "%{$keywords}%";

        $params = [
            ":name" => $keywords,
            ":company" => $keywords,
            ":phone" => $keywords,
            ":email" => $keywords,
            ":birthday" => $keywords,
        ];

        $note = $database->queryAll($sql, $params);

        if (count($note) > 0) {

            http_response_code(200);
            echo json_encode($note);

        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Записей нет.'], JSON_UNESCAPED_UNICODE);
        }
    }
}