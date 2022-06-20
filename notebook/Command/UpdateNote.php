<?php

namespace App\Command;

use App\Repository\NoteRepository;

class UpdateNote
{
    public function updateNote($database, $id, $data)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $noteRepository = new NoteRepository();
        $note = $noteRepository->getNote($database, $id);
        if ($note) {
            $className = $note->getTableName();

            $sql = "UPDATE {$className}
                SET
                    name=:name, company=:company,
                    phone=:phone, email=:email,
                    birthday=:birthday
                WHERE id= :id";

            $name = htmlspecialchars(strip_tags($data['name']));
            $company = isset($data['company']) ? htmlspecialchars(strip_tags($data['company'])) : null;
            $phone = htmlspecialchars(strip_tags($data['phone']));
            $email = htmlspecialchars(strip_tags($data['email']));
            $birthday = isset($data['birthday']) ? htmlspecialchars(strip_tags($data['birthday'])) : null;
            $idNote = $note->id;

            $params = [
                ":name" => $name,
                ":company" => $company,
                ":phone" => $phone,
                ":email" => $email,
                ":birthday" => $birthday,
                ":id" => $idNote,
            ];


            if ($database->execute($sql, $params)) {

                http_response_code(200);
                echo json_encode(['message' => 'Данные записи обновлены.'], JSON_UNESCAPED_UNICODE);

            } else {

                http_response_code(503);
                echo json_encode(['message' => 'Данные записи не обновлены.'], JSON_UNESCAPED_UNICODE);

            }
        } else {
            http_response_code(503);
            echo json_encode(['message' => 'Нет записи для обновления.'], JSON_UNESCAPED_UNICODE);
        }
    }

}