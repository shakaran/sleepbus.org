<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
// $active_record = TRUE;
$query_builder = TRUE;

$db['default']['hostname'] = $GLOBALS['env_config']['database']['DB_HOST'];
$db['default']['username'] = $GLOBALS['env_config']['database']['DB_USER'];
$db['default']['password'] = $GLOBALS['env_config']['database']['DB_PASSWORD'];
$db['default']['database'] = $GLOBALS['env_config']['database']['DB_NAME'];
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */
