<?php


namespace app\core;


class Session extends \SessionHandler
{
    private $sessionName = 'News';
    private int $sessionMaxLifeTime = 0;
    private bool $sessionSSL = false; //TODO change to turn when using https or have SSL
    private bool $sessionHTTPOnly = true;
    private string $sessionPath = '/';
    private ?string $sessionDomain = null; //TODO you can set specific domain
    private string $sessionSavePath = SESSION_PATH;
    private string $sessionCipherAlgo = 'AES-128-ECB';
    private string $sessionCipherKey = 'this_is_the_secrete_key';
    private int $sessionTTL = 1;
    private int $sessionStartTime;
    /**
     * @var false|string
     */
    private string $cipherKey;
    /**
     * @var string
     */
    private string $fingerPrint;


    /**
     * Session constructor.
     */
    public function __construct()
    {
        ini_set('session.use_cookies', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.use_trans_sid', 0);
        ini_set('session.save_handler', 'files');

        session_name($this->sessionName);
        session_save_path($this->sessionSavePath);
        session_set_cookie_params(
            $this->sessionMaxLifeTime,
            $this->sessionPath,
            $this->sessionDomain,
            $this->sessionSSL,
            $this->sessionHTTPOnly
        );

    }

    /**
     * the function set the new key and value for the session
     * @param $name string : The name of the key inside the session file
     * @param $value : the value of the key that inside the session file
     */
    public function __set(string $name,  $value): void
    {
        $_SESSION[$name] = $value;
    }

    /**
     * this function get the value of the key in the session
     * @param $name string : the name of the key in the session
     * @return bool|mixed : return the session value if exit or return false if not exit
     */
    public function __get(string $name)
    {
        return $_SESSION[$name] !== false ? $_SESSION[$name] : false;
    }

    /**
     * this function check the key if exit or not
     * @param $name string : The name of key in the session
     * @return string
     */
    public function __isset(string $name)
    {
        return isset($_SESSION[$name]);
    }

    /**
     * this function remove the key from the session
     * @param string $name the name of the key
     */
    public function __unset(string $name): void
    {
        unset($_SESSION[$name]);
    }

    public function start()
    {
        if (session_id() == '') {
            if (session_start()) {
                $this->setSessionStartTime();
                $this->checkSessionValidity();
            }
        }
    }

    private function setSessionStartTime()
    {
        if (!isset($this->sessionStartTime)) {
            $this->sessionStartTime = time();
        }
        return true;
    }

    public function checkSessionValidity()
    {
        if ((time() - $this->sessionStartTime) > ($this->sessionTTL * 60)) {
            $this->renewSession();
            $this->generateFingerPrint();
        }
    }

    public function renewSession()
    {
        $this->sessionStartTime = time();
        return session_regenerate_id(true);
    }

    public function write($session_id, $session_data)
    {
        return parent::write($session_id, openssl_encrypt(
            $session_data,
            $this->sessionCipherAlgo,
            $this->sessionCipherKey
        ));
    }

    public function read($session_id)
    {
        return openssl_decrypt(
            parent::read($session_id),
            $this->sessionCipherAlgo,
            $this->sessionCipherKey
        );
    }

    public function kill()
    {
        session_unset();
        setcookie(
            $this->sessionName,
            '',
            time() - 500,
            $this->sessionPath,
            $this->sessionDomain,
            $this->sessionSSL,
            $this->sessionHTTPOnly
        );
        session_destroy();
    }

    public function generateFingerPrint()
    {
        $userAgentId = $_SERVER['HTTP_USER_AGENT'];
        $this->cipherKey = openssl_random_pseudo_bytes(16);
        $sessionId = session_id();
        $this->fingerPrint = md5($userAgentId . $this->cipherKey . $sessionId);
    }

    public function isValidFingerPrint()
    {
        if (!isset($this->fingerPrint)) {
            $this->generateFingerPrint();
        }
        $fingerPrint = md5($_SERVER['HTTP_USER_AGENT'] . $this->cipherKey . session_id());
        if ($fingerPrint === $this->fingerPrint) {
            return true;
        }
        return false;
    }

    public function dump()
    {
        return var_dump($_SESSION);
    }

}
