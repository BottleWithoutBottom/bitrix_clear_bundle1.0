<?php
define('LOCAL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/local/');
define('LOCAL_DIR_PATH', SITE_DIR . 'local/');

/** APP */
define('APP_PATH', LOCAL_PATH . 'app/');
define('APP_CONFIG_PATH', APP_PATH . 'config/');
define('ROUTER_PATH', APP_PATH . 'Router/bootstrap.php');
define('VIEWS_PATH', APP_PATH . 'Views/');
define('DI_CONFIG_PATH', APP_CONFIG_PATH . 'DI.php');

/** LOCAL */
define('CONSTANTS_PATH', APP_PATH . 'constants/');
define('MODULES_PATH', APP_PATH . 'modules/');
define('AJAX_VIRTUAL_PATH', CONSTANTS_PATH . 'ajax-virtual.php');
define('INCLUDE_PATH', APP_PATH . 'include/');
define('COMMON_TEMPLATE_PATH', INCLUDE_PATH . 'templates/');