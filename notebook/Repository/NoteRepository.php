<?php

namespace App\Repository;

use App\Config\Database;
use App\Entities\Note;

class NoteRepository
{
    public function getNote(Database $database, int $id): ?Note
    {
        $note = (new Note())->getTableName();

        $sql = "SELECT * FROM {$note} WHERE id = :id";
        $params = [
            ':id' => (string)$id,
        ];

        $noteData = $database->queryOneObject($sql, $params);

        if ($noteData) {
            $note = new Note(
                id: $noteData->id,
                name: $noteData->name,
                company: $noteData->company,
                phone: $noteData->phone,
                email: $noteData->email,
                birthday: $noteData->birthday,
            );

            return $note;
        }

        return null;
    }
}