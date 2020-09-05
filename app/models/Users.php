<?php


namespace app\models;


class Users extends AbstractModel
{

    public ?string $username;
    public string $password;
    public int $user_group;

    protected static string $tableName = 'users';
    protected static string $primaryKey = 'username';
    protected static array $tableSchema = [
        'username' => self::DATA_TYPE_STR,
        'password' => self::DATA_TYPE_STR,
        'user_group' => self::DATA_TYPE_INT,
    ];

}