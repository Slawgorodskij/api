<?php

namespace App\Command;

class CreateNote
{
    public function createNote($database, $data, $class)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        if (!empty($data['name']) &&
            !empty($data['phone']) &&
            !empty($data['email'])
        ) {

            $className = $class->getTableName();
            $sql = "INSERT INTO {$className}
                SET
                    name=:name, company=:company,
                    phone=:phone, email=:email,
                    birthday=:birthday";

            $name = htmlspecialchars(strip_tags($data['name']));
            $company = isset($data['company']) ? htmlspecialchars(strip_tags($data['company'])) : '';
            $phone = htmlspecialchars(strip_tags($data['phone']));
            $email = htmlspecialchars(strip_tags($data['email']));
            $birthday = isset($data['birthday']) ? htmlspecialchars(strip_tags($data['birthday'])) : '';

            $params = [
                ":name" => $name,
                ":company" => $company,
                ":phone" => $phone,
                ":email" => $email,
                ":birthday" => $birthday,
            ];


            if ($database->execute($sql, $params)) {

                http_response_code(201);
                echo json_encode(['message' => 'Запись внесена.'], JSON_UNESCAPED_UNICODE);

            } else {

                http_response_code(503);
                echo json_encode(['message' => 'Запись не внесена.'], JSON_UNESCAPED_UNICODE);

            }
        } else {

            http_response_code(400);
            echo json_encode(['message' => 'Запись не внесена. Данные не полные'], JSON_UNESCAPED_UNICODE);

        }
    }
}