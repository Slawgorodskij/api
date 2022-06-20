<?php

namespace App\Command;

use App\Repository\NoteRepository;

class DeleteNote
{
    public function deleteNote($database, $id, $class)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $className = $class->getTableName();
        $sql = "DELETE FROM {$className} WHERE id = :id";

        $params = [
            ":id" => (string)$id,
        ];

        if ($database->execute($sql, $params)) {

            http_response_code(200);
            echo json_encode(['message' => 'Запись удалена.'], JSON_UNESCAPED_UNICODE);

        } else {

            http_response_code(503);
            echo json_encode(['message' => 'Запись не удалена.'], JSON_UNESCAPED_UNICODE);

        }
    }
}