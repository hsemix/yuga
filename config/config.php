<?php
$site = \Yuga\Site::instance();
$auth = \Yuga\Auth::instance();
/* ---------- Configuration start ---------- */

// Your custom namespace here
$site->set('APP_NAMESPACE', 'Byakuno');

// Debug mode enabled
$site->setDebugMode(TRUE);