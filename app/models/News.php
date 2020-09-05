<?php


namespace app\models;


class News extends AbstractModel
{

    public $id;
    public string $title;
    public string $content;
    public string $created_at;
    public string $username;
    public $image;

    protected static string $tableName = 'news';
    protected static string $primaryKey = 'id';
    protected static array $tableSchema = [
        'title' => self::DATA_TYPE_STR,
        'content' => self::DATA_TYPE_STR,
        'created_at' => self::DATA_TYPE_STR,
        'username' => self::DATA_TYPE_STR,
        'image' => self::DATA_TYPE_STR,
    ];

}