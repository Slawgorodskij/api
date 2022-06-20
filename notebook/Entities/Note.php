<?php

namespace App\Entities;


class Note
{
    public const TABLE_NAME = 'notes';

    public function __construct(
        int    $id = null,
        string $name = null,
        string $company = null,
        string $phone = null,
        string $email = null,
        string $birthday = null,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->company = $company;
        $this->phone = $phone;
        $this->email = $email;
        $this->birthday = $birthday;
    }

    public function __toString(): string
    {
        return sprintf(
            "[%d] %s %s %s %s",
            $this->id,
            $this->name,
            $this->company,
            $this->phone,
            $this->birthday,
        );
    }

    public function getTableName(): string
    {
        return static::TABLE_NAME;
    }
}