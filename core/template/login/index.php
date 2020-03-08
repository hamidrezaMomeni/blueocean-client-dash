<?php
if (!defined('ABSPATH')) exit; // No direct access allowed
global $data;

include(plugin_dir_path(__FILE__) . '/header.php');

if (isset($data['include']))
    include($data['include']);

include(plugin_dir_path(__FILE__) . '/footer.php');
