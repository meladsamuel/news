<?php

namespace app\core;


/**
 * Class DatabaseHandler
 * @package app\core
 */
abstract class DatabaseHandler
{
    /**
     *
     */
    const DATABASE_DRIVER_POD = 1;
    /**
     *
     */
    const DATABASE_DRIVER_MYSQLI = 2;

    /**
     * DatabaseHandler constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return mixed
     */
    abstract protected static function init();

    /**
     * @return mixed
     */
    abstract protected static function getInstance();

    /**
     * @return mixed|PDOHandler|null
     */
    public static function factory(): ?PDOHandler
    {
        $driver = DATABASE_CONN_DRIVER;
        if ($driver == self::DATABASE_DRIVER_POD) {
            return PDOHandler::getInstance();
        } elseif ($driver == self::DATABASE_DRIVER_MYSQLI) {
            return null;// if their is another driver like(mysqli ....) you can use it
        }
        return null;
    }
}