<?php


namespace app\core;


use app\core\Session;

class Authentication
{
    private static $_instance;
    private Session $_session;


    private function __construct($session)
    {
        $this->_session = $session;
    }

    public static function getInstance(Session $session)
    {
        if (self::$_instance === null) {
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }

    /**
     * this function make sure that the user has access to the admin page
     * @return bool
     */
    public function isAuthorized()
    {
        return  isset($this->_session->admin) ? true : false;
    }

}