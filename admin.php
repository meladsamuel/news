<?php

use app\core\Authentication;
use app\core\Session;

require 'config.php';

$session = new Session();
$session->start();
$auth = Authentication::getInstance($session);

require TEMPLATE_PATH . DS . 'admin' . DS . 'header.php';
if (isset($session->admin) && $session->admin->user_group == 1) {
    if (isset($_GET['category']) && $_GET['category'] == 'add')
        require TEMPLATE_PATH . DS . 'admin' . DS . 'category' . DS . 'add.php';
    else
        require TEMPLATE_PATH . DS . 'admin' . DS . 'dashboard.php';

} else
    require TEMPLATE_PATH . DS . 'admin' . DS . 'login.php';

require TEMPLATE_PATH . DS . 'admin' . DS . 'footer.php';


