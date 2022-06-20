<?php

use App\Command\CreateNote;
use App\Command\DeleteNote;
use App\Command\ReadNote;
use App\Command\ReadOneNote;
use App\Command\UpdateNote;

function controller($database, $class, $method, $data, $id)
{
    switch ($method) {
        case 'GET':
            if (isset($id)) {
                $readNote = new ReadOneNote();
                $readNote->readOneNote($database, $id);
            } else {
                $readNote = new ReadNote();
                $readNote->readNote($database, $class);
            }
            break;
        case 'POST':
            if (isset($id)) {
                $updateNote = new UpdateNote();
                $updateNote->updateNote($database, $id, $data);
            } else {
                $createNote = new CreateNote();
                $createNote->createNote($database, $data, $class);
            }
            break;
        case 'DELETE':
            if (isset($id)) {
                $deleteNote = new DeleteNote();
                $deleteNote->deleteNote($database, $id, $class);
            } else {
                http_response_code(503);
                echo json_encode(['message' => 'Запись не удалена. Необходимо выбрать запись'], JSON_UNESCAPED_UNICODE);
            }
            break;
    }
}