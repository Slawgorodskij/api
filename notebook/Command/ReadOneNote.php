<?php

namespace App\Command;

use App\Repository\NoteRepository;

class ReadOneNote
{
    public function readOneNote($database, $id)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        $noteRepository = new NoteRepository();
        $note = $noteRepository->getNote($database, $id);

        if (isset($note)) {
            http_response_code(200);
            echo json_encode($note);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Записей нет.'], JSON_UNESCAPED_UNICODE);
        }
    }
}