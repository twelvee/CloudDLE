<?php
$route = array(
	'main' => array('url'=>'?mod=cloud', 'controller'=>ADMINDIR.'/controllers/MainController.php'),
	'settings' => array('url'=>'?mod=cloud&action=settings', 'controller'=>ADMINDIR.'/controllers/SettingsController.php'),
	'modules' => array('url'=>'?mod=cloud&action=modules', 'controller'=>ADMINDIR.'/controllers/ModulesController.php'),
);