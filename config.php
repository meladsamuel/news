<?php
defined('DS') ? NULL : define('DS', DIRECTORY_SEPARATOR);
defined('APP_PATH') ? NULL : define('APP_PATH', __DIR__ . DS . 'app' . DS);
defined('SESSION_PATH') ? NULL : define('SESSION_PATH', dirname(APP_PATH) . DS . 'sessions');
defined('TEMPLATE_PATH') ? NULL : define('TEMPLATE_PATH', APP_PATH . 'template');

// database connections
defined('DATABASE_HOST_NAME') ? NULL : define('DATABASE_HOST_NAME', 'localhost');
defined('DATABASE_USER_NAME') ? NULL : define('DATABASE_USER_NAME', 'melad');
defined('DATABASE_PASSWORD') ? NULL : define('DATABASE_PASSWORD', 'adv511998');
defined('DATABASE_DB_NAME') ? NULL : define('DATABASE_DB_NAME', 'news');

require APP_PATH . 'core' . DS . 'Session.php';
require APP_PATH . 'core' . DS . 'Authentication.php';
require APP_PATH . DS . 'models' . DS . 'AbstractModel.php';
require APP_PATH . DS . 'core' . DS . 'DatabaseHandler.php';
require APP_PATH . DS . 'core' . DS . 'PDOHandler.php';
require APP_PATH . DS . 'models' . DS . 'News.php';
require APP_PATH . DS . 'models' . DS . 'Users.php';

