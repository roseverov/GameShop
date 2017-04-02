<?php

	/*FRONT CONTROLLER*/
	
	/*$replacement = 'Month: $2, Day: $1, Year: $3';
	$pattern = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/';
	$string = '20-11-1995';
	echo preg_replace($pattern,$replacement,$string);*/
	
	//1. Общие настройкии
	
	ini_set('display_errors', 1);//отображение ошибок
	error_reporting(E_ALL);
	
	session_start();
	//2. Подключение файлов системы
	
	define ('ROOT',dirname(__FILE__));//отображает винч и путь до директории, где нах-ся файл
	
	require_once (ROOT . '/components/Autoload.php');
	
	//3. Вызовв Router
	
	$router = new Router();
	$router->run();
	
	
	
?>