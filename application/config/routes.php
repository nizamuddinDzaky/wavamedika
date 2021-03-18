<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']   = 'login';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

$route['gizi/(:any)'] = 'gizi/index';
$route['error/(:any)'] = 'gizi/index';

$route['lab/(:any)'] = 'lab/index';