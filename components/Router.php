<?php

	class Router {
		
		private $routes;//массив с маршрутами
		
		public function __construct() {
			$routPath = ROOT.'/config/routes.php';
			$this->routes = include($routPath);
		}
		
		//возвращает строку запроса
		private function getUri() {
			if (!empty($_SERVER['REQUEST_URI'])) {
				return trim($_SERVER['REQUEST_URI'], '/');
			}
		}
		
		public function run() {//принимает управление от front-controller`а
			//Получение строки запроса
			
			$uri = $this->getUri();
			
			//Проверка наличия такого запроса в файле routes
			
			foreach ($this->routes as $uriPat => $path) {
				
				//проверяем в урле наличие ключа из массива роутов
				if (preg_match("~$uriPat~",$uri)) {//~ - для того, что знак $ не понимался как эл-т рег-ых выражений
						
					//Получаем внутренний путь из внешнего
					$internalRoute = preg_replace("~$uriPat~", $path, $uri);
					
					//Определить контроллер, action, параметры
					
					$segment = explode('/',$internalRoute);
					
					$controllerName = array_shift($segment).'Controller';//данная ф-я получает 1-й эл-т массива, а затем удаляет его от туда
					$controllerName = ucfirst($controllerName);//делает 1-ю букву заглавной
					
					$actionName = 'action'.ucfirst(array_shift($segment));
					
					$parameters = $segment;
					
					//Подключить файл класса контроллера
					$controllerFile = ROOT.'/controller/'.$controllerName.'.php';
					
					if (file_exists($controllerFile)) {
						include_once($controllerFile);
					}
					
					//Создать объект и вызвать метод(т.е. action)
					$controllerObject = new $controllerName;
					
					$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
					
					if ($result != null) {
						break;
					}
				}
				
			}
			return true;
		}
		
	}

?>