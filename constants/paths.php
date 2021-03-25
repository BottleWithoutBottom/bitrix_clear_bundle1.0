<?php
define('LOCAL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/local/');
define('DI_CONFIG_PATH', LOCAL_PATH . 'DI/config.php');
define('CONSTANTS_PATH', LOCAL_PATH . 'constants/');
define('MODULES_PATH', LOCAL_PATH . 'modules/');
define('LETSROCK_LIB_PATH', MODULES_PATH . 'letsrock.lib/lib/');
define('AJAX_VIRTUAL_PATH', CONSTANTS_PATH . 'ajax-virtual.php');
define('ROUTER_PATH', LETSROCK_LIB_PATH . 'router/bootstrap.php');
define('INCLUDE_PATH', LOCAL_PATH . 'include/');
define('COMMON_TEMPLATE_PATH', INCLUDE_PATH . 'templates/');